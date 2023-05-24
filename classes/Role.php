<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* role class */
class Role extends DB
{
    function getRole()
    {
        $query = "SELECT * FROM role";
        return $this->execute($query);
    }

    function getRoleById($id)
    {
        $query = "SELECT * FROM role WHERE role_id=$id";
        return $this->execute($query);
    }

    function addRole($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO role VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateRole($id, $data)
    {
        $role_nama = $data['nama'];
        $query = "UPDATE role SET role_nama = '$role_nama' WHERE role_id=$id";
        return $this->executeAffected($query);
    }

    function deleteRole($id)
    {
        $query = "DELETE FROM role WHERE role_id = $id";
        return $this->executeAffected($query);
    }

    function filterRoleAsc()
    {
        $query = "SELECT * FROM role ORDER BY role_nama ASC";
        return $this->execute($query);
    }

    function filterRoleDesc()
    {
        $query = "SELECT * FROM role ORDER BY role_nama DESC";
        return $this->execute($query);
    }

    function searchRole($keyword)
    {
        $query = "SELECT * FROM role WHERE role_nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }
}
