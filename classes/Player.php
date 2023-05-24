<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* player class */
class Player extends DB
{
    function getPlayerJoin()
    {
        $query = "SELECT * FROM player JOIN role ON player.role_id=role.role_id JOIN team ON player.team_id=team.team_id ORDER BY player.id";

        return $this->execute($query);
    }
    function getPlayer()
    {
        $query = "SELECT * FROM player";
        return $this->execute($query);
    }

    function getPlayerById($id)
    {
        $query = "SELECT * FROM player JOIN role ON player.role_id=role.role_id JOIN team ON player.team_id=team.team_id WHERE id=$id";
        return $this->execute($query);
    }

    function searchPlayer($keyword)
    {
        $query = "SELECT * FROM player JOIN role ON player.role_id=role.role_id JOIN team ON player.team_id=team.team_id WHERE nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $tmp_file = $file['player_foto']['tmp_name'];
        $player_foto = $file['player_foto']['name'];

        $dir = "assets/images/$player_foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $role_id = $data['role_id'];
        $team_id = $data['team_id'];

        $query = "INSERT INTO player VALUES ('', '$nama', '$player_foto', '$role_id', '$team_id')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file, $img)
    {


        $tmp_file = $file['player_foto']['tmp_name'];
        $player_foto = $file['player_foto']['name'];

        if ($player_foto == "") {
            $player_foto = $img;
        }

        $dir = "assets/images/$player_foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $role_id = $data['role_id'];
        $team_id = $data['team_id'];

        $query = "UPDATE player SET nama = '$nama', player_foto = '$player_foto', role_id = '$role_id', team_id = '$team_id' WHERE id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM player WHERE id = $id";
        return $this->executeAffected($query);
    }

    function filterPlayerAsc()
    {
        $query = "SELECT * FROM player JOIN role ON player.role_id=role.role_id JOIN team ON player.team_id=team.team_id ORDER BY nama ASC";
        return $this->execute($query);
    }

    function filterPlayerDesc()
    {
        $query = "SELECT * FROM player JOIN role ON player.role_id=role.role_id JOIN team ON player.team_id=team.team_id ORDER BY nama DESC";
        return $this->execute($query);
    }
}
