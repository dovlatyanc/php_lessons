<?php

session_start();

unset($_SESSION['userId']);
unset($_SESSION['userEmail']);

header('Location: login.php',302);

die();