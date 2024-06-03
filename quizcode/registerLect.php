<?php
include("db.php");

$staffID = "";
$lecturerName = "";
$lecturerEmail = "";
$lecturerPassword = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staffID = $_POST['staffID'];
    $lecturerName = $_POST['lecturerName'];
    $lecturerEmail = $_POST['lecturerEmail'];
    $lecturerPassword = $_POST['lecturerPassword'];

    // Check if any field is empty
    if (empty($staffID) || empty($lecturerName) || empty($lecturerEmail) || empty($lecturerPassword)) {
        $errorMessage = "All fields are required";
    } else {
        // Check if the staff ID already exists
        $staffCheckSql = "SELECT * FROM staff WHERE staffID='$staffID'";
        $staffCheckResult = $connect->query($staffCheckSql);

        if ($staffCheckResult->num_rows > 0) {
            $errorMessage = "Staff with this ID already exists";
        } else {
            // Insert data into the staff table
            $sql = "INSERT INTO staff (staffID, staffType) VALUES ('$staffID', 'L')";
            $result = $connect->query($sql);

            if (!$result) {
                $errorMessage = "Error: " . $connect->error;
            } else {
                // Insert data into the lecturer table
                $sql = "INSERT INTO lecturer (staffID, lecturerName, lecturerEmail, lecturerPassword) VALUES ('$staffID', '$lecturerName', '$lecturerEmail', '$lecturerPassword')";
                $result = $connect->query($sql);

                if (!$result) {
                    $errorMessage = "Error: " . $connect->error;
                } else {
                    $successMessage = "Lecturer added correctly";
                    // Redirect to lecturer list page with success parameter
                    header("Location: Lecturer Database.php?success=true");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer's Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="subject.css">
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
                charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()",retVal = "";
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
    </style>

</head>
<body>
    <div class="container">
        <h2>LECTURER'S DETAIL</h2>
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
        <form name="register" method="post">
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Enter Lecturer Name" name="lecturerName" value="<?php echo $lecturerName; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Enter Staff ID" name="staffID" value="<?php echo $staffID; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <input type="email" class="form-control" placeholder="Enter Lecturer Email" name="lecturerEmail" value="<?php echo $lecturerEmail; ?>" required>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" placeholder="Enter Lecturer Password" name="lecturerPassword" required>
                <button type="button" class="btn btn-outline-secondary" onclick="generatePassword()">Generate Password</button>
            </div>
            <div>
                <p><input type="checkbox" onclick="myFunction()"> Show Password</p>
            </div>
            <div class="row mb-3">
                <div class="col-6 d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="col-6 d-grid">
                    <a class="btn btn-outline-primary" href="Lecturer Database.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>