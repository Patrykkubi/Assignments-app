<?php
session_start();
?>
<?php
// główny controller
    require('model/database.php');
    require('model/assignments_db.php');
    require('model/course_db.php');
    require('model/login.classes.php');
    require('model/login-contr.classes.php');
    require('model/signup.classes.php');
    require('model/signup-contr.classes.php');


    $assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
    $course_name = filter_input(INPUT_POST, 'course_name', FILTER_UNSAFE_RAW);

    $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
    if (!$course_id){
        $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
    } 

    $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
    if (!$action){
        $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
        if (!$action){
            $action = 'list_assignments';
        }
    }

    if(isset($_POST["submit"])){
        //grabbing data
        $uid = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];
        $email = $_POST["email"];
    }

    if(isset($_POST["submit"])){
        //grabbing data
        $uid = $_POST["uid"];
        $pwd = $_POST["pwd"];
    }

    // routings
    switch($action){
        case "list_courses":
            $courses=get_courses($_SESSION["userid"]);
            include('view/course_list.php');
            break;
        
        case "add_course":
            add_course($course_name, $_SESSION['userid']);
            header("Location: .?action=list_courses"); //redirect to the same page, while passing action = list_courses
            break;
        
        case "add_assignment":
            if ($course_id && $description) {
                add_assignment($course_id, $description, $_SESSION['userid']);
                header("Location: .?course_id=$course_id");
            } else {
                $error = "Invalid assignment data. Check all fields and try again.";
                include('view/error.php');
                exit();
            }
            break;

        case "delete_course":
            if ($course_id){
                try{
                    delete_course($course_id);
                } catch (PDOException $e){
                    $error = "You cannot delete a course if assignments exist in the course.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_courses");
            }
            break;

        case "delete_assignment":
            if ($assignment_id){
                delete_assignment($assignment_id, $_SESSION['userid']);
                header("Location: .?course_id=$course_id");
            } else {
                $error = "Missing or incorrect assingment id";
                include('view/error.php');
            }
            break;

        case "signup":
            $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);
            $signup->signupUser();
            header("location: index.php?error=none");
        break;

        case "login":      
            $login = new LoginContr($uid, $pwd);
            $login->loginUser(); 
            header("location: index.php?error=none");
        break;

        case "logout":
            session_start();
            session_unset();
            session_destroy();
            header("location: view/login.php");
        break;

        default:
        // if no session id then deafult should be login screen
            if(!isset($_SESSION["userid"])){
                include("view/login.php");
            } else {
        
        // if session id then 
                $course_name = get_course_name($course_id);
                $courses = get_courses($_SESSION["userid"]);
                $assignments = get_assignments_by_course($course_id, $_SESSION["userid"] );
                include('view/assignment_list.php'); 
            }
    }