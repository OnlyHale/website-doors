<?php
    session_start();

    require_once 'test/config/connect.php';

    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if(!($phone and $password)) {
        $_SESSION['msg'] = 'Не все поля заполнены';
        header('Location: ../auth.php');
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

    if(count($result) == 0){
        $_SESSION['msg'] = 'Такого пользователя не существует';
        header('Location: ../auth.php');
        die();
    }

    $password = md5($password);

    $sql = "SELECT password FROM `users` WHERE phone = :phone";

    $sql = $connect->prepare($sql);

    $sql->execute([':phone' => $phone]);
    $result = $sql->fetchAll();

    $real_password = $result[0]['password'];

    if($password != $real_password) {
        $_SESSION['msg'] = 'Неправильный логин или пароль';
        header('Location: ../auth.php');
        die();
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
