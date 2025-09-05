<?php

require_once 'User.php';
require_once 'database.php';

// init DB
$db = new Database();
$db->initDatabase();
$db->addTestUsers();