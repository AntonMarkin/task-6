<?php

include_once('connection.php');
$pdo = connectDB();

function getAllTasks($user_id)
{
    global $pdo;
    $query = $pdo->prepare('select * from tasks where user_id = ?');
    $query->execute(array($user_id));
    return $query;
}

function addTask($user_id, $description)
{
    global $pdo;
    $query = $pdo->prepare('insert into tasks (user_id, description, status) values(?, ?, ?)');
    $query->execute([$user_id, $description, 'Unready']);
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

function changeTaskStatus($id, $status, $user_id)
{
    global $pdo;
    $query = $pdo->prepare('update tasks set status = ? where user_id = ? and id = ?');
    $query->execute([$status, $user_id, $id]);
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

function deleteTask($id, $user_id)
{
    global $pdo;
    $query = $pdo->prepare('delete from tasks where user_id = ? and id = ?');
    $query->execute(array($user_id, $id));
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

function readyAllTasks($user_id)
{
    $tasks = getAllTasks($user_id);
    if (isset($tasks)) {
        foreach ($tasks as $task) {
            changeTaskStatus($task['id'], 'Ready', $task['user_id']);
        }
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

function removeAllTasks($user_id)
{
    $tasks = getAllTasks($user_id);
    if (isset($tasks)) {
        foreach ($tasks as $task) {
            deleteTask($task['id'], $task['user_id']);
        }
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
}

//add task
if (isset($_POST['add_task'])) {
    addTask(getUser()['id'],$_POST['description']);
}
//change task status
if (isset($_POST['change_task_status'])) {
    $id = $_POST['id'];
    settype($id, 'int');
    changeTaskStatus($id, $_POST['status'], getUser()['id']);
}
//delete task
if (isset($_POST['delete_task'])) {
    $id = $_POST['id'];
    settype($id, 'int');
    deleteTask($id, getUser()['id']);
}
//ready all tasks
if (isset($_POST['ready_all_tasks'])) {
    readyAllTasks(getUser()['id']);
}
//remove all tasks
if (isset($_POST['remove_all_tasks'])) {
    removeAllTasks(getUser()['id']);
}
