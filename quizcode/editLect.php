<?php
$user = "root"; // MySQL username
$pass = ""; // MySQL password
$host = "localhost"; // Server name or IP address
$dbname = "quiz1";

$connect = mysqli_connect($host, $user, $pass, $dbname);

$lecturerName = "";
$lecturerEmail = "";
$lecturerPassword = "";
$staffID = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get method: show data of lecturer
    if (!isset($_GET["staffID"])) {
        header("Location: LecturerDatabase.php");
        exit;
    }

    $staffID = $_GET['staffID'];

    // Read row selected from database
    $sql = "SELECT * FROM lecturer WHERE staffID='$staffID'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: LecturerDatabase.php");
        exit;
    }

    // Correctly assign values from the associative array
    $lecturerName = $row['lecturerName'];
    $lecturerEmail = $row['lecturerEmail'];
    $lecturerPassword = $row['lecturerPassword'];
} else {
    // Post method: update lecturer data
    $staffID = $_POST['staffID'];
    $lecturerName = $_POST['lecturerName'];
    $lecturerEmail = $_POST['lecturerEmail'];
    $lecturerPassword = $_POST['lecturerPassword'];

    do {
        if (empty($staffID) || empty($lecturerName) || empty($lecturerEmail) || empty($lecturerPassword)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE lecturer SET lecturerName='$lecturerName', lecturerEmail='$lecturerEmail', lecturerPassword='$lecturerPassword' WHERE staffID='$staffID'";
        $result = $connect->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connect->error;
            break;
        }

        $successMessage = "Lecturer updated successfully";

        header("Location: Lecturer Database.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer</title>
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
        var x = document.getElementById("lecturerPassword");
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

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <h1>Edit Lecturer Detail</h1>
            <input type="hidden" name="staffID" value="<?php echo $staffID; ?>">
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" name="staffID" value="<?php echo $staffID; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Lecturer Name" name="lecturerName" value="<?php echo $lecturerName; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input type="email" class="form-control" placeholder="Lecturer Email" name="lecturerEmail" value="<?php echo $lecturerEmail; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="password" class="form-control" placeholder="Lecturer Password" name="lecturerPassword" id="lecturerPassword" value="<?php echo $lecturerPassword; ?>">
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
                    <a class="btn btn-outline-primary" href="Lecturer Database.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
