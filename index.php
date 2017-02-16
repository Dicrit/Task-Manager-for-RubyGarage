<?php
require __DIR__ . '/models/database.php';
require __DIR__ . '/models/Projects.php';
session_start();
$db = new myDatabase('localhost','root','');
if (isset($_GET['quit'])) unset($_SESSION['userid']);
if (isset($_POST['login']))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$query = "SELECT id FROM users WHERE login = '$login' AND password = '$password'";
		$ans = $db->query_once($query);
		if($ans)
		{
			$_SESSION['userid'] = $ans[id];
		}
	}
if(!isset($_SESSION['userid']))
{
	include __DIR__ . '/views/login.html';
	die;
}
if (isset($_GET['query'])) { include __DIR__ . '/controllers/Query.php'; die;}
$projects = Project::getProjects($db, $_SESSION['userid']);

include __DIR__ . '/views/main.php';

?>