<?php
require_once '../config/connect.php';

global $connect;

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

mysqli_query($connect, "INSERT INTO `client` (`id`, `fam`, `fname`,
                      `sname`, `mobtel`, `wapp`, `email`, `data_call`,
                      `time_call`, `res_call`, `comment`) 
                      VALUES (NULL, '$fam', '$fname', '$sname', '$mobtel', '$wapp', '$email',
                              '$data_call', '$time_call', '$res_call', '$comment')");

header('Location: /');
