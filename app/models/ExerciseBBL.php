<?php
require_once APPROOT . '/DAL/ExerciseDataLayer.php';

class ExerciseBBL{

    private IExerciseDal $exerciseDAL;
    private string $descriptionErr;
    private string $nameErr;
    private string $name;
    private string $description;

    public function __construct()
    {
        $this->exerciseDAL = new ExerciseDataLayer();
    }

//    public function exerciseBBL() {
//        $this->exerciseDAL = new ExerciseDataLayer();
//    }

    function getAllExercises() : array
    {
        return $this->exerciseDAL->getExercises();

        // verwerk data voor view
    }

    function getSingleExercise($id) : object {
        return $this->exerciseDAL->getExerciseById($id);
    }


    function save() {
//        if($this->validateExercise() == true) {
//            try {
//                $this->exercise->addNewExercise($data);
//                redirect('exercises');
//            } catch(Exception $ex) {
//                exit('Something went wrong: ' . $ex->getMessage());
//            }
//        } else {
//            if(array_key_exists('description_err', $validationData)){
//                $data['description_err'] = $validationData['description_err'];
//            }
//            if(array_key_exists('name_err', $validationData)){
//                $data['name_err'] = $validationData['name_err'];
//            }
//            $this->view('exercises/add', $data);
//        }
    }






    function validateExercise() : bool {
//        if (empty($this->name)) {
//            $this->'name_err' = 'Geef een naam op';
//        }
//
//        if (empty($this->description)) {
//            $data['description_err'] = 'Geef een beschrijving op';
//        }
//
//        if (empty($this->name) && empty($this->description)) {
//            return true;
//        } else {
//            return false;
//        }
//
//        return $data;
    }

    function addNewExercise($data) : bool {
        return $this->exerciseDAL->addExercise($data);
    }


}