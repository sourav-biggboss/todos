<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


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
                <div id="todo-form" class="needs-validation" novalidate>
                    <!-- Task Title -->
                    <div class="form-group">
                        <label for="task">Task Title:</label>
                        <input type="text" class="form-control rounded-0" id="title" name="task" required>
                        <div class="invalid-feedback rounded-0" id="invalid-title">
                            Please enter a Task Title.
                        </div>
                    </div>
        
                    <!-- description Notes -->
                    <div class="form-group mt-2">
                        <label for="notes">Task Description:</label>
                        <textarea class="form-control rounded-0" id="description" name="notes" rows="4"></textarea>
                        <div class="invalid-feedback rounded-0" id="invalid-desc">
                            Please enter a Task Description.
                        </div>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" id="todo-form-btn" onclick="createTask()" class="btn btn-dark rounded-0 mt-3">Add Task</button>
                    <button type="button" id="updateToCreate" onclick="updateToCreate()" class="btn btn-danger rounded-0 mt-3" style="display:none;float: right;">Add Task</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="container" style="margin-top: 10px;">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active rounded-0" data-bs-toggle="tab" href="#msg">Pending Task</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link rounded-0" data-bs-toggle="tab" href="#pro">Completed Task</a>
                      </li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane mt-2 active" id="msg">
                        
                        <div class="list-group" id="task-list">
                            @foreach($taskData as $task)
                                <div  class="list-group-item list-group-item-action rounded-0" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$task->title}}</h5>
                                    </div>
                                    <p class="mb-1">{{$task->description}}</p>
                                    <div class="btn-group">
                                    <button type="button" value="{{$task->id}}" onclick="completeBtn()" class="btn btn-dark complete-btn"> <i class="bi-check-square-fill"></i> Completed</button>
                                    <button type="button" value="{{$task->id}}" onclick="editBtn()" class="btn btn-dark edit-btn"> <i class="bi-pencil-square"></i> Edit</button>
                                    <button type="button" value="{{$task->id}}" onclick="deleteBtn()" class="btn btn-dark delete-btn"> <i class="bi-trash-fill"></i> Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                      </div>
                      <div class="tab-pane mt-2 fade" id="pro">
                        
                      <div class="list-group" id="task-list-done">
                            @foreach($taskDataDone as $taskdone)
                                <div  class="list-group-item list-group-item-action rounded-0" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$taskdone->title}}</h5>
                                    </div>
                                    <p class="mb-1">{{$taskdone->description}}</p>
                                    <div class="btn-group">
                                    <button type="button" value="{{$taskdone->id}}" onclick="editBtn()"  class="btn btn-dark edit-btn"> <i class="bi-pencil-square"></i> Edit</button>
                                    <button type="button" value="{{$taskdone->id}}"  onclick="deleteBtn()"  class="btn btn-dark delete-btn"> <i class="bi-trash-fill"></i> Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                      </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>