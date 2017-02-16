<?php
$name = mysql_real_escape_string($_GET['value']);
$userid = $_SESSION['userid'];
$taskName = mysql_real_escape_string($_GET['taskName']);
$query = "SELECT id FROM projects WHERE user_id = $userid AND name='$name'";
$id = $db->query_once($query);
$id = $id['id'];		

$query = "SELECT priority FROM tasks WHERE
project_id = $id 
AND name = '$taskName'
AND priority > 1";
$priority = $db->query_once($query);
if($priority == true){
$priority = $priority['priority'];
$query = "UPDATE tasks SET priority = priority + 1 WHERE project_id = $id AND priority = $priority - 1";
$db->query_once($query);

$query = "UPDATE tasks SET priority = priority - 1 WHERE project_id = $id AND name = '$taskName'";
$db->query_once($query);
}

$project = new Project($id,$name, $db);
include __DIR__ . '/../views/project.php';
?>