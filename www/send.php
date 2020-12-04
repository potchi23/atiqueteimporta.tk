<?php

if($_POST["message"] != ""){        
    require_once("init.php");
        
    $message = $_POST["message"];
        
    $instance = Application::getInstance();
    $db = $instance->init();
        
    $stmt = $db->prepare("INSERT INTO messages VALUES(?,?,?)");
    $stmt->bind_param("iss", $n=NULL, $message, $m=NULL);
    $stmt->execute();
        
    $stmt->close();
    $db->close();
}

header("Location: index.php");
die();

?>