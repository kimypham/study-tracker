<?php
// Study Tracker - Logout, version 1.3, Kim Pham

session_start();
session_destroy();
header('Location: login.php');
?>