<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* import */
include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Role.php');
include('classes/Player.php');
include('classes/Template.php');

// instantiate
$player = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$player->open();

$data = nulL;

// detail's data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $player->getPlayerById($id);
        $row = $player->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['player_foto'] . '" class="img-thumbnail" alt="' . $row['player_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>' . $row['role_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tim</td>
                                    <td>:</td>
                                    <td>' . $row['team_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form.php?edit=' . $row['id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?del=' . $row['id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    if ($id > 0) {
        if ($player->deleteData($id) > 0) {
            echo
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

$player->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PLAYER', $data);
$detail->write();