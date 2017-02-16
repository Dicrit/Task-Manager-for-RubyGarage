<div id="BaseDiv" align="center">
<?php foreach ($projects as $project){
	include __DIR__ . '/project.php';
}
?>
<button id="AddProjectButton" style="margin-bottom:40px" onclick="AskProject()" >
<span class="glyphicon glyphicon-plus"></span>  Add TODO List
</button>
</div>