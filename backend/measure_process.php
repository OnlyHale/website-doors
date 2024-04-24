<?php

require_once 'test/config/connect.php';

if($_POST['action'] == 'Confirm'){
    $id_order = $_POST['id'];
    $data = $_POST['data'];
    $data_set = $_POST['data_set'];
    $door = $_POST['door'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $cost = $_POST['cost'];

    // Client

    $sql = "SELECT client_id, addr_id FROM `applications` WHERE id = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $result = $sql->fetchAll();

    $id_client = $result[0]['client_id'];
    $id_address = $result[0]['addr_id'];

    //Cost

    if (preg_match('/[^0-9.,]/', $cost)) {
             $cost = "3000";
           }

    // Door

    $sql = "SELECT id
            FROM `door`
            WHERE `door`.param_door = '$door'";

    $sql = $connect->query($sql);

    $result = $sql->fetchAll();
    if($result) {
        $door_id = $result[0]['id'];
    }else {
        $door_id = 4;
    }



    // Data

   if (preg_match('/[^0-9.]/', $data) or strlen($data) < 3) {
           $timestamp = strtotime('+3 hours');
       } else {
           $timestamp = strtotime($data);
           $timestamp = $timestamp + 3 * 3600;
       }

   $data = date('d.m.Y', $timestamp);

   // Data_set

      if (preg_match('/[^0-9.]/', $data_set) or strlen($data_set) < 3) {
              $timestamp_set = strtotime('+3 hours');
          } else {
              $timestamp_set = strtotime($data_set);
              $timestamp_set = $timestamp + 3 * 3600;
          }

      $data_set = date('d.m.Y', $timestamp_set);

    //Applications

    $sql = "UPDATE `applications`
            SET    `code_status` = '2',
                   `time` = $timestamp,
                   `door_id` = $door_id,
                   `status` = 'Позвоним вам и сделаем монтаж'
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();

    // SELECT Contract measure

    $sql = "SELECT om.id_contract_measure as id
            FROM `order_measure` om
            WHERE om.apl_id = $id_order";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $contract_measure_id = $result[0]['id'];

    //Contract Set

    $sql = "INSERT INTO `contract_set` (`id`, `id_contract_measure`, `id_exec_set`, `id_door`, `sum_set`, `res_set`, `comment`)
                                                         VALUES (NULL, $contract_measure_id, NULL, $door_id, NULL, NULL, NULL)";

    $sql = $connect->query($sql);

    $id_contract_set = $connect->lastInsertId();

    //Exec set

    $sql = "INSERT INTO `exec_set` (`id`, `id_contract_set`, `id_person`)
                              VALUES (NULL, $id_contract_set, NULL)";

    $sql = $connect->query($sql);

    $id_exec_set = $connect->lastInsertId();

    //Update contract_set

     $sql = "UPDATE `contract_set`
             SET    `id_exec_set` = $id_exec_set
             WHERE `contract_set`.`id` = $id_contract_set";

     $sql = $connect->query($sql);

    //Update Contract Measure

     $sql = "UPDATE `contract_measure`
             SET    `id_contract_set` = $id_contract_set,
                    `cost_measure` = $cost
             WHERE `contract_measure`.`id` = $contract_measure_id";

     $sql = $connect->query($sql);

     //Order set

    $sql = "INSERT INTO `order_set` (`id`, `id_client`, `id_contract_set`, `data_set`, `id_addr`, `apl_id`)
                                        VALUES (NULL, $id_client, $id_contract_set, '$data_set', $id_address, $id_order)";

    $sql = $connect->query($sql);

}

if($_POST['action'] == 'Reject'){
    $id_order = $_POST['id'];

    $sql = "UPDATE `applications`
            SET `code_status` = '-1',
                `status` = 'Заказ отклонён'
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();
}

header('Location: ../profile.php');
?>