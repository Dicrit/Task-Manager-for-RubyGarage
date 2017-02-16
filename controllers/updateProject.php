<?php
$name = mysql_real_escape_string($_GET['value']);
$newName = mysql_real_escape_string($_GET['newName']);
$userid = $_SESSION['userid'];

if ($newName == ''){
	//include __DIR__ . '/askProject.php';
	die;
}

if (Project::checkExist($userid, $newName, $db) == true)
{
if ($name == '') $query = "INSERT INTO projects (name, user_id) VALUES ('$newName', $userid)";
else{
	$query = "UPDATE projects SET name = '$newName' WHERE user_id = $userid AND name = '$name'";
}
$db->query_once($query);
$query = "SELECT id FROM projects WHERE user_id = $userid AND name = '$newName'";
$id = $db->query_once($query);
$id = $id['id'];
$project = new Project($id,$newName, $db);
include __DIR__ . '/../views/project.php';
}
//else {
//$query = "SELECT id FROM projects WHERE user_id = $userid AND name = '$name'";
//$id = $db->query_once($query);
//$id = $id['id'];
//$project = new Project($id,$name, $db);
//}

//include __DIR__ . '/../views/project.php';
?>