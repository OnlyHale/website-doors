<?php
try {
    $connect = new PDO('mysql:host=localhost;dbname=doors', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}
