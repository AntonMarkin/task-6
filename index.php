<?php
session_start();

include_once('header.php');
include_once('task_functions.php');
include_once('auth_functions.php');

if (!isset($_SESSION["session_username"])) {
    header("Location: auth_page.php");
}

?>
<div class="container py-4 pb-md-4 mx-auto text-center">

    <div class="mx-auto justify-content-center">
        <h2 class=" fw-normal">Список задач</h2>
        <hr>
        <form class="row mb-3 justify-content-center" method="post" action="">
            <div class="col-sm-5">
                <input class="form-control" type="text" name="description" placeholder="Enter text..."></div>
            <div class="col-sm-1">
                <input class="btn btn-dark" name="add_task" type="submit" value="ADD TASK">
            </div>
        </form>
        <form method="post" action="">
            <input class="btn btn-danger col-sm-2" name="remove_all_tasks" type="submit" value="REMOVE ALL">
            <input class="btn btn-success col-sm-2" name="ready_all_tasks" type="submit" value="READY ALL">
        </form>
        <hr>

        <div class="row row-cols-1 row-cols-md-1 mb-3 mx-auto justify-content-center">
            <?php
            $tasks = getAllTasks(getUser()['id']);
            if (isset($tasks)) {
                foreach ($tasks as $task) {
                    $status = $task['status'];
                    $description = $task['description'];
                    if ($status == 'Unready') {
                        $buttonStatus = 'READY';
                        $button = 'btn-outline-success';
                        $statusClass = 'border-dark';
                        $newStatus = 'Ready';
                    } elseif ($status == 'Ready') {
                        $buttonStatus = 'UNREADY';
                        $text = 'text-success';
                        $button = 'btn-outline-dark';
                        $statusClass = 'border-success';
                        $newStatus = 'Unready';

                    }

                    echo ' <div class="col-auto ">
                <div class="card mx-auto mb-3 ' . $statusClass . ' border-3" style="max-width: 30rem;">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body ' . $text . '">

                                <p>' . $description . '</p>

                                <ul class="nav nav-pills">
                                    <li class="nav-item col">

                                        <form method="post" action="">
                                            <input type="hidden" name="id" value="' . $task['id'] . '">
                                            <input type="hidden" name="status" value="' . $newStatus . '">
                                            <input class="col-auto btn ' . $button . '" name="change_task_status" type="submit"
                                                   value="' . $buttonStatus . '">
                                        </form>

                                    </li>
                                    <li class="nav-item col">

                                        <form method="post" action="">
                                            <input type="hidden" name="id" value="' . $task['id'] . '">
                                            <input class="col-auto btn btn-outline-danger" name="delete_task" type="submit" value="DELETE">
                                        </form>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
            }
            ?>
        </div>
    </div>
</div>
<?php

include_once('footer.php');

?>

