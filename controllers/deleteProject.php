<?php
$name = mysql_real_escape_string($_GET['value']);
$userid = $_SESSION['userid'];
$query = "SELECT id FROM projects WHERE user_id = $userid AND name='$name'";
$id = $db->query_once($query);
$id = $id['id'];
$query = "DELETE FROM projects WHERE user_id = $userid AND name='$name'";
$db->query_once($query);

$query = "DELETE FROM tasks WHERE project_id = $id";
$db->query_once($query);
?>