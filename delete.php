<?php
    include 'db.php';
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM tasks WHERE id = '$id'";
    $val = $db->query($sql);
    if ($val) {
        header('Location: index.php');
    }
?>