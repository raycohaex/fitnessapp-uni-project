<?php
declare(strict_types=1);

require(APPROOT . '/models/ExerciseBBL.php');

class Exercises extends Controller
{
    public array $data;
    private object $exercise;
    private object $exercises;

    public function __construct()
    {

    }


    public function index(): void
    {
        $this->exercise = new ExerciseBBL();
        $exercises = $this->exercise->getAllExercises();
        $data = [
            'exercises' => $exercises
        ];
        $this->view('exercises/index', $data);
    }


    public function show($id): void
    {
        $this->exercise = new ExerciseBBL();
        $exercise = $this->exercise->getSingleExercise($id);
        $data = [
            'exercise' => $exercise
        ];
        $this->view('exercises/show', $data);
    }


    public function add(): void
    {
        // Routing method that stays in the presentation layer, has no connection to the logic.
        $data = [
            'name' => '',
            'description' => ''
        ];

        $this->view('exercises/add', $data);
    }


    public function edit($id): void
    {
        $exercise = $this->exercise->getSingleExercise($id);
        $data = [
            'id' => $id,
            'name' => $exercise->name,
            'description' => $exercise->description
        ];

        $this->view('exercises/edit', $data);
    }


    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            $this->exercise = new ExerciseBBL($name, $description);
            $this->exercise->save();
        }
    }


    public function patch($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'name_err' => '',
                'description_err' => ''
            ];

            if (empty($data['name'])) {
                $data['name_err'] = 'Geef een naam op';
            }

            if (empty($data['description'])) {
                $data['description_err'] = 'Geef een beschrijving op';
            }

            if (empty($data['name_err']) && empty($data['description_err'])) {
                //success
                if ($this->exercise->patchExercise($data)) {
                    redirect('exercises');
                } else {
                    die('error pagina');
                }
            } else {
                $this->view('exercises/edit', $data);
            }
        }
    }
}
