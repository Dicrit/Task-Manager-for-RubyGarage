function myHTTP() {
this.sendHTTP = function(query, str)
{
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				console.log("resp: "+this.responseText);
				myHttp.onAnswer(this.responseText);
            }
        };
		xmlhttp.open("GET", "index.php?query="+query+"&value=" + str, true);
        xmlhttp.send();
},
this.onAnswer = function(response)
{
	
}
}
var busy = false;
function AskProject() {
	if (busy) {Warning("please, finish another task before creating project"); return;}
	busy = true;
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
        var btn = document.getElementById("AddProjectButton");
		var projectText = document.createElement("ul");
		btn.parentElement.insertBefore(projectText, btn);
		console.log(projectText.parentNode);
		projectText.outerHTML = response;
		console.log(projectText.parentNode);
	}
	myHttp.sendHTTP("askProject", "");
}
function AddProject(str) {
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
        var btn = document.getElementById("AddProjectButton");
		var projectText = document.createElement("ul");
		btn.parentElement.insertBefore(projectText, btn);
		projectText.outerHTML = response;
	}
	myHttp.sendHTTP("newProject", str);
}

function DeleteProject(name, node)
{
	myHttp = new myHTTP();
	node.parentNode.parentNode.parentNode.parentNode.removeChild(node.parentNode.parentNode.parentNode);
	myHttp.sendHTTP("deleteProject", name);
}
function AddTask(ProjectName, node)
{
	if (busy) {Warning("please, finish another task before"); return;}
	var taskText = node.parentNode.children[0].value;
	if (taskText == "") {Warning("Empty Task isn't allowed."); return;}
	node.parentNode.children[0].value = "";
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
		if (response == "") {Warning("Can't create task.\nMaybee you've entered the existing task name"); return;}
		var task = document.createElement("ul");
		node.parentNode.parentNode.parentNode.appendChild(task);
		task.outerHTML = response;
	}
	myHttp.sendHTTP("addTask",ProjectName+"&text="+taskText);
}
function DeleteTask(taskName, projectName, node){
	myHttp = new myHTTP();
	//node.parentNode.parentNode.parentNode.parentNode.removeChild(node.parentNode.parentNode.parentNode);
	node.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(
	node.parentNode.parentNode.parentNode.parentNode
	);
	myHttp.sendHTTP("deleteTask", projectName+"&taskName="+taskName);
	
}

function EditProject(node){
	if (busy) {Warning("please, finish another task"); return;}
	busy = true;
	var p = node.parentNode.children[0];
	var inp = node.parentNode.children[1];
	inp.value = p.innerText;
	p.style.display = 'none';
	inp.style.display = 'inline-block';
	inp.focus();
}
function UpdateProject(node, projectName){
	if (projectName == "") {Warning("Empty project name!!!"); return; }
	var p = node.parentNode.children[0];
	var inp = node.parentNode.children[1];
	var oldname = p.innerText;
	//p.innerText = inp.value;
	inp.style.display = 'none';
	p.style.display = 'inline-block';
	if (inp.value == oldname){ busy = false; return;}
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
		if (response == "") {Warning("Error while editing project.\nMaybee you've entered the existing project name"); return;}
		var Project = node.parentNode.parentNode.parentNode;
		Project.outerHTML = response;
	}
	myHttp.sendHTTP("updateProject",oldname+"&newName="+ projectName);
	busy = false;
}

function EditTask(node){
	if (busy) {Warning("please, finish another task"); return;}
	busy = true;
	var p = node.parentNode.parentNode.parentNode.children[0];
	var inp = node.parentNode.parentNode.parentNode.children[1];
	inp.value = p.innerText;
	p.style.display = 'none';
	inp.style.display = 'inline-block';
	inp.focus();
}


function UpdateTask(node, projectName){
	var p = node.parentNode.children[0];
	var inp = node.parentNode.children[1];
	var oldname = p.innerText;
	var newName = inp.value;
	//p.innerText = inp.value;
	inp.style.display = 'none';
	p.style.display = 'inline-block';
	if (newName == oldname) {busy = false; return;} 
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
		if (response == "") {Warning("Error while editing task.\nMaybee you've entered the existing task name"); return;}
		//p.innerText = inp.value;//TODO Task Needs to be loaded!
		var task = node.parentNode.parentNode;
		task.outerHTML = response;
	}
	myHttp.sendHTTP("updateTask",projectName+"&oldName="+oldname+"&newName="+ newName);
	busy = false;
}

function UpPriority(node, projectName){
	var name = node.parentNode.parentNode.parentNode.children[0].innerText;
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
		var Project = node.parentNode.parentNode.parentNode.parentNode.parentNode;
		Project.outerHTML = response;
	}
	myHttp.sendHTTP("upPriority",projectName+"&taskName="+name);
}
function DownPriority(node, projectName){
	var name = node.parentNode.parentNode.parentNode.children[0].innerText;
	myHttp = new myHTTP();
	myHttp.onAnswer = function(response){
		var Project = node.parentNode.parentNode.parentNode.parentNode.parentNode;
		Project.outerHTML = response;
	}
	myHttp.sendHTTP("downPriority",projectName+"&taskName="+name);
}
function Warning(message){
	alert(message);
}

function setDone(taskName, projectName, node)
{
	var val = node.checked;
	//node.checked = val;
	myHttp = new myHTTP();
	myHttp.sendHTTP("setDone", projectName+"&taskName="+taskName + "&status="+val);
}