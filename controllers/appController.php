<?php
session_start();
require_once "classes/session.php";
require_once "models/courseModel.php";
class AppController extends Controller
{
    public function __construct()
    {
        // error_log("APP_CONTROLLER::CONSTRUCT=>Loaded");
        parent::__construct();
    }

    public function loadView()
    {
        if ($_SESSION['sessionRole'] == 2) {
            $courses = $this->loadTeacherCourses();
            $this->view->render('app', $courses);
        } else {
            $this->view->render('app');
        }
    }

    public function closeSession()
    {
        $session = new Session();
        $session->closeSession();
        header("Location:" . constant('URL'));
    }

    private function loadTeacherCourses()
    {
        $model = new CourseModel();
        $courses = $model->getCoursesByTeacher($_SESSION['sessionIdUser']);
        return $courses;
    }

    public function createCourse()
    {
        $_POST['activo'] = 1;
        $_POST['id_curso'] = '';
        $_POST['profesor'] = $_SESSION['sessionIdUser'];
        $_POST['imagen'] = $_FILES['imagen']['name'];

        // echo "<pre>";
        // var_dump($_POST);
        // echo "<?pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "<?pre>";

        $model = new CourseModel();
        $model->createCourse($_POST);

        die;
    }
}
