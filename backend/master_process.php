<?php

require_once 'test/config/connect.php';

if($_POST['action'] == 'Confirm') {
    $id_order = $_POST['id'];
    $cost = $_POST['cost'];
    $worker = $_POST['worker'];

    //Cost

    if (preg_match('/[^0-9.,]/', $cost)) {
             $cost = "50000";
    }

    //Worker

    if($worker == "") {
        $sql = "SELECT id
                FROM `person`
                WHERE role = 'worker'
                LIMIT 1";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $id_person = $result[0]['id'];
    } else {
        $parts = explode(" ", $worker);
        $fam = $parts[0];
        $fname = $parts[1];
        $sql = "SELECT id
                FROM `person` p
                WHERE p.fam = '$fam' and
                      p.fname = '$fname'";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $id_person = $result[0]['id'];
    }

    // Applications

     $sql = "UPDATE `applications`
                SET    `code_status` = '2',
                       `time` = $timestamp,
                       `door_id` = $door_id,
                       `status` = 'Позвоним вам и сделаем монтаж'
                WHERE `applications`.`id` = :id";

        $sql = $connect->prepare($sql);

        $sql->execute([':id' => $id_order]);
        $sql->fetch();


}

header('Location: ../profile.php');
?>