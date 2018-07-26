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
	
	íf(!is_numeric($this_id))
		return -1;
	
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
	} else {
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

function database_query($this_id, $query)
{
	global $this_con;
	
	$sql = "$query";
	if ($qer = $this_con[$this_id]->query($sql) === TRUE) 
	{
		if(!$silent)
			echo "Query successful";
		return $qer;
	} else {
		if(!$silent)
			echo "Query failed: " . $this_con[$this_id]->error;
		return -1;
	}
}

function database_close($this_id)
{
	global $this_con;
	
	if($this_id)
		$this_con[$this_id]->close();
	else
		return -1;
	
	return 1;
}

/* ------------------------------------------ TABLES ------------------------------------------ */
// Notice : These can return arrays of information!

function database_create_T($this_id, $setup, $table)
{
	$out = database_query($this_id, "CREATE TABLE $table($setup)");
	return $out;
}
function database_update_T($this_id, $set_data, $update_rule, $table)
{
	$out = database_query($this_id, "UPDATE $table SET $set_data WHERE $update_rule");
	return $out;
}
function database_write_T($this_id, $set_data, $table)
{
	$out = database_query($this_id, "INSERT INTO $table VALUES $set_data");
	return $out;
}
function database_read_T($this_id, $what_to_read, $table)
{
	$out = database_query($this_id, "SELECT $what_to_read FROM $table");
	return $out;
}
function database_deletefrom_T($this_id, $delete_rule, $table)
{
	$out = database_query($this_id, "DELETE FROM $table WHERE $delete_rule");
	return $out;
}



?>