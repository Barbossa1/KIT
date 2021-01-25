<?php

function loadUsersData($user_ids)
{
    $host = 'localhost';
    $user = 'root';
    $password = '123123';
    $database = 'database';

    $user_ids = explode(',', $user_ids);

    foreach ($user_ids as $user_id) {
        $db = mysqli_connect($host, $user, $password, $database);
        $sql = mysqli_query($db, 'SELECT * FROM users WHERE id = ' . $user_id);

        while ($user = $sql->fetch_object()) {
            $data['user_id'] = $user->name;
        }
        mysqli_close($db);
    }
    return $data;
}

function render($data)
{
    foreach ($data as $user_id => $name) {
        echo <<<HTML
   <a href="show_user.php?id=$user_id">$name</a>
HTML;
    }
}

$data = loadUsersData($_GET['user_ids']);
render($data);