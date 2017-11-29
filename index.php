<?php

session_start();

require_once 'core/db.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'helpers/StringHelper.php';

$config = include_once 'config.php';

$route = new Route($config);
$route->init();