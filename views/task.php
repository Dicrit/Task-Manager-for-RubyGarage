<div class="Task">
<div class="col1">
<input type="checkbox" onchange='setDone(<?php echo "\"$task->name\",\"$project->name\", this"; ?>)' <?php if($task->status) echo "checked" ?>>
</div>
<div class="col2">
<span><?php echo $task->name; ?></span>
<input type="text" onfocusout='UpdateTask(this, <?php echo "\"$project->name\""; ?>)'></input>
<div class="TaskEdit">
<div><span class="glyphicon glyphicon-eject" onclick='UpPriority(this, <?php echo "\"$project->name\""; ?> )'></span>
<span class="glyphicon glyphicon-triangle-bottom" onclick='DownPriority(this, <?php echo "\"$project->name\""; ?> )'></span></div>
<div><span class="glyphicon glyphicon-pencil" onclick="EditTask(this)"></span></div>
<div><span class="glyphicon glyphicon-trash" onclick='DeleteTask(<?php echo "\"$task->name\",\"$project->name\", this"; ?>)'></span></div>
</div>
</div>
</div>