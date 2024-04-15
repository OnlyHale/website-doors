<?php
require_once 'config/connect.php';
?>


<!doctype html>
<html lang = "eu">
<head>
    <meta charset = "UTF-8">
    <title>Clients</title>
</head>
<style>
    th, td {
        padding: 10px;
    }

    th {
        background: #606060;
        color: white;
    }

    td {
        background: #b5b5b5;
        color: black;
    }
</style>
<body>
    <table>
        <tr>
            <th>id</th>
            <th>fam</th>
            <th>fname</th>
            <th>sname</th>
            <th>mobtel</th>
            <th>wapp</th>
            <th>email</th>
            <th>data_call</th>
            <th>time_call</th>
            <th>res_call</th>
            <th>comment</th>
        </tr>

        <?php
            global $connect;
            $clients = mysqli_query($connect, "SELECT * FROM `client`");
            $clients = mysqli_fetch_all($clients);
            foreach($clients as $client) {
        ?>
        <tr>
            <td><?= $client[0] ?></td>
            <td><?= $client[1] ?></td>
            <td><?= $client[2] ?></td>
            <td><?= $client[3] ?></td>
            <td><?= $client[4] ?></td>
            <td><?= $client[5] ?></td>
            <td><?= $client[6] ?></td>
            <td><?= $client[7] ?></td>
            <td><?= $client[8] ?></td>
            <td><?= $client[9] ?></td>
            <td><?= $client[10] ?></td>
            <td><a href = "update.php?id=<?= $client[0] ?>">Изменить</a></td>>
        </tr>
        <?php
            }
        ?>
    </table>
    <h3>Добавить нового клиента</h3>
    <form action="vendor/create.php" method="post">
        <p>fam</p>
        <input type="text" name="fam">
        <p>fname</p>
        <input type="text" name="fname">
        <p>sname</p>
        <input type="text" name="sname">
        <p>mobtel</p>
        <input type="text" name="mobtel">
        <p>wapp</p>
        <input type="text" name="wapp">
        <p>email</p>
        <input type="text" name="email">
        <p>data_call</p>
        <input type="text" name="data_call">
        <p>time_call</p>
        <input type="text" name="time_call">
        <p>res_call</p>
        <input type="text" name="res_call">
        <p>comment</p>
        <textarea name="comment"></textarea>
        <br><br>
        <button type="submit">Добавить нового клиента</button>
    </form>
</body>
</html>