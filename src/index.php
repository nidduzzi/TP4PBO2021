<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();


$warning = "";
// add form data to database
if (isset($_POST['add'])) {
    if ((!empty($_POST['name']) || isset($_POST['tname'])) &&
        (!empty($_POST['email']) || isset($_POST['email'])) &&
        (!empty($_POST['phone']) || isset($_POST['phone'])) &&
        (!empty($_POST['size']) || isset($_POST['size'])) &&
        (!empty($_POST['color']) || isset($_POST['color'])) &&
        (!empty($_POST['reason']) || isset($_POST['reason']))) {
            $query = 'INSERT INTO contest_entries (ce_name, ce_email, ce_phone, ce_size, ce_color, ce_s_laces, ce_m_logo, ce_l_up, ce_mp3, ce_reason) VALUES("'.$_POST['name'].'",
            "'.$_POST['email'].'",
            "'.$_POST['phone'].'",
            "'.$_POST['size'].'",
            "'.$_POST['color'].'",
            "'.isset($_POST['s_laces']).'",
            "'.isset($_POST['m_logo']).'",
            "'.isset($_POST['l_up']).'",
            "'.isset($_POST['mp3']).'",
            "'.$_POST['reason'].'")';
            $otask->execute($query);
    }
    else {
        $warning = '<div class="alert alert-warning" role="alert">Please fill in all required fields!</div>';
        unset($_POST['add']);
    }
}
elseif (isset($_POST['edit'])) {
    if ((!empty($_POST['id']) || isset($_POST['id'])) &&
    (!empty($_POST['name']) || isset($_POST['name'])) &&
    (!empty($_POST['email']) || isset($_POST['email'])) &&
    (!empty($_POST['phone']) || isset($_POST['phone'])) &&
    (!empty($_POST['size']) || isset($_POST['size'])) &&
    (!empty($_POST['color']) || isset($_POST['color'])) &&
    (!empty($_POST['reason']) || isset($_POST['reason']))) {
        $query = 'UPDATE contest_entries SET ce_name="'.$_POST['name'].'", ce_email="'.$_POST['email'].'", ce_phone="'.$_POST['phone'].'", ce_size="'.$_POST['size'].'", ce_color="'.$_POST['color'].'", ce_s_laces="'.isset($_POST['s_laces']).'", ce_m_logo="'.isset($_POST['m_logo']).'", ce_l_up="'.isset($_POST['l_up']).'", ce_mp3="'.isset($_POST['mp3']).'", ce_reason="'.$_POST['reason'].'" WHERE ce_id="'.$_POST['id'].'"';
        
        $otask->execute($query);
        unset($_POST['edit']);
    }
    else {
        $warning = '<div class="alert alert-warning" role="alert">Please fill in all required fields!</div>';
    }
}

// delete data from database
if(!empty($_GET['id_hapus']) || isset($_GET['id_hapus'])){
    $query = "DELETE FROM contest_entries WHERE ce_id=".$_GET['id_hapus'];
    $otask->execute($query);
}

// edit
if(!empty($_GET['id_edit']) || isset($_GET['id_edit']) || isset($_POST['edit'])){
    $query = 'SELECT * FROM contest_entries WHERE ce_id='.$_GET['id_edit'];
    $otask->execute($query);
    $result = $otask->getResult();
    $tpl = new Template("templates/edit.html");
    $tpl->replace("DATA_FORM", json_encode($result));
    $tpl->replace("DATA_ID", $result['ce_id']);
    $tpl->write();
}
else
{
    if(isset($_GET['sort']) && !empty($_GET['sort'])){
        session_start();
        $_SESSION['sort'] = $_GET['sort'];
    }
    
    // Memanggil method getTask di kelas Task
    $otask->getTask();
    
    // Proses mengisi tabel dengan data
    $data = null;
    $no = 1;
    
    while (list($id, $name, $email, $phone, $size, $color, $s_laces, $m_logo, $l_up, $mp3, $reason) = $otask->getResult()) {
        // Tampilan jika status task nya sudah dikerjakan
        $data .= '<tr>
        <td scope="row">' . $no . "</td>
        <td>" . $name . "</td>
        <td>" . $email . "</td>
        <td>" . $phone . "</td>
        <td>" . $size . "</td>
        <td>" . $color . "</td>
        <td>" . $s_laces . "</td>
        <td>" . $m_logo . "</td>
        <td>" . $l_up . "</td>
        <td>" . $mp3 . "</td>
        <td>" . $reason . "</td>
        <td>
        <button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
        <button class='btn btn-success' ><a href='index.php?id_edit=" . $id .  "' style='color: white; font-weight: bold;'>Edit</a></button>
        </td>
        </tr>";
        $no++;
    }
    
    // Menutup koneksi database
    $otask->close();
    
    // Membaca template skin.html
    $tpl = new Template("templates/index.html");
    
    // Menampilkan warning jika salah masukan
    $tpl->replace("DATA_WARNING", $warning);

    // Mengganti kode Data_Tabel dengan data yang sudah diproses
    $tpl->replace("DATA_TABEL", $data);
    
    // Menampilkan ke layar
    $tpl->write();
}
