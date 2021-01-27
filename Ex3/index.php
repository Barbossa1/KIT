<?php

function getUsers($userIDs)
{
    $data = array();
    $connectDB = mysqli_connect(
        "localhost",
        "root",
        "123123",
        "database"
    );
    if (!$connectDB) {
        throw new Exception("Невозможно получить даныне");
    }
    if (count($userIDs) != 0) {
        $sql = mysqli_query(
            $connectDB,
            "SELECT `id`,`name` FROM users WHERE id IN (" . implode(",", $userIDs) . ")"
        );
        while ($obj = $sql->fetch_object()) {
            $data[$obj->id] = $obj->name;
        }
    }
    mysqli_close($connectDB);
    return $data;
}

if (isset($_GET['user_ids'])) {
    $getIDs = explode(',', $_GET['user_ids']);
    $IDs = array();
    foreach ($getIDs as $getID) {
        $IDs[] = intval($getID);
    }
    if (count($IDs) != 0) {
        try {
            $data = getUsers($IDs);
            foreach ($data as $userID => $name) {
                echo "<a href=\"/show_user.php?id=$userID\">$name</a>";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}