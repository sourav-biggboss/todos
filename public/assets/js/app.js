function updateToCreate (){
    document.getElementById('todo-form-btn').innerText = 'Add Task';
    document.getElementById("updateToCreate").style.display = 'none';
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    document.getElementById('todo-form-btn').setAttribute('onclick','createTask()');
}

function editBtn (){
    document.getElementById('todo-form-btn').innerText = 'Edit Task';
    document.getElementById("updateToCreate").style.display = 'block';
    document.getElementById('title').value = event.target.parentNode.parentNode.querySelector('h5').innerText;
    document.getElementById('description').value = event.target.parentNode.parentNode.querySelector('p').innerText;
    document.getElementById('todo-form-btn').setAttribute('onclick','editTask('+event.target.value+')');
};

function completeBtn (){
    updateTaskStatus(event.target.value,'Completed');
    event.target.parentNode.parentNode.remove();
};


function deleteBtn (){
    deleteTask(event.target.value);
    event.target.parentNode.parentNode.remove();
};
;
// Function to create a new task
function createTask() {
    if (document.getElementById('title').value == undefined || document.getElementById('title').value == null || document.getElementById('title').value.trim() == '' || !document.getElementById('title').value) {
        document.getElementById("invalid-title").style.display = 'block';
        return;
    }
    if (document.getElementById('description').value == undefined || document.getElementById('description').value == null || document.getElementById('description').value.trim() == '' || !document.getElementById('description').value) {
        document.getElementById("invalid-desc").style.display = 'block';
        return;
    }
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/tasks', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const taskHtml = `
                    <div  class="list-group-item list-group-item-action rounded-0" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${title}</h5>
                        </div>
                        <p class="mb-1">${description}</p>
                        <div class="btn-group">
                            <button type="button" value="${data.id}" onclick="completeBtn()" class="btn btn-dark complete-btn"> <i class="bi-check-square-fill"></i> Completed</button>
                            <button type="button" value="${data.id}" onclick="editBtn()" class="btn btn-dark edit-btn"> <i class="bi-pencil-square"></i> Edit</button>
                            <button type="button" value="${data.id}" onclick="deleteBtn()"  class="btn btn-dark delete-btn"> <i class="bi-trash-fill"></i> Delete</button>
                        </div>
                    </div>
                `;

                document.getElementById('task-list').insertAdjacentHTML('beforeend', taskHtml);
                console.log('Task created successfully');
                document.getElementById("invalid-title").style.display = 'none';
                document.getElementById("invalid-desc").style.display = 'none';
            } else {
                console.error('Error creating task: ' + xhr.responseText);
            }
        }
    };

    const data = {
        title: title,
        description: description
    };

    xhr.send(JSON.stringify(data));
}

// Function to update a task's status
function updateTaskStatus(taskId, newStatus) {

    const xhr = new XMLHttpRequest();
    xhr.open('PUT', `/api/tasks/${taskId}`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const taskHtml = `
                    <div  class="list-group-item list-group-item-action rounded-0" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${data.data.title}</h5>
                        </div>
                        <p class="mb-1">${data.data.description}</p>
                        <div class="btn-group">
                            <button type="button" value="${taskId}" onclick="editBtn()" class="btn btn-dark edit-btn"> <i class="bi-pencil-square"></i> Edit</button>
                            <button type="button" value="${taskId}" onclick="deleteBtn()" class="btn btn-dark delete-btn"> <i class="bi-trash-fill"></i> Delete</button>
                        </div>
                    </div>
                `;

                document.getElementById('task-list-done').insertAdjacentHTML('beforeend', taskHtml);
            } else {
                console.error('Error updating task status: ' + xhr.responseText);
            }
        }
    };

    const data = {
        status: newStatus
    };

    xhr.send(JSON.stringify(data));
}

// Function to delete a task
function deleteTask(taskId) {

    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', `/api/tasks/${taskId}`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log('Task deleted successfully');
            } else {
                console.error('Error deleting task: ' + xhr.responseText);
            }
        }
    };

    xhr.send();
}

// Function to update a task
function editTask(taskId) {
    if (document.getElementById('title').value == undefined || document.getElementById('title').value == null || document.getElementById('title').value.trim() == '' || !document.getElementById('title').value) {
        document.getElementById("invalid-title").style.display = 'block';
        return;
    }
    if (document.getElementById('description').value == undefined || document.getElementById('description').value == null || document.getElementById('description').value.trim() == '' || !document.getElementById('description').value) {
        document.getElementById("invalid-desc").style.display = 'block';
        return;
    }
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    const xhr = new XMLHttpRequest();
    xhr.open('PUT', `/api/tasks/${taskId}`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                document.querySelector('.edit-btn[value="'+taskId+'"]').parentElement.parentElement.querySelector('h5').innerText = title;
                document.querySelector('.edit-btn[value="'+taskId+'"]').parentElement.parentElement.querySelector('p').innerText = description;
                document.getElementById("invalid-title").style.display = 'none';
                document.getElementById("invalid-desc").style.display = 'none';
            } else {
                console.error('Error updating task status: ' + xhr.responseText);
            }
        }
    };

    const data = {
        title:title,
        description:description
    };

    xhr.send(JSON.stringify(data));
}