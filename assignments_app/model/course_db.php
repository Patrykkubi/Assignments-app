<?php

    function get_courses($users_id){
        global $db;
        $query = 'SELECT * FROM courses WHERE userID = :users_id ORDER BY courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':users_id',$users_id);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
    }

    function get_course_name($course_id){
        if (!$course_id){
            return "All Courses";
        }
        global $db;
        $query = "SELECT * FROM courses WHERE courseID = :course_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();
        $course = $statement->fetch();
        $statement->closeCursor();
        $course_name = $course['courseName'];
        return $course_name;
    }

    function delete_course($course_id){
        global $db;
        $query = 'DELETE FROM courses WHERE courseID = :course_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_course($course_name, $users_id){
        global $db;
        $query = "INSERT INTO courses (courseName, userID ) VALUES (:courseName,:userID)";
        $statement = $db->prepare($query);
        $statement->bindValue(':courseName',$course_name);
        $statement->bindValue(':userID',$users_id);
        $statement->execute();
        $statement->closeCursor();
    }