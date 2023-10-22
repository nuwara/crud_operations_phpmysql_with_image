<?php
session_start();
require_once "dbconfig.php";

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM tblemployee WHERE id='{$id}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $skill = $_POST['skill'];
    $photo = $_FILES['image']['name'];

    $folder = 'uploads/' . $photo;
    $temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp_name, $folder);

    if ($photo) {
        $sql2 = "UPDATE tblemployee SET name='{$name}', email='{$email}', skill='{$skill}', image='{$photo}' WHERE id='{$id}'";
        $result2 = $conn->query($sql2);
        if ($result2) {
            $_SESSION['response'] = 'Record update is successful';
            header('location: index.php');
        } else {
            echo 'Error: '  . $sql2 . '<br>' . $conn->connect_error;
        }
    } elseif (!$photo) {
        $sql3 = "UPDATE tblemployee SET name='{$name}', email='{$email}', skill='{$skill}' WHERE id='{$id}'";
        $result3 = $conn->query($sql3);
        if ($result3) {
            $_SESSION['response'] = 'Record update is successful';
            header('location: index.php');
        } else {
            echo 'Error: '  . $sql3 . '<br>' . $conn->connect_error;
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 align-center">
                <h1>Update Data</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="fullName" value="<?php echo $data['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Skill</label>
                        <input type="text" class="form-control" name="skill" value="<?php echo $data['skill']; ?>">
                    </div>

                    <div class="mb-3">
                        Old image: <img src="uploads/<?php echo $data['image']; ?>" alt="skill image" width="50">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>