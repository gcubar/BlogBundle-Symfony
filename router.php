<?php

    if (isset($_SERVER['SCRIPT_FILENAME'])) {
        return false;
    } else {
        require 'web/app_dev.php';
    }

?>
