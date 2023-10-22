<?php
session_start();
require_once "dbconfig.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mx-auto w-50 my-5">
        <a href="create.php">New</a>
        <?php
        if (isset($_SESSION['response'])) {
            $alertMsg = $_SESSION['response'];
            unset($_SESSION['response']);
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'> 
                $alertMsg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
            </div>";
        }
        ?>
        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Skill</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tblemployee";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['skill']; ?></td>
                            <td><img src="uploads/<?php echo $row['image']; ?>" alt="skill image" width="50"></td>
                            <td><a href="edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a></td>
                            <td><a onclick="javascript: return confirm('Are you sure to delete')" href="delete.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>