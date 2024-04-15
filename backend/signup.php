<?php
    session_start();

    require_once 'test/config/connect.php';

    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if(!($phone and $password and $password_confirm)) {
        $_SESSION['msg'] = 'Не все поля заполнены';
        header('Location: ../reg.php');
        die();
    }

    if($password != $password_confirm) {
        $_SESSION['msg'] = 'Пароли не совпадают';
        header('Location: ../reg.php');
        die();
    }

    $phone = str_replace(array( '(', ')', ' ', '+', '-' ), '', $phone);

    if($phone[0] == '7') {
        $phone[0] = '8';
    }

    $sql = "SELECT id FROM `users` WHERE phone = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();

    if(count($result) == 1){
        $_SESSION['msg'] = 'Такой пользователь уже существует';
        header('Location: ../reg.php');
        die();
    }

    $sql = 'INSERT INTO `users` (`id`, `phone`, `password`, `role`) VALUES (NULL, :phone, :password, "client")';

    $sql = $connect->prepare($sql);

    $password = md5($password);

    $sql->execute(array(':phone' => $phone, ':password' => $password));
    $sql->fetch();



    //Client


    $sql = "SELECT id FROM `client` WHERE mobtel = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();

    if(count($result) == 0){
        date_default_timezone_set('Europe/Moscow');

        $data_call = date("Y-m-d");
        $time_call = date("H:i:s");
        $res_call = date("Y-m-d H:i:s");

        $name = "Клиент#".time()%365;

        $sql = "INSERT INTO `client` (`id`, `fam`, `fname`,
                          `sname`, `mobtel`, `wapp`, `email`, `data_call`,
                          `time_call`, `res_call`, `comment`)
                          VALUES (NULL, NULL, '$name', NULL, :phone, NULL, NULL,
                                  '$data_call', '$time_call', '$res_call', NULL)";

        $sql = $connect->prepare($sql);

        $sql->execute([':phone' => $phone]);
        $sql->fetch();
    }

    $sql = "SELECT id, fname, mobtel FROM `client` WHERE mobtel = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();

    $_SESSION['user']['id'] = $result[0]['id'];
    $_SESSION['user']['name'] = $result[0]['fname'];

    $sql = "SELECT role FROM `users` WHERE phone = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();
    $_SESSION['user']['role'] = $result[0]['role'];
    header('Location: ../profile.php');