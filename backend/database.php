<?php
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method !== 'POST') {
        exit();
    }
    session_start();

    require_once 'test/config/connect.php';

    global $connect;

    $door = $_POST['дверь'];
    $price = $_POST['цена'];
    $name = $_POST['имя'];
    $phone = $_POST['телефон'];
    $address = $_POST['адрес'];

    // Client

    $phone = str_replace(array( '(', ')', ' ', '+', '-' ), '', $phone);

    $sql = "SELECT id FROM `client` WHERE mobtel = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();

    if($phone[0] == '7') {
       $phone[0] = '8';
    }

    if(count($result) == 0) {

        date_default_timezone_set('Europe/Moscow');

        $data_call = date("Y-m-d");
        $time_call = date("H:i:s");
        $res_call = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `client` (`id`, `fam`, `fname`,
                          `sname`, `mobtel`, `wapp`, `email`, `data_call`,
                          `time_call`, `res_call`, `comment`)
                          VALUES (NULL, NULL, :name, NULL, :phone, NULL, NULL,
                                  '$data_call', '$time_call', '$res_call', NULL)";

        $sql = $connect->prepare($sql);

        $sql->execute(array(':name' => $name, ':phone' => $phone));
        $sql->fetch();

        $sql = "SELECT id FROM `client` WHERE mobtel = :phone";

        $sql = $connect->prepare($sql);

        $sql->execute([':phone' => $phone]);
        $result = $sql->fetchAll();
    }

    $id_client = $result[0]['id'];

    // Address

    $sql = "SELECT id FROM `address` WHERE name = :address";

    $sql = $connect->prepare($sql);

    $sql->execute([':address' => $address]);
    $result = $sql->fetchAll();

    if(count($result) == 0) {

        $sql = "INSERT INTO `address` (`id`, `name`)
                          VALUES (NULL, :address)";

        $sql = $connect->prepare($sql);

        $sql->execute([':address' => $address]);
        $sql->fetch();

        $sql = "SELECT id FROM `address` WHERE name = :address";

        $sql = $connect->prepare($sql);

        $sql->execute([':address' => $address]);
        $result = $sql->fetchAll();
    }

    $addr_id = $result[0]['id'];

    //Door

    $sql = "SELECT id FROM `door` WHERE param_door = :name";

    $sql = $connect->prepare($sql);

    $sql->execute([':name' => $door]);
    $result = $sql->fetchAll();

    $id_door = $result[0]['id'];

    $time = strtotime("+ 3 hours");

    $sql = "INSERT INTO `applications` (`id`, `client_id`, `status`, `door_id`, `code_status`, `addr_id`, `time`)
                   VALUES (NULL, $id_client, 'Позвоним вам и уточним данные', $id_door, 0, $addr_id, $time)";

    $connect->query($sql);

    $id_order = $connect->lastInsertId();

    $_SESSION['apl'] = $id_order;