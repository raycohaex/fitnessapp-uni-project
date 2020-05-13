<?php 
  class Exercises extends Controller {
    public function __construct() {
      $this->exerciseModel = $this->model('Exercise');
    }

    public function index() {
      $exercises = $this->exerciseModel->getExercises();

      $data = [
        'exercises' => $exercises
      ];
      $this->view('exercises/index', $data);
    }
  }