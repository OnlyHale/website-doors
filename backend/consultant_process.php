<?php

require_once 'test/config/connect.php';

if($_POST['action'] == 'Confirm'){
    $id_order = $_POST['id'];

    $sql = "UPDATE `applications` SET `is_fresh` = '0' WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();

    // Order Measure
   /*
    $sql = "INSERT INTO `order_measure` (`id`, `id_client`, `id_contract_measure`, `data_measure`, `id_addr`)
                                        VALUES (NULL, NULL, NULL, NULL, NULL)";

    $sql = $connect->prepare($sql);

    $sql->fetch();
    */


}

if($_POST['action'] == 'Reject'){
    $id_order = $_POST['id'];

    $sql = "UPDATE `applications` SET `is_fresh` = '0' WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();
}

header('Location: ../profile.php');
?>