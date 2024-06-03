<?php

include("db.php");

$studentNumber = "";
$studentName = "";
$studentEmail = "";
$studentPassword = "";
$classCode = "";

$errorMessage = "";
$successMessage = "";
        
$classCheckSql = "SELECT * FROM class";
$classCheckResult = $connect->query($classCheckSql);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method shows data of student
    if (!isset($_GET['studentNumber'])) {
        header("Location: studentList.php");
        exit;
    }

    $studentNumber = $_GET['studentNumber'];

    // Read row selected from database
    $sql = "SELECT * FROM student WHERE studentNumber='$studentNumber'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: studentList.php");
        exit;
    }

    $studentNumber = $row['studentNumber'];
    $studentName = $row['studentName'];
    $studentEmail = $row['studentEmail'];
    $studentPassword = $row['studentPassword'];
    $classCode = $row['classCode'];
} else {
    // POST method updates student data
    $studentNumber = $_POST['studentNumber'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['studentEmail'];
    $studentPassword = $_POST['studentPassword'];
    $classCode = $_POST['classCode'];

    do {
        if (empty($studentNumber) || empty($studentName) || empty($studentEmail) || empty($studentPassword) || empty($classCode)) {
            $errorMessage = "All fields are required";
            break;
        } else{
             $sql = "UPDATE student SET studentName='$studentName', studentEmail='$studentEmail', studentPassword='$studentPassword', classCode='$classCode' WHERE studentNumber='$studentNumber'";

            $result = $connect->query($sql);
            $successMessage = "Client added correctly";

            header("location: studentList.php");
            exit;
        }

       


        } while (false);
            

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="subject.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        if (success === 'true') {
            alert('Data has been saved successfully!');
        }
    };

    function myFunction() {
        var x = document.getElementById("studentPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    };
    </script>
  
    <style type="text/css">
        body {
            color: grey;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: ghostwhite;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .row {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <h1>Edit Student Detail</h1>
            <input type="hidden" name="studentNumber" value="<?php echo $studentNumber; ?>">
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" name="studentNumberDisplay" value="<?php echo $studentNumber; ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Student Name"  name="studentName" value="<?php echo $studentName; ?>">
                </div>
            </div>

            <div class="input-group mb-3">
            <select class="form-control scrollable-container" id="classCode" name="classCode" value="<?php echo $classCode; ?>" required>
            <option value="" disabled selected>Select Group</option>
            <?php
            if ($classCheckResult->num_rows > 0) {
                 while ($row = $classCheckResult->fetch_assoc()) {
                      echo "<option value='".$row['classCode']."'>".$row['classCode']." - ".$row['className']."</option>";
                }
            }
          ?>
            </select>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input type="email" class="form-control" placeholder="Student Email" name="studentEmail" value="<?php echo $studentEmail; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="password" class="form-control" placeholder="Student Password" name="studentPassword" id="studentPassword" value="<?php echo $studentPassword; ?>">
                </div>
            </div>
       
            <div>
                <p><input type="checkbox" onclick="myFunction()"> Show Password</p>
            </div>
            <div class="row mb-3">
                <div class="col-6 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-6 d-grid">
                    <a class="btn btn-outline-primary" href="studentList.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>