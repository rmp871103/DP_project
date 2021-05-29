<?php
    include('DB_Function.php');
    include('MailCheck.php');
    function cleanSession()
    {
        session_unset(); 
        session_destroy(); 
    }
?>