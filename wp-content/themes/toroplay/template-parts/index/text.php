<?php
    global $config_grabber;

    echo isset($config_grabber['texthome']) ? '<div class="tr-description">'.wpautop(stripslashes($config_grabber['texthome'])).'</div>' : '';
?>