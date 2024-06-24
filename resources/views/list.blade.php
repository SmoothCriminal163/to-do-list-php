<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
            overflow-y: auto; /* Ensure scrollability */
            max-height: 90vh;  /* Ensure it doesn't exceed viewport height */
        }
        h1 {
            margin: 0 0 20px;
            font-size: 28px;
            text-align: center;
            color: #007bff;
        }
        .todo-input {
            display: flex;
            margin-bottom: 20px;
        }
        .todo-input input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .todo-input .input-group-append button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .todo-input .input-group-append button:hover {
            background-color: #0056b3;
        }
        .list-group-item {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .list-group-item .d-flex {
            justify-content: space-between;
            align-items: center;
        }
        .list-group-item .btn-danger {
            font-size: 14px;
            padding: 5px 10px;
        }
        .description {
            margin-top: 10px;
            background: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .btn-success {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>To-Do List</h1>
    <div class="todo-input">
        <form action="{{ route('tasks.create') }}" method="POST" class="mb-4">
            @csrf
            <input name="task_name" type="text" placeholder="Add a new task">
            <input name="task_description" type="text" class="form-control" placeholder="Add a description">
            <button type="submit">Add</button>
        </form>
    </div>
    <ul class="todo-list">
        @foreach ($allTasks as $task)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $task->title }}</span>
                    <div>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="mt-2">
                    <p>{{ $task->description }}</p>
                </div>
                <div>
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
