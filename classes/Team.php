<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* team class */
class Team extends DB
{
    function getTeam()
    {
        $query = "SELECT * FROM team";
        return $this->execute($query);
    }

    function getTeamById($id)
    {
        $query = "SELECT * FROM team WHERE team_id=$id";
        return $this->execute($query);
    }

    function addTeam($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO team VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateTeam($id, $data)
    {
        $team_nama = $data['nama'];
        $query = "UPDATE team SET team_nama = '$team_nama' WHERE team_id='$id'";
        return $this->executeAffected($query);
    }

    function deleteTeam($id)
    {
        $query = "DELETE FROM team WHERE team_id = $id";
        return $this->executeAffected($query);
    }

    function filterTeamAsc()
    {
        $query = "SELECT * FROM team ORDER BY team_nama ASC";
        return $this->execute($query);
    }

    function filterTeamDesc()
    {
        $query = "SELECT * FROM team ORDER BY team_nama DESC";
        return $this->execute($query);
    }

    function searchTeam($keyword)
    {
        $query = "SELECT * FROM team WHERE team_nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }
}
