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

    $to      = 'name@mail.com';
    $subject = 'Alguien te ha mandado un mensaje desde .tk';
   
    $msg = "[$time UTC]: $message";
    $headers = 'From: server@atiqueteimporta.tk' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $msg, $headers);
}

header("Location: index.php");
die();

?>