<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta name="robots" content="noindex">
        <meta charset="utf-8">
        <title>A ti qué te importa</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/hi.js"></script>
        <script src="js/overflowMessage.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="data:,">
    </head>

    <body style="font-family:Helvetica;">
        <h1>En serio, ¿a ti qué te importa?</h1>
        <p>¿Qué haces mirando esto? Estás perdiendo el tiempo. ¬.¬'</p>
        <p><a href="https://twitter.com/p_ichie">Vuelve a Twitter anda</a></p>

        <h3>Ya que estás puedes dejarme un mensajito (sé buen@) \(^.^)/</h3>

        <form action="send.php" method="post">
            <textarea id="newMessageText" style="resize: none" required name="message" maxlength="240" placeholder="Escribe cualquier chorrada..." ></textarea>
            <p><input type="submit" value="Enviar"></p>
        </form>
        
        <?php
            require_once("init.php");
            $instance = Application::getInstance();
            $db = $instance->init();
                
            $query = $db->query("SELECT message, ts FROM messages ORDER BY id DESC LIMIT 0, 3");
                
            if(mysqli_num_rows($query)){            
                echo("<div id='msg-container'><h3>Mensajitos</h3></div>");
            }
        ?>
    </body>
</html>