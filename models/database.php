<?php
class myDatabase {
	public function query ($query)
	{
		$res = mysql_query($query);
		if ($res == false) return false;
		$arr = array();
		//while(NULL !== $row = mysql_fetch_array($res) && false !== $row)
			while(false !== $row = mysql_fetch_array($res))
		{
		$arr[] = $row;
		}
		return $arr;
	}
	public function query_once($query)
	{
		$res = mysql_query($query);
		if ($res == false) return false;
		if ($res == true && is_bool($res)) return true;
		return mysql_fetch_array($res);
	}
	
	public function __construct($addres, $user, $password, $database = 'taskmanagerdatabase')
	{
		//mysql_connect('localhost','root','');
		mysql_connect($adress, $user, $password);
		//mysql_select_db('taskmanagerdatabase');
		mysql_select_db($database);
	}
}
?>