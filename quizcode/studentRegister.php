<?php
include("db.php");

// Initialize studentNumber from POST or GET
$studentNumber = isset($_POST['studentNumber']) ? $_POST['studentNumber'] : (isset($_GET['studentNumber']) ? $_GET['studentNumber'] : '');
$errorMessage = "";

// Fetch subjects the student has not registered for
$unregisteredSql = "
SELECT s.subjectCode, s.subjectName
FROM subject s
LEFT JOIN registration r
ON s.subjectCode = r.subjectCode
AND r.studentNumber = '$studentNumber'
WHERE r.subjectCode IS NULL";
$unregisteredResult = $connect->query($unregisteredSql);

// Fetch subjects the student is already registered for
$registeredSql = "
SELECT s.subjectCode, s.subjectName
FROM registration r
JOIN subject s
ON r.subjectCode = s.subjectCode
WHERE r.studentNumber = '$studentNumber'";
$registeredResult = $connect->query($registeredSql);

// Get initially registered subjects
$initiallyRegisteredSubjects = [];
if ($registeredResult->num_rows > 0) {
    while ($row = $registeredResult->fetch_assoc()) {
        $initiallyRegisteredSubjects[$row['subjectCode']] = $row['subjectName'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectsToRegister = isset($_POST['subjects']) ? $_POST['subjects'] : [];
    $subjectsToUnregister = array_diff(array_keys($initiallyRegisteredSubjects), $subjectsToRegister);
    $errors = [];

    // Register new subjects
    foreach ($subjectsToRegister as $subjectCode) {
        if (!array_key_exists($subjectCode, $initiallyRegisteredSubjects)) {
            $sql = "INSERT INTO registration (studentNumber, subjectCode) VALUES ('$studentNumber', '$subjectCode')";
            if (!$connect->query($sql)) {
                $errors[] = "Error registering for subject $subjectCode: " . $connect->error;
            }
        }
    }

    // Unregister subjects
    foreach ($subjectsToUnregister as $subjectCode) {
        $sql = "DELETE FROM registration WHERE studentNumber = '$studentNumber' AND subjectCode = '$subjectCode'";
        if (!$connect->query($sql)) {
            $errors[] = "Error unregistering from subject $subjectCode: " . $connect->error;
        }
    }

    if (count($errors) > 0) {
        $errorMessage = implode("<br>", $errors);
    } else {
        header("location: studentList.php?success=true");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="master.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="subject.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Register for Subjects</title>

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
    .scrollable-container {
        max-height: 200px; /* Adjust the height as needed */
        overflow-y: auto;
        border: 1px solid #ccc; /* Optional: to visually differentiate the scrollable area */
        padding: 10px; /* Optional: for better spacing */
        background-color: #f9f9f9; /* Optional: to match the rest of your design */
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
    <h2>REGISTER FOR SUBJECT</h2>
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
      <input type="hidden" name="studentNumber" value="<?php echo htmlspecialchars($studentNumber); ?>">
      <div class="row mb-3">
        <div class="col-12">
          <input type="text" class="form-control" name="studentNumberDisplay" value="<?php echo htmlspecialchars($studentNumber); ?>" disabled>
        </div>
      </div>

      <!-- Display registered subjects -->
      <div class="mb-3 scrollable-container">
        <div class="border border-blue p-3 rounded">
          <label class="form-label">Registered Subjects</label>
          <div id="registeredSubjects" class="mt-2 ">
            <?php
            if (!empty($initiallyRegisteredSubjects)) {
                foreach ($initiallyRegisteredSubjects as $subjectCode => $subjectName) {
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="subjects[]" value="' . $subjectCode . '" checked>';
                    echo '<label class="form-check-label">' . $subjectName . '</label>';
                    echo '</div>';
                }
            } else {
                echo '<p>No registered subjects found.</p>';
            }
            ?>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <div class="border border-blue p-3 rounded scrollable-container">
          <label class="form-label">Select Subjects</label>
          <div id="subjects" class="mt-2 ">
            <?php
            if ($unregisteredResult->num_rows > 0) {
                while ($row = $unregisteredResult->fetch_assoc()) {
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="subjects[]" value="' . $row['subjectCode'] . '">';
                    echo '<label class="form-check-label">' . $row['subjectName'] . '</label>';
                    echo '</div>';
                }
            } else {
                echo '<p>No unregistered subjects available.</p>';
            }
            ?>
          </div>
        </div>
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