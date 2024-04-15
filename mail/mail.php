<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
  exit();
}

$project_name = 'Doors';
$admin_email = 'doors.adm@yandex.ru';

$form_subject = 'Заявка c сайта Doors';
$message = '';

foreach ($_POST as $key => $value) {
    if ($value === '') {
        continue;
    }
    $message .= "
    <tr style='background-color: white;'>
      <td style='padding: 10px;
                 border: 1px solid black;
                 border-radius: 10px;
                 text-align: center;
                 color: black;
                 font-family: Gill Sans, sans-serif;
                 font-weight: 700;'>$key</td>
      <td style='padding: 10px;
                 border: 1px solid black;
                 border-radius: 10px;
                 text-align: center;
                 color: black;
                 font-family: Gill Sans, sans-serif;
                 font-weight: 700;'>$value</td>
    </tr>";
}

function adopt($text) {
    return '=?utf-8?B?'.base64_encode($text).'?=';
}

$message = "<table style='width: 100%;'>$message</table>";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From:" . adopt($form_subject) . " <$admin_email>\r\n";

$success_send = mail($admin_email, adopt($form_subject), $message, $headers);

if ($success_send) {
  echo 'success';
} else {
  echo 'error';
}