<?php
/* Template Name: Logout Page */
get_header();
require "config.php";

if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href='/insta-jastaijastai';</script>";
}

session_start();
session_unset();
session_destroy();

echo "<script>window.location.href='/insta-jastaijastai';</script>";
?>