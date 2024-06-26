<?php
 session_start();

 require_once 'backend/test/config/connect.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:500,900%7CRoboto:300&display=swap&subset=cyrillic" rel="stylesheet">
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

  <title>Doors — межкомнатные двери</title>
</head>
<body>

<!-- header-page -->
<header class="header-page page-theme">
  <div class="container header-page__container">
    <div class="header-page__start">
      <div class="logo">
        <a class="header-page__link" href="#" data-scroll-to="section-top">
          <span class="header-page__text">DOORS</span>
        </a>
      </div>
    </div>
    <div class="header-page__end">
      <nav class="header-page__nav">
        <ul class="header-page__ul">
          <li class="header-page__li">
            <a class="header-page__link" href="#" data-scroll-to="section-catalog">
              <span class="header-page__text">двери</span>
            </a>
          </li>
          <li class="header-page__li">
            <a class="header-page__link" href="#" data-scroll-to="section-about">
              <span class="header-page__text">о нас</span>
            </a>
          </li>
          <li class="header-page__li">
            <a class="header-page__link" href="#" data-scroll-to="section-contacts">
              <span class="header-page__text">контакты</span>
            </a>
          </li>
          <li class="header-page__li">
            <a class="header-page__link" href="auth.php">
              <span class="header-page__text">кабинет</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="phone">
        <a class="phone__item header-page__phone" href="tel:+79999999999">+7 (999) 999-99-99</a>
      </div>
      <div class="header-page__doors">
        <button class="btn-menu" type="button" data-popup="popup-menu">
          <span class="btn-menu__box">
            <span class="btn-menu__inner"></span>
          </span>
        </button>
      </div>
    </div>
  </div>
</header>
<!-- /.header-page -->


<!-- section-top -->
<section class="section-top lazy" data-src="img/section-top/bg2.webp" data-src-replace-webp="img/section-top/bg2.jpg">
  <div class="container section-top__container">
    <h1 class="section-top__title">Межкомнатные двери</h1>
    <div class="section-top__btn">
      <button class="btn" type="button" data-scroll-to="section-catalog">Выбрать</button>
    </div>
  </div>
</section>
<!-- /.section-top -->

<!-- section-catalog -->
<section class="section section-catalog">
  <div class="container">
    <header class="section__header">
      <h2 class="page-title page-title--accent">Каталог</h2>
      <nav class="catalog-nav">
        <ul class="catalog-nav__wrapper">
          <li class="catalog-nav__item">
            <button class="catalog-nav__btn is-active" type="button" data-filter="all">Все</button>
          </li>
          <li class="catalog-nav__item">
            <button class="catalog-nav__btn" type="button" data-filter="neoclassic">Неоклассика</button>
          </li>
          <li class="catalog-nav__item">
            <button class="catalog-nav__btn" type="button" data-filter="classic">Классика</button>
          </li>
          <li class="catalog-nav__item">
            <button class="catalog-nav__btn" type="button" data-filter="modern">Современный стиль</button>
          </li>
        </ul>
      </nav >
    </header>

    <div class="catalog">
      <div class="catalog__item" data-category="neoclassic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/1_1.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/1_1.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Rocca</h3>
            <p class="product__description">Строгие лаконичные формы и четкие очертания профиля. </p>
          </div>
          <footer class="product__footer">
            <!--
            <div class="product__count">
              <button class="product__count is-active" type="button">-</button>
              <span class="product__count">1</span>
              <button class="product__count" type="button">+</button>
            </div>
            -->
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">54850</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="classic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/2.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/2.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Esse</h3>
            <p class="product__description">Классическая дверь в актуальных цветах эмали, выполненные по технологии фрезерования на цельной поверхности полотна. </p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">40950</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="modern">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/3.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/3.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Freedom</h3>
            <p class="product__description">Вертикальные и горизонтальные вставки, позволяющие сочетать древесные и монохромые отделки. </p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">30880</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="modern">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/4.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/4.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Rift</h3>
            <p class="product__description">Разнонаправленный натуральный шпон. </p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">76250</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="modern">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/5.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/5.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Velvet</h3>
            <p class="product__description">Полотна с рельефной фрезеровкой. Этот прием делает интерьер объемным, тактильным, вносит интересную текстуру и создает современный образ.</p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">120890</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="classic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/6.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/6.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Mascot</h3>
            <p class="product__description">Мягкие и элегантные элементы на полотне.  </p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">54850</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="neoclassic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/7.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/7.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Antique</h3>
            <p class="product__description">Из массива ценных пород дерева с объёмными элементами на полотне. </p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">89920</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="neoclassic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/8.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/8.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Neo</h3>
            <p class="product__description">Минималистичный профиль с гладкими филенками, характерные для современного стиля.</p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">20990</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
      <div class="catalog__item" data-category="neoclassic">
        <div class="product catalog__product">
          <picture>
            <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-catalog/9.webp">
            <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-catalog/9.png" alt="">
          </picture>
          <div class="product__content">
            <h3 class="product__title">Paris</h3>
            <p class="product__description">Воплощение лёгкости французских интерьеров, элегантных и практичных для жизни одновременно.</p>
          </div>
          <footer class="product__footer">
            <div class="product__bottom">
              <div class="product__price">
                <span class="product__price-value">55950</span>
                <span class="product__currency">&#8381;</span>
              </div>
              <button class="btn product__btn" type="button" data-popup="popup-order">заказать</button>
            </div>
          </footer>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.section-catalog -->

<!-- section-about -->
<section class="section section-about">
  <picture>
    <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="img/section-about/bg.webp">
    <img class="section-about__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/section-about/bg.jpg" alt="">
  </picture>
  <div class="container section-about__container">
    <div class="section-about__content">
      <h2 class="page-title section-about__title">О нас</h2>
      <p class="section-about__text text">Компания “Doors” специализируется на продаже межкомнатных дверей. Мы предлагаем широкий ассортимент продукции от ведущих производителей, обеспечивая высокое качество товаров и конкурентоспособные цены.</p>
    </div>
  </div>
</section>
<!-- /.section-about -->

<!-- section-contacts -->
<section class="section section-contacts">
  <div class="container section-contacts__container">
    <header class="section__header">
      <h2 class="page-title sectoin-contacts__title">Контакты</h2>
    </header>
    <div class="contacts">
      <div class="contacts__start">
        <div class="contacts__map" id="ymap"></div>
      </div>
      <div class="contacts__end">
        <div class="contacts__item">
          <h3 class="contacts__title">Адрес</h3>
          <p class="contacts__text text">г. Москва, Преображенская площадь, 8</p>
        </div>
        <div class="contacts__item">
          <h3 class="contacts__title">Телефон</h3>
          <p class="contacts__text">
            <a class="contacts__phone text" href="tel:+79999999999">+7 (999) 999-99-99</a>
          </p>
        </div>
        <div class="contacts__item">
          <h3 class="contacts__title">Социальные сети</h3>
          <ul class="socials">
            <li class="socials__item">
              <a href="#" class="socials__link" target="_blank">
                <svg class="socials__icon socials__icon--vk" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.2 112.2" width="35" height="35">
                  <g>
                    <circle cx="56.1" cy="56.1" r="56.1" />
                    <path class="socials__logo" d="M54,80.7h4.4a3.33,3.33,0,0,0,2-.9,3.37,3.37,0,0,0,.6-1.9s-.1-5.9,2.7-6.8,6.2,5.7,9.9,8.2c2.8,1.9,4.9,1.5,4.9,1.5l9.8-.1s5.1-.3,2.7-4.4c-.2-.3-1.4-3-7.3-8.5-6.2-5.7-5.3-4.8,2.1-14.7,4.5-6,6.3-9.7,5.8-11.3s-3.9-1.1-3.9-1.1l-11.1.1a2.32,2.32,0,0,0-1.4.3,3.58,3.58,0,0,0-1,1.2A60,60,0,0,1,70,50.9c-4.9,8.4-6.9,8.8-7.7,8.3-1.9-1.2-1.4-4.9-1.4-7.5,0-8.1,1.2-11.5-2.4-12.4a17.68,17.68,0,0,0-5.2-.5c-4,0-7.3,0-9.2.9-1.3.6-2.2,2-1.6,2.1a5.05,5.05,0,0,1,3.3,1.6c1.1,1.5,1.1,5,1.1,5s.7,9.6-1.5,10.7c-1.5.8-3.5-.8-7.9-8.4a67.05,67.05,0,0,1-4-8.2,2.82,2.82,0,0,0-.9-1.2,5.13,5.13,0,0,0-1.7-.7l-10.5.1s-1.6,0-2.2.7,0,1.9,0,1.9,8.2,19.3,17.6,29c8.5,9,18.2,8.4,18.2,8.4Z" />
                  </g>
                </svg>
              </a>
            </li>
            <li class="socials__item">
              <a href="#" class="socials__link" target="_blank">
                <svg class="socials__icon socials__icon--fb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.2 112.2" width="35" height="35">
                  <g>
                    <circle cx="56.1" cy="56.1" r="56.1" />
                    <path class="socials__logo" d="M70.2,58.3h-10V95H45V58.3H37.8V45.4H45V37.1c0-6,2.8-15.3,15.3-15.3H71.5V34.3H63.3c-1.3,0-3.2.7-3.2,3.5v7.6H71.4Z" />
                  </g>
                </svg>
              </a>
            </li>
            <li class="socials__item">
              <a href="#" class="socials__link" target="_blank">
                <svg class="socials__icon socials__icon--inst" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35">
                  <g>
                    <path d="M332.3,136.2H179.7a44.21,44.21,0,0,0-44.2,44.2V333a44.21,44.21,0,0,0,44.2,44.2H332.3A44.21,44.21,0,0,0,376.5,333V180.4A44.21,44.21,0,0,0,332.3,136.2ZM256,336a79.3,79.3,0,1,1,79.3-79.3A79.42,79.42,0,0,1,256,336Zm81.9-142.2A18.8,18.8,0,1,1,356.7,175,18.78,18.78,0,0,1,337.9,193.8Z" />
                    <path d="M256,210.9a45.8,45.8,0,1,0,45.8,45.8A45.86,45.86,0,0,0,256,210.9Z" />
                    <path d="M256,0C114.6,0,0,114.6,0,256S114.6,512,256,512,512,397.4,512,256,397.4,0,256,0ZM410,333a77.78,77.78,0,0,1-77.7,77.7H179.7A77.78,77.78,0,0,1,102,333V180.4a77.84,77.84,0,0,1,77.7-77.7H332.3A77.84,77.84,0,0,1,410,180.4Z" />
                  </g>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.section-contacts -->

<!-- footer-page -->
<footer class="footer-page">
  <div class="container">
    <div class="footer-page__text">Doors 2024</div>
  </div>
</footer>
<!-- /.footer-page -->


<!-- popup-menu -->
<div class="popup popup-menu">
  <div class="popup__wrapper">
    <div class="popup__inner">
      <div class="popup__content popup__content--fluid popup__content--centered">
        <button class="btn-close popup__btn-close popup-close"></button>
        <nav class="mobile-menu popup__mobile-menu">
          <ul class="mobile-menu__ul">
            <li class="mobile-menu__li">
              <a class="mobile-menu__link popup-close" href="#" data-scroll-to="section-catalog">Двери</a>
            </li>
            <li class="mobile-menu__li">
              <a class="mobile-menu__link popup-close" href="#" data-scroll-to="section-about">О нас</a>
            </li>
            <li class="mobile-menu__li">
              <a class="mobile-menu__link popup-close" href="#" data-scroll-to="section-contacts">Контакты</a>
            </li>
            <li class="mobile-menu__li">
              <a class="mobile-menu__link popup-close" href="auth.php">Кабинет</a>
            </li>
          </ul>
        </nav>
        <div class="phone popup__phone">
          <a class="phone__item phone__item--accent" href="tel:+79999999999">+7 (999) 999-99-99</a>
        </div>
        <ul class="socials">
          <li class="socials__item">
            <a href="#" class="socials__link" target="_blank">
              <svg class="socials__icon socials__icon--vk" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.2 112.2" width="35" height="35">
                <g>
                  <circle cx="56.1" cy="56.1" r="56.1" />
                  <path class="socials__logo" d="M54,80.7h4.4a3.33,3.33,0,0,0,2-.9,3.37,3.37,0,0,0,.6-1.9s-.1-5.9,2.7-6.8,6.2,5.7,9.9,8.2c2.8,1.9,4.9,1.5,4.9,1.5l9.8-.1s5.1-.3,2.7-4.4c-.2-.3-1.4-3-7.3-8.5-6.2-5.7-5.3-4.8,2.1-14.7,4.5-6,6.3-9.7,5.8-11.3s-3.9-1.1-3.9-1.1l-11.1.1a2.32,2.32,0,0,0-1.4.3,3.58,3.58,0,0,0-1,1.2A60,60,0,0,1,70,50.9c-4.9,8.4-6.9,8.8-7.7,8.3-1.9-1.2-1.4-4.9-1.4-7.5,0-8.1,1.2-11.5-2.4-12.4a17.68,17.68,0,0,0-5.2-.5c-4,0-7.3,0-9.2.9-1.3.6-2.2,2-1.6,2.1a5.05,5.05,0,0,1,3.3,1.6c1.1,1.5,1.1,5,1.1,5s.7,9.6-1.5,10.7c-1.5.8-3.5-.8-7.9-8.4a67.05,67.05,0,0,1-4-8.2,2.82,2.82,0,0,0-.9-1.2,5.13,5.13,0,0,0-1.7-.7l-10.5.1s-1.6,0-2.2.7,0,1.9,0,1.9,8.2,19.3,17.6,29c8.5,9,18.2,8.4,18.2,8.4Z" />
                </g>
              </svg>
            </a>
          </li>
          <li class="socials__item">
            <a href="#" class="socials__link" target="_blank">
              <svg class="socials__icon socials__icon--fb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.2 112.2" width="35" height="35">
                <g>
                  <circle cx="56.1" cy="56.1" r="56.1" />
                  <path class="socials__logo" d="M70.2,58.3h-10V95H45V58.3H37.8V45.4H45V37.1c0-6,2.8-15.3,15.3-15.3H71.5V34.3H63.3c-1.3,0-3.2.7-3.2,3.5v7.6H71.4Z" />
                </g>
              </svg>
            </a>
          </li>
          <li class="socials__item">
            <a href="#" class="socials__link" target="_blank">
              <svg class="socials__icon socials__icon--inst" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35">
                <g>
                  <path d="M332.3,136.2H179.7a44.21,44.21,0,0,0-44.2,44.2V333a44.21,44.21,0,0,0,44.2,44.2H332.3A44.21,44.21,0,0,0,376.5,333V180.4A44.21,44.21,0,0,0,332.3,136.2ZM256,336a79.3,79.3,0,1,1,79.3-79.3A79.42,79.42,0,0,1,256,336Zm81.9-142.2A18.8,18.8,0,1,1,356.7,175,18.78,18.78,0,0,1,337.9,193.8Z" />
                  <path d="M256,210.9a45.8,45.8,0,1,0,45.8,45.8A45.86,45.86,0,0,0,256,210.9Z" />
                  <path d="M256,0C114.6,0,0,114.6,0,256S114.6,512,256,512,512,397.4,512,256,397.4,0,256,0ZM410,333a77.78,77.78,0,0,1-77.7,77.7H179.7A77.78,77.78,0,0,1,102,333V180.4a77.84,77.84,0,0,1,77.7-77.7H332.3A77.84,77.84,0,0,1,410,180.4Z" />
                </g>
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /.popup-menu -->

<!-- popup-order -->
<div class="popup popup-order">
  <div class="popup__wrapper">
    <div class="popup__inner">
      <div class="popup__content">
        <button class="btn-close popup__btn-close popup-close"></button>
        <h2 class="page-title popup__title">Заполните форму</h2>
        <p class="popup__subtitle popup__subtitle--order text">Вы выбрали:</p>
        <div class="order">
          <h3 class="order__title">
            <span class="order-product-title"></span>
          </h3>
          <img class="order__img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" alt="">
          <h3 class="order__title">
            <span class="order-product-price"></span> &#8381;
          </h3>
          <form class="form form-send">
            <input class="order-info-title" type="hidden" name="дверь">
            <input class="order-info-price" type="hidden" name="цена">
            <input class="form__input text" type="text" name="имя" placeholder="Имя" required>
            <input class="form__input text" type="text" name="телефон" placeholder="Телефон" required>
            <input class="form__input text" type="text" name="адрес" placeholder="Адрес" required>
            <button class="btn form__btn" type="submit">Отправить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.popup-order -->

<!-- popup-thanks -->
<div class="popup popup-thanks">
  <div class="popup__wrapper">
    <div class="popup__inner">
      <div class="popup__content">
        <button class="btn-close popup__btn-close popup-close"></button>
        <h2 class="page-title popup__title">Заявка принята</h2>
        <p class="popup__subtitle">Скоро вам позвоним, статус заказа можете посмотреть в своём кабинете</p>
      </div>
    </div>
  </div>
</div>
<!-- /.popup-thanks -->

<!-- popup-error -->
<div class="popup popup-error">
  <div class="popup__wrapper">
    <div class="popup__inner">
      <div class="popup__content">
        <button class="btn-close popup__btn-close popup-close"></button>
        <h2 class="page-title popup__title">Произошла ошибка</h2>
        <p class="popup__subtitle">Пожалуйста, сделайте заказ по номеру <a class="popup__link" href="+79999999999">+7 (999) 999-99-99</a></p>
      </div>
    </div>
  </div>
</div>
<!-- /.popup-error -->

  <script src="https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js"></script>

  <script src="js/main.js"></script>
</body>
</html>