<?php

$ini = $_POST["ini"];
$offset = $_POST["offset"];

require_once("init.php");
$instance = Application::getInstance();
$db = $instance->init();
                
$query = $db->query("SELECT id, message, ts FROM messages ORDER BY id DESC LIMIT $ini, $offset");
$data = array();

if(mysqli_num_rows($query)){    
    while($row = $query->fetch_assoc()){
        array_push($data, $row);
    }
}

$db->close();
$result = array("data" => $data);
echo json_encode($result);

?>