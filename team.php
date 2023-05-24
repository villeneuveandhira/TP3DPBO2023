<!-- Saya Villeneuve Andhira Suwandhi NIM 2108067 mengerjakan Tugas Praktikum 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
Aamiin. -->

<?php

/* import */
include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$team->open();
$team->getTeam();

if (isset($_POST['btn-cari'])) {
    $team->searchTeam($_POST['cari']);
} else if (isset($_POST['btn-asc'])) {
    $team->filterTeamAsc();
} else if (isset($_POST['btn-desc'])) {
    $team->filterTeamDesc();
}

if (!isset($_GET['team_id'])) {
    if (isset($_POST['submit'])) {
        if ($team->addTeam($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'team.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'team.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Team';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Team</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Team';

while ($div = $team->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['team_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="team.php?team_id=' . $div['team_id'] . '" title="Edit Data">
        <i class="bi bi-pencil-square text-warning"></i>
        </a>&nbsp;
        <a href="team.php?hapus=' . $div['team_id'] . '" title="Delete Data">
        <i class="bi bi-trash-fill text-danger"></i>
        </a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['team_id'])) {
    $id = $_GET['team_id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($team->updateTeam($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'team.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'team.php';
            </script>";
            }
        }

        $team->getTeamById($id);
        $row = $team->getResult();

        $dataUpdate = $row['team_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($team->deleteTeam($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'team.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'team.php';
            </script>";
        }
    }
}

$team->close();
$view->replace('LINK', 'team.php');
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();