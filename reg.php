<?php
 session_start();

 if($_SESSION){
     if(isset($_SESSION['user'])) {
        header('Location: ../profile.php');
     }
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
          <a class="header-page__link" href="index.php">
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

<!-- section-аuthorization-->
<section class="section-authorization text">
<div class ="authorization-box">
  <div class="authorization">
    <p class = 'center textBig'> Зарегистрируйтесь
    </p>
    <form class="section-authorization_form" action="backend/signup.php" method="post">
      <label class = "center">Телефон</label>
      <input class="input authorization_input" name="phone" type = "text">
      <label class = "center">Пароль</label>
      <input class="input authorization_input" name="password" type="password">
      <label class = "center">Повторите пароль</label>
      <input class="input authorization_input" name="password_confirm" type="password">
      <button class="small-btn" type="submit">Зарегистрироваться</button>
    </form>
    <p class="section-authorization_back">
      Есть аккаунт? - <a class="section-authorization_back_a" href="auth.php">Авторизируйтесь</a>
    </p>
    <?php
     if(isset($_SESSION['msg'])) {
     echo '<p class = "section-authorization_msg center">'.
        $_SESSION['msg'].'</p>';
     unset($_SESSION['msg']);
     }
    ?>
  </div>
  </div>
</section>
<!-- /section-аuthorization-->


  <script src="https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js"></script>

</body>
</html>