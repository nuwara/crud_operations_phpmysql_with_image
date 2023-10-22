<?php
session_start();
require_once "dbconfig.php";

if (isset($_POST['save'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $skill = $_POST['skill'];
    $photo = $_FILES['image']['name'];

    $folder = 'uploads/' . $photo;
    $temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp_name, $folder);

    $sql = "INSERT INTO tblemployee(name, email, skill, image) VALUES('{$name}', '{$email}', '{$skill}', '{$photo}')";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['response'] = 'New record is added successfully';
        header('location: index.php');
    } else {
        echo 'Error: '  . $sql . '<br>' . $conn->connect_error;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 align-center">
                <h1>Add Data</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="fullName">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Skill</label>
                        <input type="text" class="form-control" name="skill">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">IMage</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>