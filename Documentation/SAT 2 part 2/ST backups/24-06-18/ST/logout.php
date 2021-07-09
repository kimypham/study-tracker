<?php
// Study Tracker - Logout, version 1.2, Kim Pham

session_start();
session_destroy();
header('Location: login.php');
?>