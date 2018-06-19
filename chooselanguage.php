<?php
/**
 * Unset the language session variable
 */
session_start();
unset($_SESSION['language']);
header('Location: language.php');
exit();