<?php
/*
 * default controller
 * Laadt DAL & views
 */

declare(strict_types=1);

class Controller
{

    public array $data = [];

    // model
    public function model($model) : object
    {
        // require model
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    //view
    public function view($view, $data = []) : void
    {
        // check view bestand
        if (file_exists('../app/views/' . $view . '.php')) {
            require '../app/views/' . $view . '.php';
        } else {
            die('Er is iets fout gegaan (view bestaat niet)');
        }
    }
}