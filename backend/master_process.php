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
                SET    `code_status` = '3',
                       `status` = 'Заказ выполнен'
                WHERE `applications`.`id` = :id";

        $sql = $connect->prepare($sql);

        $sql->execute([':id' => $id_order]);
        $sql->fetch();

      $sql = "SELECT cs.id as cs_id,
                     es.id as es_id
              FROM `order_set` os
                   INNER JOIN `contract_set`cs on cs.id = os.id_contract_set
                   INNER JOIN `exec_set` es on es.id = cs.id_exec_set
              WHERE os.apl_id = $id_order";

      $sql = $connect->query($sql);

      $result = $sql->fetchAll();

      $cs_id = $result[0]['cs_id'];
      $es_id = $result[0]['es_id'];

      // Update contract_set

       $sql = "UPDATE `contract_set`
              SET    `res_set` = '$cost'
              WHERE id = :id";

      $sql = $connect->prepare($sql);

      $sql->execute([':id' => $cs_id]);
      $sql->fetch();

      // Update exec_set

      $sql = "UPDATE `exec_set`
            SET    `id_person` = $id_person
            WHERE id = :id";

    $sql = $connect->prepare($sql);

    $sql->execute([':id' => $es_id]);
    $sql->fetch();

}

header('Location: ../profile.php');
?>