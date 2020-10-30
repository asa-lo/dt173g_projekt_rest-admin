<?php

class CV
{

    private $db;


    function __construct()
    {

        //Database connection

        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Connection error: " . $this->db->connect_error);
        }
    }

    //Get inserts in CV

    public function getCV()
    {
        $sql =  "SELECT * FROM CV";
        $results = $this->db->query($sql);
        $CV =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $CV;
    }

    //Create new CV

    public function createCV($name, $title, $date)
    {
        $sql = "INSERT INTO CV(name, title, date)VALUES('$name', '$title', '$date')";
        $this->db->query($sql);
        return true;
    }

    //Delete CV

    public function deleteCV($index)
    {
        $sql = "DELETE FROM CV WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    //Get specific table from ID in CV

    public function getIdCV($index)
    {
        $sql =  "SELECT * FROM CV WHERE id = '$index'";
        $results = $this->db->query($sql);
        $CV =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $CV;
    }

    //Update CV

    public function updateCV($name, $title, $date, $index)
    {
        $sql = "UPDATE CV SET name = '$name', title = '$title', date = '$date' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
}
