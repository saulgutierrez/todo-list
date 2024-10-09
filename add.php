<?php
    include 'db.php';
    if (isset($_POST['send'])) {
        $name = htmlspecialchars($_POST['task']);
        $sql = "INSERT INTO tasks(name) VALUES('$name')";
        $val = $db->query($sql);

        if ($val) {
            header('Location: index.php');
        }
    }
?>