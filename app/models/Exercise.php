<?php
  class Exercise {
    private $db;

    public function __construct() 
    {
      $this->db = new Database;
    }

    public function getExercises() {
      $this->db->query('SELECT * FROM exercises');
      $results = $this->db->resultSet();
      return $results;
    }
  }