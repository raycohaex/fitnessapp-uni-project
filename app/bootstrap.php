<?php
// laad config
require_once('config/config.php');

// Laad lib(raries)
require_once 'helpers/redirecter.php';
// require_once('lib/core.php');
// require_once('lib/controller.php');
// require_once('lib/database.php');

// autoload alle benodigde bestanden
spl_autoload_register(function($className){
  require_once('lib/' . $className . '.php');
});
