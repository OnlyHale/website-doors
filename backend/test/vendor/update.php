<?php
require_once '../config/connect.php';

global $connect;

$id = $_POST['id'];
$fam = $_POST['fam'];
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$mobtel = $_POST['mobtel'];
$wapp = $_POST['wapp'];
$email = $_POST['email'];
$data_call = $_POST['data_call'];
$time_call = $_POST['time_call'];
$res_call = $_POST['res_call'];
$comment = $_POST['comment'];

mysqli_query($connect, "UPDATE `client` SET `fam` = '$fam', `fname` = '$fname ',
                    `sname` = '$sname', `mobtel` = '$mobtel', `wapp` = '$wapp',
                    `email` = '$email', `data_call` = '$data_call', `time_call` = '$time_call',
                    `res_call` = '$res_call', `comment` = '$comment' WHERE `client`.`id` = '$id'");

header('Location: /');
