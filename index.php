<!DOCTYPE html>
<?php include 'db.php';

    $page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
    $perPage = (isset($_GET['per-page']) && ((int)$_GET['per-page']) <= 50 ? (int)$_GET['per-page'] : 5);
    $start = ($page > 1) ?  ($page * $perPage) -  $perPage : 0;

    $sql = "SELECT * FROM tasks LIMIT ".$start.", ".$perPage." ";
    $total = $db->query("SELECT * FROM tasks")->num_rows;
    $pages = ceil($total/$perPage);

    $rows = $db->query($sql);
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
            <center><h1>Todo List</h1></center>
            <div>
            <table class="table table-hover">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add Task</button>
                    <button type="button" class="btn btn-danger" onclick="print()">Print</button>
                </div>
                <hr>
                <div class="col-md-12 text-center">
                    <p>Search</p>
                    <form action="search.php" method="POST" class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </form>
                </div>
                <br>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="add.php">
                                <div class="form-group">
                                    <label>Task name</label>
                                    <input type="text" required name="task" class="form-control">
                                </div>
                                <br>
                                <input type="submit" name="send" value="Add Task" class="btn btn-success">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Task</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($row = $rows->fetch_assoc()): ?>   
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td class="col-md-10"><?php echo $row['name']; ?></td>
                            <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php endwhile; ?>
                </tbody>
                </table>
                <ul class="pagination d-flex justify-content-center">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i;?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>