<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <title>ToDo</title>
    <style>
        .nav-link{
            color:#000!important;
        }
        .form-control:focus {
            box-shadow: none!important;
            border:none!important;
            border-bottom: 2px solid #000!important;
        }
    </style>
  </head>
  <body>
    <div class="container mt-5">
        <h1 class="text-center">To-Do List</h1>

        <div class="row mt-3">
            <div class="col-sm-6">
                <div id="todo-form" action="#" class="needs-validation" novalidate>
                    <!-- Task Title -->
                    <div class="form-group">
                        <label for="task">Task Title:</label>
                        <input type="text" class="form-control rounded-0" id="title" name="task" required>
                        <div class="invalid-feedback rounded-0">
                            Please enter a Task Title.
                        </div>
                    </div>
        
                    <!-- description Notes -->
                    <div class="form-group mt-2">
                        <label for="notes">Task Description:</label>
                        <textarea class="form-control rounded-0" id="description" name="notes" rows="4"></textarea>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" id="todo-form-btn" class="btn btn-dark rounded-0 mt-3">Add Task</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="container" style="margin-top: 10px;">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active rounded-0" data-bs-toggle="tab" href="#msg">Upcoming Task</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link rounded-0" data-bs-toggle="tab" href="#pro">Pending Task</a>
                      </li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane mt-2 active" id="msg">
                        
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action rounded-0" aria-current="true">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Task Title lor</h5>
                              </div>
                              <p class="mb-1">Task description. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum ab eaque qui earum aliquid animi fugit enim quaerat nihil? Rerum delectus autem dignissimos? Architecto voluptas minus delectus iusto repudiandae dignissimos!</p>
                              <div class="btn-group">
                                <button type="button" class="btn btn-dark"> <i class="bi-check-square-fill"></i> Completed</button>
                                <button type="button" class="btn btn-dark"> <i class="bi-pencil-square"></i> Edit</button>
                                <button type="button" class="btn btn-dark"> <i class="bi-trash-fill"></i> Delete</button>
                              </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action rounded-0">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Task Title</h5>
                              </div>
                              <p class="mb-1">Task description. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam possimus tempora quia odio ab nemo! Alias a accusamus earum laboriosam officia autem quisquam optio similique rerum asperiores, quibusdam minus? Magni!</p>                            
                              <div class="btn-group">
                                <button type="button" class="btn btn-dark"> <i class="bi-check-square-fill"></i> Completed</button>
                                <button type="button" class="btn btn-dark"> <i class="bi-pencil-square"></i> Edit</button>
                                <button type="button" class="btn btn-dark"> <i class="bi-trash-fill"></i> Delete</button>
                              </div>
                            </a>
                        </div>

                      </div>
                      <div class="tab-pane container fade" id="pro">This is a profile tab.</div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#todo-form-btn").click(function(event) {
                createTask();
            });
           // Function to create a new task
        function createTask() {
            const title = $('#title').val();
            const description = $('#description').val();

            $.ajax({
                    type: 'POST',
                    url: '/api/tasks',
                    data: {
                        title: title,
                        description: description,
                        _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    },
                    success: function (data) {
                        // Handle success, e.g., show a success message or update the task list
                        console.log('Task created successfully');
                    },
                    error: function (error) {
                        // Handle error, e.g., display validation errors
                        console.error('Error creating task: ' + error.responseText);
                    },
            });
        }

            // Function to update a task's status
            function updateTaskStatus(taskId, newStatus) {
                $.ajax({
                    type: 'PUT',
                    url: `/api/tasks/${taskId}`,
                    data: {
                        status: newStatus,
                        _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    },
                    success: function (data) {
                        // Handle success, e.g., show a success message or update the task's status
                        console.log('Task status updated successfully');
                    },
                    error: function (error) {
                        // Handle error, e.g., display error message
                        console.error('Error updating task status: ' + error.responseText);
                    },
                });
            }

            // Function to delete a task
            function deleteTask(taskId) {
                $.ajax({
                    type: 'DELETE',
                    url: `/api/tasks/${taskId}`,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    },
                    success: function (data) {
                        // Handle success, e.g., remove the task from the list
                        console.log('Task deleted successfully');
                    },
                    error: function (error) {
                        // Handle error, e.g., display error message
                        console.error('Error deleting task: ' + error.responseText);
                    },
                });
            }

        });
    </script>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>