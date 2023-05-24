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
$temp = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$player->open();
$temp->open();
$role->open();
$team->open();

$opt_role = null;
$opt_team = null;

$img_edit = "";
$nama_edit = "";
$team_edit = "";
$role_edit = "";

// form
$view_form = new Template('templates/skinform.html');
if (!isset($_GET['edit'])) {

    if (isset($_POST['submit'])) {
        if ($player->addData($_POST, $_FILES) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
    }

    $role->getRole();
    while ($row = $role->getResult()) {
        $opt_role .= "<option value=" . $row['role_id'] . ">" . $row['role_nama'] . "</option>";
    }

    $team->getTeam();
    while ($row = $team->getResult()) {
        $opt_team .= "<option value=" . $row['team_id'] . ">" . $row['team_nama'] . "</option>";
    }
} else if (isset($_GET['edit'])) {
    $_ID = $_GET['edit'];
    $temp->getPlayer();
    $temp->getPlayerById($_ID);
    $temp_fnl = $temp->getResult();
    $temp_img = $temp_fnl['player_foto'];

    if (isset($_POST['submit'])) {
        if ($player->updateData($_ID, $_POST, $_FILES, $temp_img) > 0) {
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'tambah.php';
                </script>
                ";
        }
    }

    $player->getPlayerById($_ID);

    $row = $player->getResult();
    $nama_edit = $row['player_nama'];
    $img_edit = $row['player_foto'];
    $role_edit = $row['role_id'];
    $team_edit = $row['team_id'];

    $role->getRole();
    while ($row = $role->getResult()) {
        $select = ($row['role_id'] == $role_edit) ? 'selected' : "";
        $opt_role .= "<option value=" . $row['role_id'] . " . $select . >" . $row['role_nama'] . "</option>";
    }

    $team->getTeam();
    while ($row = $team->getResult()) {
        $select = ($row['team_id'] == $team_edit) ? 'selected' : "";
        $opt_team .= "<option value=" . $row['team_id'] . " . $select . >" . $row['team_nama'] . "</option>";
    }
}

$view_form->replace('NAMA_DATA', $nama_edit);
$view_form->replace('IMAGE_DATA', $img_edit);
$view_form->replace('ROLE_DATA', $role_edit);
$view_form->replace('ROLE_OPTION', $opt_role);
$view_form->replace('TEAM_DATA', $team_edit);
$view_form->replace('TEAM_OPTION', $opt_team);
$view_form->write();
$player->close();
$role->close();
$team->close();
