<?php
$name = mysql_real_escape_string($_GET['value']);
$newName = mysql_real_escape_string($_GET['newName']);
$oldName = mysql_real_escape_string($_GET['oldName']);
$userid = $_SESSION['userid'];

$query = "SELECT id FROM projects WHERE user_id = $userid AND name='$name'";
$id = $db->query_once($query);
$id = $id['id'];
if (Task::checkExist($id, $newName, $db) == false) die;
$query = "UPDATE tasks SET name = '$newName' WHERE project_id = $id AND name = '$oldName'";
$db->query_once($query);

$task = new Task($newName, false);
$project = new Project($name);
include __DIR__ . '/../views/task.php';
?>