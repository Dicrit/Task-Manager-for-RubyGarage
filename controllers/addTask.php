<?php 
$name = $_GET['value'];
$text = $_GET['text'];
$userid = $_SESSION['userid'];
$query = "SELECT id FROM projects WHERE user_id = '$userid' AND name='$name'";
$id = $db->query_once($query);
$id = $id['id'];
if (Task::checkExist($id, $text, $db) == false) die;
$query = "SELECT MAX(priority) FROM tasks WHERE project_id = $id";
$priority = $db->query_once($query);
$priority = $priority['MAX(priority)'] + 1;
$query = "INSERT INTO tasks (name, status, project_id, priority) VALUES ('$text','active', $id, $priority)";
$db->query_once($query);
$task = new Task($text, false);
$project = new Project($name);
include __DIR__ . '/../views/task.php';
?>