<?php 
  class Exercises extends Controller {
    public function __construct() {
      $this->postModel = $this->model('Exercise');
    }

    public function index() {
      $data = [
        'title' => 'homepagina'
      ];
      $this->view('index', $data);
    }
  }