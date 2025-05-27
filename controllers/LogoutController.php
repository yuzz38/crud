<?php
require_once "BaseSpaceTwigController.php"; 

class LogoutController extends BaseSpaceTwigController {
    
    public function post(array $context) {
      
        $_SESSION["is_logged"] = false;
        header("Location: /login");
        exit;
    }
}