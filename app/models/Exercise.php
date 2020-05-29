<?php
  class Exercise {
    private $db;

    public function __construct() 
    {
      $this->db = new Database;
    }



    public function getExercises() {
      $this->db->query('SELECT `id`, `name`, `description` FROM exercises');
      $results = $this->db->resultSet();
      return $results;
    }



    public function getExerciseById($id) {
      $this->db->query('SELECT `id`, `name`, `description` FROM `exercises` WHERE id = :id');
      $this->db->bind(':id', $id);
      $row = $this->db->single();

      return $row;
    }



    public function addExercise($data) {
      $this->db->query('INSERT INTO `exercises` (name) VALUES (:name)');

      $this->db->bind(':name', $data['name']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }



    public function patchExercise($data) {
      $this->db->query('UPDATE `exercises` SET name=:name, description=:description WHERE id=:id');

      $this->db->bind(':name', $data['name']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':id', $data['id']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }