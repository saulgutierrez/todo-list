<!DOCTYPE html>
<?php include 'db.php';
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id = '$id'";
    $rows = $db->query($sql);
    $row = $rows->fetch_assoc();

    if (isset($_POST['send'])) {
        $task = htmlspecialchars($_POST['task']);
        $sql = "UPDATE tasks SET name = '$task' WHERE id = '$id'";
        $db->query($sql);
        header('Location: index.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Crud App</title>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <center><h1>Update Todo List</h1></center>
            <div>
            <table class="table">
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label>Task name</label>
                        <input type="text" required name="task" class="form-control" value="<?php echo $row['name']; ?>">
                    </div>
                    <br>
                    <input type="submit" name="send" value="Update" class="btn btn-success">&nbsp;
                    <a href="index.php" class="btn btn-warning">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>