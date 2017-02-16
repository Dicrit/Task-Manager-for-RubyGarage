<?php
switch ($_GET['query']){
	case 'test':
		$query = "SELECT priority FROM tasks WHERE project_id = 5 AND name = 'sss'";
		$priority = $db->query_once($query);
		var_dump($priority);
		break;
	case 'newProject':
		include __DIR__ . '/createProject.php';
		break;
	case 'deleteProject':
		include __DIR__ . '/deleteProject.php';
	break;
	case 'addTask':
		include __DIR__ . '/addTask.php';
	break;
	case 'deleteTask':
		include __DIR__ . '/deleteTask.php';
		break;
	case 'updateTask':
		include __DIR__ . '/updateTask.php';
		break;
	case 'askProject':
		include __DIR__ . '/askProject.php';
		break;
	case 'updateProject':
		include __DIR__ . '/updateProject.php';
		break;
	case 'upPriority':
		include __DIR__ . '/upPriority.php';
		break;
	case 'downPriority':
		include __DIR__ . '/downPriority.php';
		break;
		case 'setDone':
		include __DIR__ . '/setDone.php';
}


?>