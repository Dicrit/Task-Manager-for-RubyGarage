<?php
$name = mysql_real_escape_string($_GET['value']);
$newStatus = mysql_real_escape_string($_GET['status']);
if ($newStatus == 'true') $newStatus = 1;
$taskName = mysql_real_escape_string($_GET['taskName']);
$userid = $_SESSION['userid'];

$query = "SELECT id FROM projects WHERE user_id = $userid AND name='$name'";
$id = $db->query_once($query);
$id = $id['id'];

$query = "UPDATE tasks SET status = $newStatus WHERE project_id = $id AND name = '$taskName'";
$db->query_once($query);
?>