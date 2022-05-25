<?php

    function get_assignments_by_course($course_id, $users_id){
        global $db;
        if ($course_id){
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id 
            AND A.userID = :userID ORDER BY ID';
        } else{
           $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.userID = :userID ORDER BY C.courseID';
           
        }
        $statement = $db->prepare($query);
        if($course_id){
        $statement->bindValue(':course_id',$course_id);
        }
        $statement->bindValue(':userID',$users_id);
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }
    


    function delete_assignment($assignment_id, $users_id){
        global $db;
        $query = 'DELETE FROM assignments WHERE ID = :assign_id AND userID = :users_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':assign_id',$assignment_id);
        $statement->bindValue(':users_id',$users_id);
        $statement->execute();
        $statement->closeCursor();

    }

    function add_assignment($course_id, $description, $users_id){
        global $db;
        $query = 'INSERT INTO assignments (Description, courseID, userID) VALUES (:descr, :courseID, :userID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':descr',$description);
        $statement->bindValue(':courseID',$course_id);
        $statement->bindValue(':userID',$users_id);
        $statement->execute();
        $statement->closeCursor();

    }