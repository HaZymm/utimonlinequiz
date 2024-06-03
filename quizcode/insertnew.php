<?php
include("db.php");

$studentNumber = "";
$studentName = "";
$studentEmail = "";
$studentPassword = "";
$classCode = "";

$errorMessage = "";
$successMessage = "";

// Fetch class codes from the database
$classCheckSql = "SELECT * FROM class";
$classCheckResult = $connect->query($classCheckSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentNumber = $_POST['studentNumber'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['studentEmail'];
    $studentPassword = $_POST['studentPassword'];
    $classCode = $_POST['classCode'];

    // Check if any field is empty
    if (empty($studentNumber) || empty($studentName) || empty($studentEmail) || empty($studentPassword) || empty($classCode)) {
        $errorMessage = "All fields are required";
    } else {
        // Check if the student number already exists
        $studentCheckSql = "SELECT * FROM student WHERE studentNumber='$studentNumber'";
        $studentCheckResult = $connect->query($studentCheckSql);

        if ($studentCheckResult->num_rows > 0) {
            $errorMessage = "Student with this number already exists";
        } else {
            // Insert data into the student table
            $sql = "INSERT INTO student (studentNumber, studentName, studentEmail, studentPassword, classCode) VALUES ('$studentNumber', '$studentName', '$studentEmail', '$studentPassword', '$classCode')";
            $result = $connect->query($sql);

            if (!$result) {
                $errorMessage = "Error: " . $connect->error;
            } else {
                $successMessage = "Client added correctly";
                // Redirect to student list page with success parameter
                header("location: studentList.php?success=true");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="subject.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Student Detail</title>
  
  <script>
    window.onload = function() {
      const urlParams = new URLSearchParams(window.location.search);
      const success = urlParams.get('success');
      if (success === 'true') {
        alert('Data has been saved successfully!');
      }
    };

    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    };

    function generatePassword() {
      var length = 8,
          charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()",
          retVal = "";
      for (var i = 0, n = charset.length; i < length; ++i) {
          retVal += charset.charAt(Math.floor(Math.random() * n));
      }
      document.getElementById("password").value = retVal;
    }
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

    .input-group.mb-3 {
        display: flex;
    }

    .input-group.mb-3 .form-control,
    .input-group.mb-3 .btn-outline-secondary {
        height: calc(1.5em + .75rem + 2px); /* Match Bootstrap's input height */
    }
  </style>
</head> 
<body>
  <div class="container">
    <h2>STUDENT DETAIL</h2>
    <!-- Display error message if there's one -->
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
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="studentNumber" placeholder="Enter Student ID" name="studentNumber" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control" id="studentName" placeholder="Enter Student Name" name="studentName" required>
      </div>

      <div class="input-group mb-3">
        <select class="form-control scrollable-container" id="classCode" name="classCode" required>
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

      <div class="input-group mb-3">
        <input type="email" class="form-control" id="email" placeholder="Enter Student Email" name="studentEmail" required>
      </div>

      <div class="input-group mb-3">
        <input type="password" class="form-control" id="password" placeholder="Enter Student Password" name="studentPassword" required>
        <button type="button" class="btn btn-outline-secondary" onclick="generatePassword()">Generate Password</button>
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
<footer class="footer">
    <img src="gambar/goquiztexttransparent.png" class="classtop"> 
</footer>
</html>