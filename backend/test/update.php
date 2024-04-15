<?php
require_once 'config/connect.php';

global $connect;

$client_id = $_GET['id'];
$client = mysqli_query($connect, "SELECT * FROM `client` WHERE `id` = '$client_id'");
$client = mysqli_fetch_assoc($client);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update client</title>
</head>
<body>
    <h3>Обновить данные клиента</h3>
    <form action="vendor/update.php" method="post">
        <input type="hidden" name ="id" value = <?= $client['id']?>>
        <p>fam</p>
        <input type="text" name="fam" value = "<?= $client['fam'] ?>">
        <p>fname</p>
        <input type="text" name="fname" value = "<?= $client['fname'] ?>">
        <p>sname</p>
        <input type="text" name="sname" value = "<?= $client['sname'] ?>">
        <p>mobtel</p>
        <input type="text" name="mobtel" value = "<?= $client['mobtel'] ?>">
        <p>wapp</p>
        <input type="text" name="wapp" value = "<?= $client['wapp'] ?>">
        <p>email</p>
        <input type="text" name="email" value = "<?= $client['email'] ?>">
        <p>data_call</p>
        <input type="text" name="data_call" value = "<?= $client['data_call'] ?>">
        <p>time_call</p>
        <input type="text" name="time_call" value = "<?= $client['time_call'] ?>">
        <p>res_call</p>
        <input type="text" name="res_call" value = "<?= $client['res_call'] ?>">
        <p>comment</p>
        <textarea name="comment"><?= $client['comment'] ?></textarea>
        <br><br>
        <button type="submit">Обновить</button>
    </form>
</body>
</html>