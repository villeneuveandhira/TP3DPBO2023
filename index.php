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
$players = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$players->open();
$players->getPlayerJoin();

if (isset($_POST['btn-cari'])) {
    $players->searchPlayer($_POST['cari']);
} else if (isset($_POST['btn-asc'])) {
    $players->filterPlayerAsc();
} else if (isset($_POST['btn-desc'])) {
    $players->filterPlayerDesc();
} else {
    $players->getPlayerJoin();
}

$data = null;

// list player data
while ($row = $players->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 player-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['player_foto'] . '" class="card-img-top" alt="' . $row['player_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text player-nama my-0">' . $row['nama'] . '</p>
                <p class="card-text role-nama">' . $row['role_nama'] . '</p>
                <p class="card-text team-nama my-0">' . $row['team_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$players->close();
$home = new Template('templates/skin.html');
$home->replace('DATA_PLAYER', $data);
$home->write();