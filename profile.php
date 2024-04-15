<?php
 session_start();

 require_once 'backend/test/config/connect.php';


    if(!isset($_SESSION['user'])) {
     header('Location: ../auth.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700,900%7CRoboto:300&display=swap&subset=cyrillic" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">

  <meta name="description" content="Doors — межкомнатные двери">
  <meta name="keywords" content="двери">

  <meta property="og:title" content="Doors — межкомнатные двери" />
  <meta property="og:description" content="Doors — межкомнатные двери" />
  <meta property="og:image" content="img/section-top/bg.jpg" />

  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <title>Кабинет</title>
</head>
<body>

<!-- header-page -->
<header class="header-page">
  <div class="container header-page__container">
    <div class="header-page__start">
      <div class="logo">
          <a class="header-page__link" href="index.html">
            <span class="header-page__text">DOORS</span>
          </a>
      </div>
    </div>
    <div class="header-page_auth">
      Кабинет
    </div>
    <div class="header-page__end">
      <div class="phone">
        <a class="phone__item header-page__phone" href="tel:+79999999999">+7 (999) 999-99-99</a>
      </div>
    </div>
  </div>
</header>
<!-- /.header-page -->

<!-- profile -->
<section class="profile text">
    <div class = "profile-box">
        <div class="profile_info">
            <p class = "profile_text">Имя : <?= $_SESSION['user']['name'] ?></p>
            <?php
                if($_SESSION['user']['role'] != 'client'){
                    echo "<p class = 'profile_text'>Роль : ".$_SESSION['user']['role']."</p>";
                }
            ?>
        </div>
        <a class="profile_logout" href="logout.php">Выйти</a>
    <div>
</section>

<?php
    if($_SESSION['user']['role'] == 'client'){
        echo "<p class = 'profile_top_text'>Заказы</p><br>";
        $orders="";

        $id_client = $_SESSION['user']['id'];

        $sql = "SELECT d.param_door as param_door,
                       apl.status as status,
                       addr.name as name,
                       apl.time as time,
                       d.path as path
                FROM `applications` apl
                        INNER JOIN `address` addr on addr.id = apl.addr_id
                        INNER JOIN `door` d on d.id = apl.door_id
                WHERE apl.client_id = '$id_client' and
                      apl.is_delete = 0
                ORDER BY apl.time DESC";

        $sql = $connect->query($sql);

        $array = $sql->fetchAll();

        for($i = 0; $i < count($array); $i++) {

           $door = $array[$i]['param_door'];

           $addr = $array[$i]['name'];

           $timestamp = $array[$i]['time'];

           $data = gmdate("d.m.Y", $timestamp);

           $pathDoor = $array[$i]['path'];

           $orders = $orders."<div class='order-box'>
                                  <div class='order-title text'>".$array[$i]['status']."</div>
                                  <div class='order-detail-container'>
                                      <div class='order-client-data text'>
                                        <p class = 'order-detail detail_client'>Дата : ".$data."</p>
                                        <p class = 'order-detail detail_client'>Дверь : ".$door."</p>
                                        <p class = 'order-detail detail_client'>Адрес : ".$addr."</p>
                                      </div>
                                      <div class='order-client_photo'>
                                        <img src='$pathDoor' alt=''>
                                      </div>
                                    </div>
                                </div>";
        }
        echo "<div class='scroll-container'>".$orders."</div>";

        if(count($array) == 0) {
         echo "<div class = 'profile_top_info'>
                <p class = 'text profile_top_info_border center'>Нет заказов</p>
                </div>";
         }
    }

    if($_SESSION['user']['role'] == 'admin'){
            echo "<p class = 'profile_top_text'>Информация</p><br>";

            $array_sql = array("Всего заявок" => "SELECT COUNT(*) FROM `applications` apl
                                                  WHERE apl.is_delete = 0",
                              "Свежие заявки" => "SELECT COUNT(*) FROM `applications` apl
                                                 WHERE apl.is_delete = 0 and
                                                       apl.is_fresh = 1");

            $admin_info = "";

            foreach($array_sql as $key => $sql) {

            $sql = $connect->query($sql);

            $value = $sql->fetchAll();

            $value = $value[0][0];

            $admin_info = $admin_info."<div class='order-box_admin text'>
                                          <div class='order-title'>$key</div>
                                          <div class='order-detail_admin'>".$value."</div>
                                        </div>";
            }

            echo "<div class='scroll-container'>".$admin_info."</div>";

            echo "<section class = 'section-contacts_admin'>
                      <p class = 'profile_top_text'>Контакты</p>
                      <div class = 'text admin_contacts'>
                      <p>Консультант : +7(912)345-67-89  Виктор</p>
                      <p>Замерщик : +7(930)695-76-77 Владислав</p>
                      <div>
                  </section>";
    }

    if($_SESSION['user']['role'] == 'consultant'){
                echo "<p class = 'profile_top_text'>Свежие заявки</p><br>";
                $orders = "";
                $sql = "SELECT apl.id as id,
                               apl.door_id door_id,
                               c.mobtel as mobtel,
                               a.name as name,
                               apl.time as time,
                               apl.client_id as client_id
                        FROM `applications` apl
                             INNER JOIN `client` c on apl.client_id = c.id
                             INNER JOIN `address` a on apl.addr_id = a.id
                        WHERE apl.is_fresh = 1 and
                              apl.is_delete = 0
                        ORDER BY apl.time";

                $sql = $connect->query($sql);

                $array = $sql->fetchAll();

                for($i = 0; $i < count($array); $i++) {

                   $door_id = $array[$i]['door_id'];
                   $phone = $array[$i]['mobtel'];
                   $address = $array[$i]['name'];
                   $client_id = $array[$i]['client_id'];
                   $timestamp = $array[$i]['time'];
                   $id_order = $array[$i]['id'];

                   $data = gmdate("d.m.Y", $timestamp);

                   $sql = "SELECT param_door FROM `door` WHERE id = '$door_id'";

                   $sql = $connect->query($sql);

                   $result = $sql->fetchAll();

                   $door = $result[0]['param_door'];

                   $sql = "SELECT fname FROM `client` WHERE id = '$client_id'";

                   $sql = $connect->query($sql);

                   $result = $sql->fetchAll();

                   $name = $result[0]['fname'];

                   $orders = $orders."
                                      <div class='order-box box_form'>
                                       <form class action='backend/consultant_process.php' method='post' enctype='multipart/form-data'>
                                          <div class='order-title text'>Заявка №$id_order</div>
                                          <div class='order-detail-container text'>
                                              <div class='order-half center'>
                                                <label>Дата</label>
                                                <input class='order-detail detail_consultant input' name='data' value='$data'>
                                                <label>Дверь</label>
                                                <input class='order-detail detail_consultant input' name='door' value='$door' readonly='readonly'>
                                                <label>Имя</label>
                                                <input class='order-detail detail_consultant input' name='name' value='$name'>
                                                <label>Телефон</label>
                                                <input class='order-detail detail_consultant input' name='phone' value='$phone'>
                                                <label>Адрес</label>
                                                <input class='order-detail detail_consultant input' name='address' value='$address' title = '$address'>
                                                <label>Замерщик</label>
                                                <input id = 'inputEmp' name = 'measure' type = 'hidden'>
                                                <label class='order-detail custom-button-upload employees' id = 'employees'>Выбрать</label>
                                                <div class='employeesList' id = 'employeesList' style='display: none;'>
                                                  <ul>
                                                    <li class='employee'>Иван Иванов</li>
                                                    <li class='employee'>Ольга Петрова</li>
                                                    <li class='employee'>Сергей Сидоров</li>
                                                  </ul>
                                                </div>
                                                <label>Договор</label><br>
                                                <label for = 'inputFile' id = 'customButton' class='order-detail custom-button-upload'>Загрузить файл</label>
                                                <span class = 'file-chosen' id='fileChosen'>Файл не выбран</span>
                                                <input class='detail_consultant' id = 'inputFile' type='file' name='file' style = 'display:none'>
                                                <input class='order-detail detail_consultant input' name='id' value='$id_order' type = 'hidden'>
                                              </div>
                                              <div class='order-half'>
                                                <div class = 'order-buttons'>
                                                    <button class = 'order-button' type='submit' name='action' value='Confirm'>Подтвердить</button>
                                                    <button class = 'order-button' type='submit' name='action' value='Reject'>Отклонить</button>
                                                </div>
                                              </div>
                                          </div>
                                       </form>
                                     </div>";
                }
                echo "<div class='scroll-container'>".$orders."</div>";


    }

?>

  <script src="https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js"></script>

  <script src="js/main.js"></script>

</body>
</html>