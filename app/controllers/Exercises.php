<?php
declare(strict_types=1);
namespace app\controllers;

use app\lib\Controller;
use app\applicatie\ExerciseBLL;
use app\DAL\ExerciseDataLayer;
use app\applicatie\IExerciseBLL;
use app\applicatie\ExerciseformBLL;
use app\applicatie\IExerciseformBLL;
use app\DAL\ExerciseformDataLayer;
use app\applicatie\ExerciseModel;


class Exercises extends Controller
{
    public array $data;
    private object $exercise;
    private IExerciseBLL $exerciseBLL; // moet interface worden
    private IExerciseformBLL $exerciseformBLL; // moet interface worden

    public function __construct()
    {
        try {
            $this->exerciseBLL = new ExerciseBLL(new ExerciseDataLayer());
            $this->exerciseformBLL = new ExerciseformBLL(new ExerciseformDataLayer());
        }
        catch (\PDOException $e) {
            // stuur door naar een van de error pagina's aangezien het een fatal error is.
            $this->view('errors/error_db');
        }
    }


    public function index(): void
    {
        $exercises = $this->exerciseBLL->getAllExercises();
        if($exercises['error'] !== NULL) {
            $this->view('exercises/error', $exercises['error']);
            exit;
        } else {
            $data = [
                'exercises' => $exercises['exercises']
            ];
            $this->view('exercises/index', $data);
        }
    }


    public function show($id): void
    {
        $id = intval($id);
        if(is_string($id)) {
            $id = 0;
        }
        $exerciseform = $this->exerciseformBLL->getExerciseformsByExerciseId($id);
        $exercise = $this->exerciseBLL->getSingleExercise($id);
        if($exercise['error'] !== NULL) {
            $this->view('exercises/error', $exercise['error']);
            exit;
        } else {
            $data = [
                'exercise' => $exercise,
                'exerciseform' => $exerciseform
            ];
            $this->view('exercises/show', $data);
        }
    }


    public function add(): void
    {
        // Routing method that stays in the presentation layer, has no connection to the logic.
        $exerciseforms = $this->exerciseformBLL->getAllExcerciseforms();

        $data = [
            'exerciseforms' => $exerciseforms,
            'name' => '',
            'description' => '',
            'repetitions' => '',
            'sets' => ''
        ];

        $this->view('exercises/add', $data);
    }


    public function edit($id): void
    {
        $id = intval($id);
        if(is_string($id)) {
            $id = 0;
        }
        $selectedExerciseform = $this->exerciseformBLL->getExerciseformsByExerciseId($id);
        $exerciseforms = $this->exerciseformBLL->getAllExcerciseforms();
        $exercise = $this->exerciseBLL->getSingleExercise($id);
        if($exercise['error'] !== NULL) {
            $this->view('exercises/error', $exercise['error']);
            exit;
        } else {
            $exercise = $exercise['exercise'];
            $data = [
                'id' => $id + 0,
                'name' => $exercise->name,
                'description' => $exercise->description,
                'exerciseform' => [
                    'exerciseforms' => $exerciseforms,
                    'selectedExerciseform' => $selectedExerciseform
                ],
                'repetitions' => $exercise->repetitions,
                'sets' => $exercise->sets
            ];

            $this->view('exercises/edit', $data);
        }
    }


    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $exerciseFormId = (is_numeric($_POST['exerciseFormOption']) ? (int)$_POST['exerciseFormOption'] : 0);
            $repetitions = (is_numeric($_POST['repetitions']) ? (int)$_POST['repetitions'] : 0);
            $sets = (is_numeric($_POST['sets']) ? (int)$_POST['sets'] : 0);

            // Create new object from ExerciseModel
            $exerciseModel = new ExerciseModel(new ExerciseDataLayer(), $name, $description, $repetitions, $sets);

            // validate ExerciseModel in ExericseBLL
            $validateExercise = $exerciseModel->validateExercise();

            if ($validateExercise['valid'] == true) {
                $result = $exerciseModel->addExercise($exerciseFormId);
                // if successful
                if ($result !== 0) {
                    redirect('index');
                }
            } else {
                if ($validateExercise['descriptionErr']) {
                    $data['description_err'] = $validateExercise['descriptionErr'];
                }
                if ($validateExercise['nameErr']) {
                    $data['name_err'] = $validateExercise['nameErr'];
                }
                $data['name'] = $exerciseModel->getExerciseName();
                $data['description'] = $exerciseModel->getExerciseDescription();
                $data['exerciseforms'] = $exerciseforms = $this->exerciseformBLL->getAllExcerciseforms();

                $this->view('exercises/add', $data);
            }
        }
    }


    public function patch($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $exerciseFormId = (is_numeric($_POST['exerciseFormOption']) ? (int)$_POST['exerciseFormOption'] : 0);
            $repetitions = (is_numeric($_POST['repetitions']) ? (int)$_POST['repetitions'] : 0);
            $sets = (is_numeric($_POST['sets']) ? (int)$_POST['sets'] : 0);


            $editExercise = new ExerciseModel(new ExerciseDataLayer(), $name, $description, $repetitions, $sets, $id);

            // validate ExerciseModel in ExericseBLL
            $validateExercise = $editExercise->validateExercise();

            if ($validateExercise['valid'] == true) {
                $result = $editExercise->patchExercise($exerciseFormId);
                if ($result !== 0) {
//                    $this->exerciseformBLL->joinExerciseWithExerciseform($exerciseFormId, $result);
                    redirect('index');
                }
            } else {
                if ($validateExercise['descriptionErr']) {
                    $data['description_err'] = $validateExercise['descriptionErr'];
                }
                if ($validateExercise['nameErr']) {
                    $data['name_err'] = $validateExercise['nameErr'];
                }
                $data['name'] = $editExercise->getExerciseName();
                $data['description'] = $editExercise->getExerciseDescription();

                $this->view('exercises/edit', $data);
            }
        }
    }
}
