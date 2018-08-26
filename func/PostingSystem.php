<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/


/*  		PostingSystem functions				 		*/
/*  		Notice! : system uses MySQLi (php5+) 		*/

function PostSystemInit($servername, $username, $password, $database_name, $PS_ID = 9, $PS_NAME = "PostSystemTable")
{	
	echo "<div class='PostSystem'>";
	
	if(database_init($PS_ID, $servername, $username, $password, $database_name))
	{
		return 1;
	}
	else
	{
		echo "<div class='PS_POST'><h3 style='color:red;'>Failed to initiate</h3><span>Check the database setup. Database might not be set up correctly.</span></div>";
		return -1;
	}
}

function PS_Exists($PS_ID = 9, $PS_NAME = "PostSystemTable", $create_if_not = true)
{
	$not_found = false;
	if ($result = database_query($PS_ID, "SHOW TABLES LIKE '".$PS_NAME."'")) 
	{
		if($result -> num_rows >= 1) 
		{
			return 1;
		}
		else
			$not_found = true;
	}
	else
		$not_found = true;
	
	if($not_found)
	{
		if($create_if_not)
			return database_create_T($PS_ID, "ID INT UNSIGNED NOT NULL AUTO_INCREMENT , Date INT UNSIGNED NOT NULL , Publish INT UNSIGNED NOT NULL , Title TEXT NOT NULL , Author TEXT NOT NULL , Preview TEXT NOT NULL , Likes INT UNSIGNED NOT NULL , ViewCount INT UNSIGNED NOT NULL , Content TEXT NOT NULL , Content_short TEXT NOT NULL, PRIMARY KEY (ID)", $PS_NAME);
		return 0;
	}
}

function ShowPosts($PS_ID = 9, $PS_NAME = "PostSystemTable", $limit_amount = 0, $author_prefix = "", $datetime_format = "d-m-Y | H:i", $ShowMore_Text = "Read more ...", $likes_prefix = "", $views_prefix = "", $date_prefix = "")
{
	CheckPosting($PS_ID, $PS_NAME, $datetime_format);
	
	if(empty($likes_prefix))
		$likes_prefix = icon("heart");
	if(empty($views_prefix))
		$views_prefix = icon("eye");
	if(empty($date_prefix))
		$date_prefix = icon("calendar");
	
	if(isset($_GET['ps']))
	if(!empty($_GET['ps']))
	if(is_numeric($_GET['ps']))
	{
		$get = $_GET['ps'];
		$amount = 0;
		$cnt = database_query($PS_ID, "SELECT 1 FROM $PS_NAME WHERE ID=$get");
		foreach($cnt as $item)
			$amount++;
		
		if($amount >= 1)
		{
		ReadFullPost($get, $PS_ID, $PS_NAME, $datetime_format, $likes_prefix, $views_prefix, $date_prefix);
		return 1;
		}
	}	
	
	
	$posts = database_read_T($PS_ID, "*", $PS_NAME, "ID", true);
	$posts_output = "";
	
	$limited = $limit_amount;
	if($limited <= 0)
		$limited = 100;
	
	$post_count = 0;
	$today = date("U",$_SERVER['REQUEST_TIME']);
	
	global $actual_link;
	global $after_link;
	global $this_w;
	$w_t_="?w=".$this_w;
	$this_url = "$actual_link$after_link$w_t_"; 
	
	$edit_id = -1;
	$rem_id  = -1;
	
	foreach($posts as $post)
	{
		$publish_time = $post["Publish"];
		$this_id = $post["ID"];
		$to_edit = -1;
		
		if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		if(isset($_GET["PSed"]))
		if(!empty($_GET["PSed"]))
		if($_GET["PSed"] >= 0)
			$to_edit = $_GET["PSed"]; //say which ID you wanna edit && only as admin
		
		
		//echo "$today >= $publish_time | ";
		
		if($today >= $publish_time || isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		if($limited > 0)
		{
			$posts_output .= "<div class='PS_POST' id='pid$this_id'><a href='$this_url&ps=$this_id'>";
			for($i = 0; $i <= 9; $i++)
			{
				switch($i)
				{
					case 0:	$p_id = "ID"; break;
					case 1:	$p_id = "Title"; break;
					case 2:	$p_id = "Publish"; break;
					case 3:	$p_id = "Date"; break;
					case 4:	$p_id = "Author"; break;
					case 5:	$p_id = "Preview"; break;
					case 6:	$p_id = "Likes"; break;
					case 7:	$p_id = "ViewCount"; break;
					case 8:	$p_id = "Content"; break;
					case 9:	$p_id = "Content_short"; break;
				}
				$ptype = $post[$p_id];
				if($to_edit == -1)
				{
					if($i == 1)
						$posts_output .= "<div class='PS_Title'><h2>$ptype</h2></div>";
				 	if($i == 2)
					if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
						$posts_output .= "<div class='PS_DateP'>$date_prefix".date($datetime_format,@$ptype)."</div>";
					if($i == 3)
						$posts_output .= "<div class='PS_Date'>$date_prefix".date($datetime_format,@$ptype)."</div>";
					if($i == 4)
						$posts_output .= "<div class='PS_Author'>$author_prefix"."$ptype</div>";
					if($i == 5)
						$posts_output .= "<div class='PS_Preview'>".img($ptype,"","",true,false,240, true)."</div>";
					if($i == 6)
						$posts_output .= "<div class='PS_Likes'>$likes_prefix"."$ptype</div>";
					if($i == 7)
						$posts_output .= "<div class='PS_ViewCount'>$views_prefix"."$ptype</div>";
					/*if($i == 8)
						$posts_output .= "<div class='PS_Text'>$ptype</div>";*/
					if($i == 9)
						$posts_output .= "<div class='PS_Text_Short'>$ptype</div>";
				}
			}
			$posts_output .= "<div class='PS_more'>$ShowMore_Text</div>";
			$posts_output .= "</a>";
			if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
			{
				if($today < $publish_time)
					$posts_output .= "<div class='PS_only_admin'>".icon("eye-slash")."</div>";
				
				//---- CB START
				if(isset($_GET['showCB']))
				if($_GET['showCB'] == $this_id)
					confirmbox($this_id, "Do you really want to delete this post [ID: $this_id] ?", "$this_url&PSrm=$this_id");
				//---- CB END
				
				$posts_output .= "<div class='PS_ID'>$this_id</div>";
				$posts_output .= "<div class='PS_admin'><a href='$this_url&showCB=$this_id#pid$this_id'>".icon("bin")."</a><a href='$this_url&PSed=$this_id'>".icon("edit")."</a></div>";
			}
			$posts_output .= "</div>";
			
			if($limit_amount != 0)
				$limited--;
			
			$post_count++;
		}
	}
	if($post_count < 1)
	{
		$posts_output .= "<div class='PS_POST_E'>";
		$posts_output .= "<div class='PS_Empty'>No posts published yet.</div>";
		$posts_output .= "</div>";
	}
	if($post_count == $limited)
	{
		$posts_output .= "<div class='PS_POST_E'><a href=''>";
		$posts_output .= "<div class='PS_more'>More posts ...</div>";
		$posts_output .= "</a></div>";
	}
	
	echo $posts_output;
	
	if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		return 0;

	$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	$today_glob = date($datetime_format);
	$today_year	= date("Y");
	$today_month= date("m");
	$today_min  = date("d");
	$today_hour = date("H");
	$today_date = date("i");
		
	global $this_w;
	
	$add_protocol  = "<div class='PS_AddNew'><form action='".htmlspecialchars($_SERVER["PHP_SELF"])."?w=".$this_w."' method='POST' enctype='multipart/form-data'>";
	$add_protocol .= "<input type='text' name='Title' placeholder='Title of this post'><br/>";
	$add_protocol .= "<div class='PS_Author'>Author: </div><input type='text' name='Author' value='".$usrn."' readonly><br/>";
	$add_protocol .= "<div class='PS_Date'>Date to show: </div><input type='datetime' name='Date' class='PS_DatepickD' value='$today_glob'><br/>";
	$add_protocol .= "<div class='PS_Publish'>Publish at: </div><input type='datetime' name='DateP' class='PS_Datepick' value='$today_glob'><br/>";
	$add_protocol .= "<div class='PS_Preview'>Preview image: </div><input type='file' name='Preview' class='PS_Preview' value=''><br/>";
	$add_protocol .= "<textarea name='Text' class='PS_Text' placeholder='Text to post ... [html accepted; php accepted]'></textarea><br/>";
	$add_protocol .= "<textarea name='TextS' class='PS_Text_Short' maxlength='480' placeholder='Shortened text [use the same as above, but short ; html only accepted ; limit: 240 characters]'></textarea><br/>";
	$add_protocol .= "<input id='PS_OK' name='PS_submit' type='submit' value='SUBMIT'/>";
	$add_protocol .= "</form>";
	$add_protocol .= "</div>";
	
	
	
	
	$add_protocol .= "<script> 
	optional_config = {
		enableTime: true,
		dateFormat: '$datetime_format',
		minDate: '$today_glob',
		time_24hr: true,
		'locale': {
			'firstDayOfWeek': 1
		}
	};
	optional_configD = {
		enableTime: true,
		dateFormat: '$datetime_format',
		time_24hr: true,
		'locale': {
			'firstDayOfWeek': 1
		}
	};
	$('.PS_Datepick').flatpickr(optional_config); 
	$('.PS_DatepickD').flatpickr(optional_configD); 
	</script>"; 
	
	echo $add_protocol;
}

function ReadFullPost($read_id, $PS_ID = 9, $PS_NAME = "PostSystemTable", $datetime_format = "d-m-Y | H:i", $likes_prefix = "", $views_prefix = "", $date_prefix = "")
{
	$post_ = database_query($PS_ID, "SELECT * FROM $PS_NAME WHERE ID = $read_id");
	foreach($post_ as $post)
	{
		$this_id 		= $post["ID"];
		$this_title 	= $post["Title"];
		$this_date 		= $post["Date"];
		$this_author	= $post["Author"];
		$this_img 		= $post["Preview"];
		$this_likes 	= $post["Likes"];
		$this_views 	= $post["ViewCount"]+1;
		$this_content 	= $post["Content"];
	}
	
	database_update_T($PS_ID, "ViewCount=$this_views", "ID=$this_id", $PS_NAME);

	global $actual_link;
	global $after_link;
	global $this_w;
	$w_t_="?w=".$this_w;
	$this_url = "$actual_link$after_link$w_t_"; 
	
	$backtoprev = "".icon("angle-double-left")." Return";
	
	$output_post = "<div id='txt' class='PS_FULL'><br>";
	
	$output_post .= "<h1>$this_title</h1>";
	$output_post .= "<div class='PS_FULL_Date'>$date_prefix".date($datetime_format,@$this_date)."</div>";
	$output_post .= "<div class='PS_FULL_Author'>".icon("user")."$this_author</div>";
	if($this_img!="none" && $this_img!=null)
		$output_post .= "<div class='PS_FULL_IMG'>".img($this_img, "", "", true, false, 480, true, "_ps_img-$this_id")."</div>";
	$output_post .= "<div class='PS_FULL_Text'>";
	
	$output_post .= convert_php_headers($this_content,false);
	
	$output_post .= "</div><hr>";
	$output_post .= "<div class='PS_FULL_Views'>$views_prefix$this_views</div>";
	$output_post .= "<div class='PS_FULL_Likes'>$likes_prefix$this_likes</div><hr>";
	$output_post .= "<div class='PS_FULL_Back'>".button($backtoprev,$this_url,false,100,36)."</div>";
	$output_post .= "</div>";
	
	if(!file_exists("./cache/PS/"))
		mkdir("./cache/PS/");
	file_put_contents("./cache/PS/ps_$this_id.php",$output_post);
}

function strtotime_def($dt, $DTformat = "d-m-Y | H:i", $calibrate = 3600) // returns the Unix time 
{
	global $default_timezone;
	$gmt_plus = get_timezone_offset($default_timezone);
	
	$datetime = 0;
	if($DTformat == "d-m-Y | H:i")
	{
		$date = strtotime(substr($dt, 0, 10)." 00:00:00");
		$time = strtotime("01-01-1970 ".substr($dt, 12));		
		$datetime = $date + $time;
	}
	else
		$datetime = strtotime($DTformat);
	
	return $datetime + $calibrate + $gmt_plus;
}

function CheckPosting($PS_ID, $PS_NAME, $DTformat = "d-m-Y | H:i")
{
	$errors = "";
	//-------------------------- POST CHECK
	if( isset($_POST['PS_submit']) )
	{
		$title 		= $_POST['Title'];
		$author 	= $_POST['Author'];
		$datetime 		= strtotime_def($_POST['Date'], $DTformat);
		$publish_time 	= strtotime_def($_POST['DateP'], $DTformat);
		$likes 		= 0;
		$ViewCount 	= 0;
		$image 		= "none";
		$text 		= convert_php_headers($_POST['Text'],true);
		$texts 		= $_POST['TextS'];
		
		if( isset($_FILES['Preview']) )
		if(!empty($_FILES['Preview']["tmp_name"]))
		{
			$this_img_name = basename($_FILES["Preview"]["name"]);
			$upload = false;
			$check = getimagesize($_FILES["Preview"]["tmp_name"]);
			$image = "./img/uploads/$this_img_name";
			$imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			if($check !== false) // IS AN IMAGE ?
			{
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
					$errors .= "Unknown image format. Please use only jpg, jpeg, png, or gif. You can change the image at the post.<br/>";
				else			
					$upload = true;
			}
			else
				$errors .= "File is not an image, not uploaded. You can change the image at the post.<br/>";
		
			if($upload)
			{
				if(!file_exists("./img/uploads/"))
					mkdir("./img/uploads/"); 
				if(move_uploaded_file($_FILES["Preview"]["tmp_name"], $image))
				{
					$image = "./img/uploads/$this_img_name";
				}
				else
				{
					$errors .= "There was an error while uploading. You can change the image at the post.<br/>";
					$image = "none";
				}
			}
			else
				$errors .= "Unexpected upload error. You can change the image at the post.<br/>";
		}
		
		$posts_output;
		if(AddPost($title, $author, $text, $texts, $datetime, $publish_time, $likes, $ViewCount, $image, $PS_ID, $PS_NAME, $DTformat))
		{
			$posts_output = "<div class='PS_POST_E'>";
			$posts_output .= "<div class='PS_Empty' style='color: green;'>Post Successfully added. </div>";
			if(!empty($errors))
				$posts_output .= "<div class='PS_Empty' style='color: red;'>Errors:<br/>$errors</div>";
			$posts_output .= "</div>";
		}
		else
		{
			$posts_output = "<div class='PS_POST_E'>";
			$posts_output .= "<div class='PS_Empty' style='color: red;'>Post failed to be added. Check your database setup.</div>";
			if(!empty($errors))
				$posts_output .= "<div class='PS_Empty' style='color: red;'>Errors:<br/>$errors</div>";
			$posts_output .= "</div>";
		}
		
		echo $posts_output;
		
		unset($_POST['Title']);
		unset($_POST['Author']);
		unset($_POST['Date']);
		unset($_POST['DateP']);
		unset($_POST['Preview']);
		unset($_POST['Text']);
		unset($_POST['TextS']);
		unset($_POST['PS_submit']);
	}	

	if(isset($_GET['PSrm']))
	{
		global $this_w;
		$page = str_replace("+","/",$this_w);
		PostRemove($_GET['PSrm'], $PS_ID, $PS_NAME);
		cache_clear_only('img/'.$page);
	}
	
	
}

function PostRemove($Delete_ID, $PS_ID = 9, $PS_NAME = "PostSystemTable")
{
	if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		return -1;

	return database_deletefrom_T($PS_ID, "ID = $Delete_ID", $PS_NAME);
}

function AddPost($title, $author, $text, $text_short, $datetime, $publish_time, $likes = 0, $ViewCount = 0, $image = "none", $PS_ID = 9, $PS_NAME = "PostSystemTable",$DTformat = "d-m-Y | H:i") 
{
	if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		return 0;

	$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	global $this_w;
	$page = str_replace("+","/",$this_w);
	cache_clear_only('img/'.$page);
	
	//echo "$datetime || $publish_time";
	
	$id = 0;
	$datetime	 	= $datetime;
	$publish_time 	= $publish_time;
	$title			= htmlspecialchars($title);
	$author			= $author;
	if(!file_exists($image))
		$image = "none";
	$likes 			= $likes;
	$ViewCount 		= $ViewCount;
	$text			= $text;
	$text_short		= $text_short;
	
	$out = database_write_T($PS_ID, "($id, $datetime, $publish_time, '$title', '$author', '$image', $likes, $ViewCount, '$text', '$text_short')", $PS_NAME);
	//Protocol: 0-10 | ID, Date, Publish, Title, Author, Preview, Likes, ViewCount, Text, Text_Short
	
	return $out;
}

function PostSystemClose($PS_ID = 9)
{
	database_close($PS_ID);
	echo "</div>";
}


//-------------------------//
// POST DATABASE PROTOCOL: //
//-------------------------//
// 0. ID
// 1. Date
// 2. Date for publishing
// 3. Title
// 4. Author = Admin name
// 5. Image preview
// 6. Likes
// 7. View count
// 8. Content of the post (html)
// 9. Content of the post SHORTened
//-------------------------//

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//this function was written by "[d][a][n][at][authenticdesign][.][net]" at http://php.net/manual/en/function.timezone-offset-get.php
function get_timezone_offset($remote_tz, $origin_tz = null) {
    if($origin_tz === null) {
        if(!is_string($origin_tz = date_default_timezone_get())) {
            return false; // A UTC timestamp was returned -- bail out!
        }
    }
    $origin_dtz = new DateTimeZone($origin_tz);
    $remote_dtz = new DateTimeZone($remote_tz);
    $origin_dt = new DateTime("now", $origin_dtz);
    $remote_dt = new DateTime("now", $remote_dtz);
    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
    return $offset;
}

?>