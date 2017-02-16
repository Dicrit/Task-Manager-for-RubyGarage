<?php
$name = mysql_real_escape_string($_GET['value']);
$userid = $_SESSION['userid'];
$query = "INSERT INTO projects (name, user_id) VALUES ('$name', $userid)";
//echo $query;
$project = new Project($name);
$db->query_once($query);
include __DIR__ . '/../views/project.php';
?>