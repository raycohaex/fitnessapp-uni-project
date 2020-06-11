<?php
error_reporting(E_ALL);
// laad config
require_once('config/config.php');

// Laad lib(raries)
require_once 'functions/redirecter.php';
require_once(APPROOT . '/lib/Core.php');
require_once(APPROOT . '/lib/Controller.php');
require_once(APPROOT . '/lib/Database.php');

//interfaces
require_once(APPROOT . '/DAL/IExerciseDataLayer.php');

//classes
require_once(APPROOT . '/applicatie/ExerciseModel.php');
require_once(APPROOT . '/applicatie/ExerciseMethods.php');
require_once(APPROOT . '/DAL/ExerciseDataLayer.php');

// autoload alle benodigde bestanden
//spl_autoload_register(function($className){
//  include APPROOT . '/' . $className . '.php';
//});


