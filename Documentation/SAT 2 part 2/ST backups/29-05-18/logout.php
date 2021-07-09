<?php
// Study Tracker - Logout, version 1.1, Kim Pham

session_start();
session_destroy();
header('Location: login.php');
?>