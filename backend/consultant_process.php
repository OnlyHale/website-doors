<?php

require_once 'test/config/connect.php';

if($_POST['action'] == 'Confirm'){
    $id_order = $_POST['id'];
    $data = $_POST['data'];
    $door = $_POST['door'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $measure = $_POST['measure'];

    // Data

   if (preg_match('/[^0-9.]/', $data) or strlen($data) < 3) {
           $timestamp = strtotime('+3 hours');
       } else {
           $timestamp = strtotime($data);
           $timestamp = $timestamp + 3 * 3600;
       }

   $data = date('d.m.Y', $timestamp);

    // Name

    $sql = "SELECT client_id, addr_id FROM `applications` WHERE id = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $result = $sql->fetchAll();

    $id_client = $result[0]['client_id'];
    $id_address = $result[0]['addr_id'];

    $sql = "UPDATE `client`
            SET    `fname` = :name
            WHERE `client`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute(array(':name' => $name, ':id' => $id_client));
    $sql->fetch();

    // Address

    $sql = "SELECT id FROM `address` WHERE name = :name";

    $sql = $connect->prepare($sql);

    $sql->execute([':name' => $address]);
    $result = $sql->fetchAll();
    if($result){
        $id_address = $result[0]['id'];
    }

    if(!$result) {
        $sql = "INSERT INTO `address` (`id`, `name`)
                                  VALUES (NULL, :name)";

        $sql = $connect->prepare($sql);

        $sql->execute([':name' => $address]);
        $sql->fetch();

        $sql = "SELECT id FROM `address` WHERE name = :name";

        $sql = $connect->prepare($sql);

        $sql->execute([':name' => $address]);
        $result = $sql->fetchAll();

        $id_address = $result[0]['id'];
    }

    $sql = "UPDATE `applications`
            SET    `addr_id` = $id_address
            WHERE `applications`.`id` = :id";

            $sql = $connect->prepare($sql);

            $sql->execute([':id' => $id_order]);
            $sql->fetch();

    //Measure

    if($measure == "") {
        $sql = "SELECT id
                FROM `person`
                WHERE role = 'measure'
                LIMIT 1";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $id_person = $result[0]['id'];
    } else {
        $parts = explode(" ", $measure);
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

    //Applications

    $sql = "UPDATE `applications`
            SET    `code_status` = '1',
                   `time` = $timestamp,
                   `status` = 'Позвоним вам и сделаем замер'
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();


    // Contract Measure

     $sql = "INSERT INTO `contract_measure` (`id`, `id_contract_set`, `id_exec_measure`, `res_measure`, `cost_measure`, `comment`)
                                                     VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

     $sql = $connect->query($sql);

     $id_contract = $connect->lastInsertId();

    // Exec measure
     $sql = "INSERT INTO `exec_measure` (`id`, `id_contract_measure`, `id_person`)
                                                 VALUES (NULL, $id_contract, $id_person)";

     $sql = $connect->query($sql);

     $id_exec = $connect->lastInsertId();

     // Contract measure

     $sql = "UPDATE `contract_measure`
             SET    `id_exec_measure` = $id_exec
             WHERE id = $id_contract";

     $sql = $connect->query($sql);

     //Order measure

    $sql = "INSERT INTO `order_measure` (`id`, `id_client`, `id_contract_measure`, `data_measure`, `id_addr`, `apl_id`)
                                        VALUES (NULL, $id_client, $id_contract, '$data', $id_address, $id_order)";

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

if($_POST['action'] == 'Return'){
    $id_order = $_POST['id'];

    $sql = "SELECT code_status
            FROM `applications`
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);

    $result = $sql->fetchAll();

    $code_status = $result[0]['code_status'];
    if($code_status == 1) {
        $sql = "SELECT om.id as om_id,
                       cm.id as cm_id,
                       em.id as em_id
                FROM `applications` apl
                     INNER JOIN `client` c on apl.client_id = c.id
                     INNER JOIN `order_measure` om on om.apl_id = apl.id
                     INNER JOIN `contract_measure`cm on cm.id = om.id_contract_measure
                     INNER JOIN `exec_measure` em on em.id = cm.id_exec_measure
                WHERE apl.id = $id_order";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $om_id = $result[0]['om_id'];
        $cm_id = $result[0]['cm_id'];
        $em_id = $result[0]['em_id'];
        // Contract Measure

         $sql = "DELETE FROM `contract_measure` WHERE id = $cm_id";

         $sql = $connect->query($sql);

        // Exec measure
         $sql = "DELETE FROM `exec_measure` WHERE id = $em_id";

         $sql = $connect->query($sql);

         //Order measure

        $sql = "DELETE FROM `order_measure` WHERE id = $om_id";

        $sql = $connect->query($sql);
    }

    $sql = "UPDATE `applications`
                SET `code_status` = '0',
                    `status` = 'Позвоним вам и уточним данные'
                WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();
}

if($_POST['action'] == 'Update'){
    $id_order = $_POST['id'];
    $data = $_POST['data'];
    $door = $_POST['door'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $measure = $_POST['measure'];

    // Data

   if (preg_match('/[^0-9.]/', $data) or strlen($data) < 3) {
           $timestamp = strtotime('+3 hours');
       } else {
           $timestamp = strtotime($data);
           $timestamp = $timestamp + 3 * 3600;
       }

   $data = date('d.m.Y', $timestamp);

    // Name

    $sql = "SELECT client_id, addr_id FROM `applications` WHERE id = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $result = $sql->fetchAll();

    $id_client = $result[0]['client_id'];
    $id_address = $result[0]['addr_id'];

    $sql = "UPDATE `client`
            SET    `fname` = :name
            WHERE `client`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute(array(':name' => $name, ':id' => $id_client));
    $sql->fetch();

    //Applications

    $sql = "UPDATE `applications`
            SET   `time` = $timestamp
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();


    // Address

    $sql = "SELECT id FROM `address` WHERE name = :name";

    $sql = $connect->prepare($sql);

    $sql->execute([':name' => $address]);
    $result = $sql->fetchAll();

    if($result){
        $id_address = $result[0]['id'];
    }

    if(!$result) {


        $sql = "INSERT INTO `address` (`id`, `name`)
                                  VALUES (NULL, :name)";

        $sql = $connect->prepare($sql);

        $sql->execute([':name' => $address]);
        $sql->fetch();

        $sql = "SELECT id FROM `address` WHERE name = :name";

        $sql = $connect->prepare($sql);

        $sql->execute([':name' => $address]);
        $result = $sql->fetchAll();

        $id_address = $result[0]['id'];
    }

    $sql = "UPDATE `applications`
            SET    `addr_id` = $id_address
            WHERE `applications`.`id` = :id";

            $sql = $connect->prepare($sql);

            $sql->execute([':id' => $id_order]);
            $sql->fetch();

    //Measure

    if($measure == "") {
        $sql = "SELECT id
                FROM `person`
                WHERE role = 'measure'
                LIMIT 1";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $id_person = $result[0]['id'];
    } else {
        $parts = explode(" ", $measure);
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

    $sql = "SELECT code_status
            FROM `applications`
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);

    $result = $sql->fetchAll();

    $code_status = $result[0]['code_status'];
    if($code_status == 1) {
        $sql = "SELECT om.id as om_id,
                       cm.id as cm_id,
                       em.id as em_id
                FROM `applications` apl
                     INNER JOIN `client` c on apl.client_id = c.id
                     INNER JOIN `order_measure` om on om.apl_id = apl.id
                     INNER JOIN `contract_measure`cm on cm.id = om.id_contract_measure
                     INNER JOIN `exec_measure` em on em.id = cm.id_exec_measure
                WHERE apl.id = $id_order";

         $sql = $connect->query($sql);

         $result = $sql->fetchAll();

         $om_id = $result[0]['om_id'];
         $cm_id = $result[0]['cm_id'];
         $em_id = $result[0]['em_id'];
        // Exec measure
         $sql = "UPDATE `exec_measure`
                 SET id_person = $id_person
                 WHERE id = $em_id";

         $sql = $connect->query($sql);

         //Order measure

        $sql = "UPDATE `order_measure`
                SET data_measure = '$data',
                    id_addr = $id_address
                WHERE apl_id = $id_order";

        $sql = $connect->query($sql);
    }
}

if($_POST['action'] == 'Delete'){
    $id_order = $_POST['id'];

    $sql = "SELECT code_status
            FROM `applications`
            WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);

    $result = $sql->fetchAll();

    $code_status = $result[0]['code_status'];
    if($code_status == 1) {
        $sql = "SELECT om.id as om_id,
                       cm.id as cm_id,
                       em.id as em_id
                FROM `applications` apl
                     INNER JOIN `client` c on apl.client_id = c.id
                     INNER JOIN `order_measure` om on om.apl_id = apl.id
                     INNER JOIN `contract_measure`cm on cm.id = om.id_contract_measure
                     INNER JOIN `exec_measure` em on em.id = cm.id_exec_measure
                WHERE apl.id = $id_order";

        $sql = $connect->query($sql);

        $result = $sql->fetchAll();

        $om_id = $result[0]['om_id'];
        $cm_id = $result[0]['cm_id'];
        $em_id = $result[0]['em_id'];
        // Contract Measure

         $sql = "DELETE FROM `contract_measure` WHERE id = $cm_id";

         $sql = $connect->query($sql);

        // Exec measure
         $sql = "DELETE FROM `exec_measure` WHERE id = $em_id";

         $sql = $connect->query($sql);

         //Order measure

        $sql = "DELETE FROM `order_measure` WHERE id = $om_id";

        $sql = $connect->query($sql);
    }

    $sql = "UPDATE `applications`
                SET `is_delete` = '1'
                WHERE `applications`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $id_order]);
    $sql->fetch();
}

if($_POST['action'] == 'Create'){
    $data = $_POST['data'];
    $door = $_POST['door'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $measure = $_POST['measure'];

     // Data

       if (preg_match('/[^0-9.]/', $data) or strlen($data) < 3) {
               $timestamp = strtotime('+3 hours');
           } else {
               $timestamp = strtotime($data);
               $timestamp = $timestamp + 3 * 3600;
           }

       $data = date('d.m.Y', $timestamp);

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

    // Name

    $sql = "UPDATE `client`
            SET    `fname` = :name
            WHERE `client`.`id` = :id";

    $sql = $connect->prepare($sql);

    $sql->execute(array(':name' => $name, ':id' => $id_client));
    $sql->fetch();

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
    if($result) {
        $id_door = $result[0]['id'];
    } else {
        $id_door = 4;
    }

    //Measure

        if($measure == "") {
            $sql = "SELECT id
                    FROM `person`
                    WHERE role = 'measure'
                    LIMIT 1";

            $sql = $connect->query($sql);

            $result = $sql->fetchAll();

            $id_person = $result[0]['id'];
        } else {
            $parts = explode(" ", $measure);
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


    //Applications

    $sql = "INSERT INTO `applications` (`id`, `client_id`, `status`, `door_id`, `code_status`, `addr_id`, `time`)
                   VALUES (NULL, $id_client, 'Позвоним вам и сделаем замер', $id_door, 1, $addr_id, $timestamp)";

    $connect->query($sql);

    $id_order = $connect->lastInsertId();

    // Contract Measure

     $sql = "INSERT INTO `contract_measure` (`id`, `id_contract_set`, `id_exec_measure`, `res_measure`, `cost_measure`, `comment`)
                                                     VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

     $sql = $connect->query($sql);

     $id_contract = $connect->lastInsertId();

    // Exec measure
     $sql = "INSERT INTO `exec_measure` (`id`, `id_contract_measure`, `id_person`)
                                                 VALUES (NULL, $id_contract, $id_person)";

     $sql = $connect->query($sql);

     $id_exec = $connect->lastInsertId();

     // Contract measure

     $sql = "UPDATE `contract_measure`
             SET    `id_exec_measure` = $id_exec
             WHERE id = $id_contract";

     $sql = $connect->query($sql);

     //Order measure

    $sql = "INSERT INTO `order_measure` (`id`, `id_client`, `id_contract_measure`, `data_measure`, `id_addr`, `apl_id`)
                                        VALUES (NULL, $id_client, $id_contract, '$data', $addr_id, $id_order)";

    $sql = $connect->query($sql);
}

header('Location: ../profile.php');
?>