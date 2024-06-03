<?php
include("db.php");

$subjectCode = "";
$subjectName = "";
$staffID = "";

$errorMessage = "";
$successMessage = "";

// Fetch staff IDs from the database where staffType is 'lecturer'
$lecturerSql = "SELECT s.staffID, l.lecturerName FROM staff s JOIN lecturer l ON s.staffID = l.staffID WHERE s.staffType = 'L'";
$lecturerResult = $connect->query($lecturerSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectCode = $_POST['subjectCode'];
    $subjectName = $_POST['subjectName'];
    $staffID = $_POST['staffID'];

    // Check if any field is empty
    if (empty($subjectCode) || empty($subjectName) || empty($staffID)) {
        $errorMessage = "All fields are required";
    } else {
        // Check if the subject code already exists
        $subjectCheckSql = "SELECT * FROM subject WHERE subjectCode='$subjectCode'";
        $subjectCheckResult = $connect->query($subjectCheckSql);

        if ($subjectCheckResult->num_rows > 0) {
            $errorMessage = "Subject with this code already exists";
        } else {
            // Check if the staff ID exists in staff table
            $staffCheckSql = "SELECT * FROM staff WHERE staffID='$staffID'";
            $staffCheckResult = $connect->query($staffCheckSql);

            if ($staffCheckResult->num_rows == 0) {
                $errorMessage = "Staff with this ID does not exist";
            } else {
                // Insert data into the subject table
                $sql = "INSERT INTO subject (subjectCode, subjectName, staffID) VALUES ('$subjectCode', '$subjectName', '$staffID')";
                $result = $connect->query($sql);

                if (!$result) {
                    $errorMessage = "Error: " . $connect->error;
                } else {
                    $successMessage = "Subject added correctly";
                    // Redirect to subject list page with success parameter
                    header("location: subjectList.php?success=true");
                    exit;
                }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="subject.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Lecturer's Detail</title>

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
  </style>
</head>
<body>
  <div class="container">
    <h2>SUBJECT DETAIL</h2>
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
        <input type="text" class="form-control" id="subjectCode" placeholder="Enter Subject Code" name="subjectCode" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control" id="subjectName" placeholder="Enter Subject Name" name="subjectName" required>
      </div>

      <div class="input-group mb-3">
        <select class="form-control scrollable-container" id="staffID" name="staffID" required>
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
