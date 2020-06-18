<?php
error_reporting(E_ALL);
// laad config
require_once('config/config.php');


// Laad lib(raries)
require_once 'functions/redirecter.php';
//require_once(APPROOT . '/lib/Core.php');
//require_once(APPROOT . '/lib/Controller.php');
//require_once(APPROOT . '/lib/Database.php');

//interfaces
//require_once(APPROOT . '/DAL/IExerciseDataLayer.php');
//require_once(APPROOT . '/DAL/IExerciseformDataLayer.php');
//require_once(APPROOT . '/applicatie/IExerciseBLL.php');
//require_once(APPROOT . '/applicatie/IExerciseformBLL.php');
//require_once(APPROOT . '/applicatie/IExerciseModel.php');
//
////classes
//require_once(APPROOT . '/applicatie/ExerciseModel.php');
//require_once(APPROOT . '/applicatie/ExerciseBLL.php');
//require_once(APPROOT . '/applicatie/ExerciseformBLL.php');
//require_once(APPROOT . '/DAL/ExerciseDataLayer.php');
//require_once(APPROOT . '/DAL/ExerciseformDataLayer.php');

// autoload alle benodigde bestanden
spl_autoload_register(function($className){
    include(dirname(dirname(__FILE__)).'/' . $className . '.php');
});


