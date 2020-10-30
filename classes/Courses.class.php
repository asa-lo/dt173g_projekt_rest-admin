<?php

class Courses
{
    private $db;

    function __construct()
    {

        //Database connection

        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Connection error:" . $this->db->connect_error);
        }
    }

    //Get inserts in courses

    public function getCourses()
    {
        $sql =  "SELECT * FROM courses";
        $results = $this->db->query($sql);
        $courses =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $courses;
    }

    //Create new course in courses

    public function createCourses($school, $courseName, $date)
    {
        $sql = "INSERT INTO courses(school, coursename, date)VALUES('$school', '$courseName', '$date')";
        $this->db->query($sql);
        return true;
    }

    //Delete course in courses

    public function deleteCourses($index)
    {
        $sql = "DELETE FROM courses WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    //Get specific table from ID in courses table

    public function getIdCourses($index)
    {
        $sql =  "SELECT * FROM courses WHERE id = '$index'";
        $results = $this->db->query($sql);
        $courses =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $courses;
    }

    //Update course in courses

    public function updateCourses($school, $courseName, $date, $index)
    {
        $sql = "UPDATE courses SET school = '$school', coursename = '$courseName', date = '$date' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
}
