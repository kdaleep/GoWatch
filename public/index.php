<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/View.php';
require_once '../app/core/Schema.php';
require_once '../app/libraries/Core.php';
$schema = new Schema();
$schema->initialize();
$init = new Core();
$app = new App();
