<?php
include('../model/model.php');
session_start();
cleanSession();
header("Location: ../index.php");

?>