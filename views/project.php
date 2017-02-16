<div class="mainblock" align="center">
<div class='ProjectHead'><div class="col1">
<span class="glyphicon glyphicon-calendar" ></span></div>
<div class="col2">
<p <?php if($project->name == ''):?>style='display:none'<?php endif; ?> ><?php echo $project->name; ?></p>
<input <?php if($project->name == ''):?>style='display:inline-block'<?php endif; ?> type="text" onfocusout='UpdateProject(this, value)' placeholder="Enter the name of the project" autofocus></input>
<span class="glyphicon glyphicon-pencil" onclick='EditProject(this)'></span>
<span class="glyphicon glyphicon-trash" onclick='DeleteProject(<?php echo "\"$project->name\", this"; ?>)'></span></div>
</div>

<div class="TaskManager">
<div class="col1">
<span class="glyphicon glyphicon-plus"></span>
</div>
<div class="col2">

<input type="text" class="TaskInput" placeholder="Start typing here to create a task...">
<button onclick='AddTask(<?php echo "\"$project->name\", this"; ?>)'>Add Task</button>
</div>
</div>
<?php  foreach($project->tasks as $task){
	include __DIR__ . '/task.php';
}	?>
</div>