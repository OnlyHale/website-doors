<?php

require_once 'connect.php';

function getFromDataBase($name)
{
    global $connect;

    if(!empty($_GET['id'])) {
        $sql = "select * from `$name` WHERE id = :id";
        $id = $_GET['id'];
        $sql = $connect->prepare($sql);
        $sql->execute(['id' => $id]);
        $result = $sql->fetchAll();
    }else {
        $result = $connect->query("select * from `$name`")->fetchAll();
    }

    if(!$result) die('Error select');

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}