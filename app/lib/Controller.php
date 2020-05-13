<?php
  /* 
   * default controller
   * Laadt models & views
   */
  class Controller {
    // model
    public function model($model) {
      // require model
      require_once '../app/models/' . $model . '.php';
      return new $model();
    }

    //view
    public function view($view, $data = []) {
      // check view bestand
      if(file_exists('../app/views/' . $view . '.php')) {
        require_once '../app/views/' . $view . '.php';
      } else {
        die('Er is iets fout gegaan (view bestaat niet)');
      }
    }
  }