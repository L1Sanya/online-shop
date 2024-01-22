<?php
require_once __DIR__ . '/src/helpers.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    redirect('/get_login.php');
} else {
    echo "Hello, {$_SESSION['user_name']}!";
    require_once 'src/catalog.php';
}