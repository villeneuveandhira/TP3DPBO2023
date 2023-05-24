<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* database class */
class DB
{
    /* attribute(s) */
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    /* constructor */
    function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    /* method(s) */
    function open()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    function execute($query)
    {
        $this->result = mysqli_query($this->conn, $query);
    }

    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    function executeAffected($query = "")
    {
        // mengeksekusi query
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }

    function close()
    {
        mysqli_close($this->conn);
    }
}
?>