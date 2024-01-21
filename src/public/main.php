<?php
session_start();
require_once __DIR__ . '/src/helpers.php';
if (!isset($_SESSION['user_id'])){
    redirect('/get_login.php');
}
echo 'main';