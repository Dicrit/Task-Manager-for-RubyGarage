<?php
class Task
{
	public $name;
	public $status;
	public function __construct($name, $status)
	{
		$this->name = $name;
		$this->status = $status;
	}
	public static function getTasks($db, $project_id)
	{
		$query = "SELECT * FROM tasks WHERE project_id = '$project_id' ORDER BY priority";
		$res = $db->query($query);
		$arr = array();
		foreach ($res as $val)
		{
			$arr[] = new Task($val['name'],$val['status']);
		}
		return $arr;
	}
	public static function checkExist($project_id, $name, $db)
	{
		$query = "SELECT * FROM tasks WHERE project_id = $project_id AND name = '$name'";
		$id = $db->query_once($query);
		if ($id == true) return false;
		else return true;
	}
}

class Project
{
	public $tasks;
	public $name;
	private function construct($id, $name, $db)
	{
		$this->name = $name;
		$this->tasks = Task::getTasks($db, $id);
	}
	private function construct2($name)
	{
		$this->name = $name;
		$this->tasks = array();
	}
	public function __construct()
	{
		$args = func_get_args();
		if (count($args) == 3) $this->construct($args[0],$args[1],$args[2]);
		else $this->construct2($args[0]);
		
	}
	public static function getProjects($db, $userid)
	{
		$query = "SELECT * FROM projects WHERE user_id = '$userid'";
		$res = $db->query($query);
		$arr = array();
		foreach ($res as $val)
		{
			$arr[] = new Project($val['id'],$val['name'], $db);
		}
		return $arr;
	}
	public static function checkExist($userid, $name, $db)
	{
		$query = "SELECT * FROM projects WHERE user_id = $userid AND name = '$name'";
		$id = $db->query_once($query);
		if ($id == true) return false;
		else return true;
	}
}


?>