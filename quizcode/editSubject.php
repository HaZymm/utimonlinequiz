<?php

include("db.php");

$subjectCode = "";
$subjectName = "";
$staffID = "";

$errorMessage = "";
$successMessage = "";


// Fetch staff IDs from the database where staffType is 'lecturer'
$lecturerSql = "SELECT s.staffID, l.lecturerName FROM staff s INNER JOIN lecturer l ON s.staffID = l.staffID WHERE s.staffType = 'L'";
$lecturerResult = $connect->query($lecturerSql);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method shows data of subject
    if (!isset($_GET['subjectCode'])) {
        header("Location: subjectList.php");
        exit;
    }

    $subjectCode = $_GET['subjectCode'];

    // Read row selected from database
    $sql = "SELECT * FROM subject WHERE subjectCode='$subjectCode'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: subjectList.php");
        exit;
    }

    $subjectCode = $row['subjectCode'];
    $subjectName = $row['subjectName'];
    $staffID = $row['staffID'];
} else {
    // POST method updates subject data
    $subjectCode = $_POST['subjectCode'];
    $subjectName = $_POST['subjectName'];
    $staffID = $_POST['staffID'];

    do {
        if (empty($subjectCode) || empty($subjectName) || empty($staffID)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Check if the staff ID exists
        $staffCheckSql = "SELECT * FROM staff WHERE staffID='$staffID'";
        $staffCheckResult = $connect->query($staffCheckSql);

        if ($staffCheckResult->num_rows == 0) {
            $errorMessage = "Staff ID does not exist";
            break;
        }

        $sql = "UPDATE subject SET subjectName='$subjectName', staffID='$staffID' WHERE subjectCode='$subjectCode'";
        $result = $connect->query($sql);

        if (!$result) {
            $errorMessage = "Error: " . $connect->error;
            break;
        }

        $successMessage = "Subject updated correctly";
        header("Location: subjectList.php?success=true");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="subject.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
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
            <h1>Edit Subject Detail</h1>
            <input type="hidden" name="subjectCode" value="<?php echo $subjectCode; ?>">
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" name="subjectCodeDisplay" value="<?php echo $subjectCode; ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Subject Name"  name="subjectName" value="<?php echo $subjectName; ?>">
                </div>
            </div>

            <div class="input-group mb-3">
            <select class="form-control" id="staffID" name="staffID" value="<?php echo $staffID; ?>" required>
            <option value="" disabled selected>Select Staff ID</option>
            <?php
            if ($lecturerResult->num_rows > 0) {
                  while ($row = $lecturerResult->fetch_assoc()) {
                      echo "<option value='".$row['staffID']."'>".$row['staffID']." - ".$row['lecturerName']."</option>";
              }
            }
            ?>
        </select>
      </div>
    
            <div class="row mb-3">
                <div class="col-6 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-6 d-grid">
                    <a class="btn btn-outline-primary" href="subjectList.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
