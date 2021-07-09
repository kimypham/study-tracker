<?php
// Study Tracker - Logout page, version 1.0, Kim Pham

session_start();
session_destroy();
header('Location: login.php');
?>