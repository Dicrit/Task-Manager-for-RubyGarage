<?php
require __DIR__ . '/models/database.php';
require __DIR__ . '/models/Projects.php';
session_start();
$db = new myDatabase('localhost','root','');
if (isset($_GET['quit'])) unset($_SESSION['userid']);
if (isset($_GET['signup'])) {include __DIR__ . '/views/Registration.html'; die;}
if (isset($_POST['rlogin']))
	{
		$login = mysql_real_escape_string($_POST['rlogin']);
		$password = mysql_real_escape_string($_POST['rpassword']);
		$query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
		$ans = $db->query_once($query);
		$query = "SELECT id FROM users WHERE login = '$login' AND password = '$password'";
		$ans = $db->query_once($query);
		if($ans)
		{
			$_SESSION['userid'] = $ans[id];
		}
	}
else if (isset($_POST['login']))
	{
		$login = mysql_real_escape_string($_POST['login']);
		$password = mysql_real_escape_string($_POST['password']);
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