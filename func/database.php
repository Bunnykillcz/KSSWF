<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/


/*  		MySQLi database control functions	 		*/
/*  		Notice! : system uses MySQLi (php5+) 		*/



function database_init($this_id, $servername, $username, $password, $database_name = null)
{
	global $this_con;
	
	if(!is_numeric($this_id))
	if(!($this_id <= 9 && $this_id >= 0))
		return -1;
		
	$this_con[$this_id] = null;
	$this_con[$this_id] = new mysqli($servername, $username, $password, $database_name);
	
	if ($this_con[$this_id]->connect_error) 
	{
		//die("Connection failed: " . $conn->connect_error);
		return -2;
	} 
	return 1;
}

function database_create($this_id, $new_db_name, $silent = true)
{
	global $this_con;
	
	$sql = "CREATE DATABASE $new_db_name";
	if ($this_con[$this_id]->query($sql) === TRUE) 
	{
		if(!$silent)
			echo "Database created successfully";
	} 
	else 
	{
		if(!$silent)
			echo "Error creating database: " . $this_con[$this_id]->error;
		return -1;
	}
	return 1;
}

function database_delete($this_id, $delete_db_name, $silent = true)
{
	global $this_con;
	
	$sql = "DROP DATABASE $delete_db_name";
	if ($this_con[$this_id]->query($sql) === TRUE) 
	{
		if(!$silent)
			echo "Database deleted successfully";
	} else {
		if(!$silent)
			echo "Error deleting database: " . $this_con[$this_id]->error;
		return -1;
	}
	
	return 1;
}

function database_query($this_id, $query, $silent = true)
{
	global $this_con;
		
	$qer = $this_con[$this_id]->query($query);
	
	if ($qer == TRUE) 
	{
		if(!$silent)
			echo "Query successful";
		return $qer;
	} 
	else 
	{
		if(!$silent)
			echo "Query failed: " . $this_con[$this_id]->error;
		return -1;
	}
	return "unknown error";
}

function database_close($this_id)
{
	global $this_con;
	
	if(!empty($this_id))
		$this_con[$this_id]->close();
	else
		return -1;
	
	return 1;
}

/* ------------------------------------------ TABLES ------------------------------------------ */
// Notice : These can return arrays of information!

function database_create_T($this_id, $setup, $table, $engine = "InnoDB" ,$overwrite = false)
{
	$ov = "IF NOT EXISTS ";
	if($overwrite)
		$ov = "";
	global $this_con;
	$out = database_query($this_id, "CREATE TABLE $ov$table ( $setup ) ENGINE=$engine");
	return $out;
}
function database_update_T($this_id, $set_data, $update_rule, $table)
{
	global $this_con;
	$out = database_query($this_id, "UPDATE $table SET $set_data WHERE $update_rule");
	return $out;
}
/*function database_select_T($this_id, $set_data, $table)
{
	$out = database_query($this_id, "INSERT INTO $table VALUES $set_data");
	return $out;
}*/
function database_write_T($this_id, $set_data, $table)
{
	global $this_con;
	$out = database_query($this_id, "INSERT INTO $table VALUES $set_data");
	return $out;
}
function database_read_T($this_id, $what_to_read, $table, $order = "", $desc = true)
{
	global $this_con;
	$d = "DESC";
	if(!$desc)
		$d = "";
	
	if(!empty($order))
		$order = "ORDER BY ".$order." $d";
	$out = database_query($this_id, "SELECT $what_to_read FROM $table $order");
	return $out;
}
function database_deletefrom_T($this_id, $delete_rule, $table)
{
	global $this_con;
	$out = database_query($this_id, "DELETE FROM $table WHERE $delete_rule");
	return $out;
}

/* ------------------------------------------ ADVANCED functions ------------------------------------------ */

function database_show_T($element_class, $this_id, $servername, $username, $password, $database_name, $what_to_read, $from_table)
{
	global $this_con;
	$table = $from_table;
	if(database_init($this_id, $servername, $username, $password, $database_name) != 1)
		return -9;
		
	$read_db = database_query($this_id, "SELECT $what_to_read FROM $table");
	
	if(is_numeric($read_db))
		return $read_db;
	
		
	echo "<table class='$element_class'>";
	while($data = mysqli_fetch_assoc($read_db))
	{
		echo "<tr>";
			foreach($data as $element)
			echo "<td>$element</td>";
		echo "<tr>";
	}
	echo "</table>";
	database_close($this_id);
	
	return 1;
}












?>