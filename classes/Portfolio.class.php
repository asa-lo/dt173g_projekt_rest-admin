<?php

class Portfolio
{

    private $db;


    function __construct()
    {

        //Database connection

        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Connenction error: " . $this->db->connect_error);
        }
    }

    //Get inserts in portfolio

    public function getPortfolio()
    {
        $sql =  "SELECT * FROM portfolio";
        $results = $this->db->query($sql);
        $portfolio =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $portfolio;
    }

    //Create new portfolio in portfolio

    public function createPortfolio($title, $url, $description)
    {
        $sql = "INSERT INTO portfolio(title, url, description)VALUES('$title', '$url', '$description')";
        $this->db->query($sql);
        return true;
    }

    //Delete project in portfolio

    public function deletePortfolio($index)
    {
        $sql = "DELETE FROM portfolio WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    //Get specific table from ID in portfolio

    public function getIdPortfolio($index)
    {
        $sql =  "SELECT * FROM portfolio WHERE id = '$index'";
        $results = $this->db->query($sql);
        $portfolio =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $portfolio;
    }

    //Update in portfolio

    public function updatePortfolio($title, $url, $description, $index)
    {
        $sql = "UPDATE portfolio SET title = '$title', url = '$url', description = '$description' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
}
