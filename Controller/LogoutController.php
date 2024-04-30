<?php
class LogoutController 
{
    public function __construct()
    {
        session_destroy();
        unset($_SESSION);
        header("location: ./LoginController.php");
        exit;
    }
}
$init = new LogoutController(); 