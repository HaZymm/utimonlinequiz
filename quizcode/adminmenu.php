<?php
    include 'db.php';
    session_start();
    $email = $_SESSION['email'];
    $id = $_SESSION['id'];


// Fetch subject codes and names
$subjectSql = "SELECT subjectCode, subjectName FROM subject";
$subjectResult = $connect->query($subjectSql);
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="subject.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Subject List</title>
    <style>
        /* General Styles */


        /* Dropdown Container */
        .dropdown-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: auto;
            margin-top: 20px;
        }

        .dropdown-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Form Control Styles */
        .form-control {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        }

        /* Button Styles */
        button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Button Hover Styles */
        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            transition: transform 0.5s ease, background-color 0.5s ease;
        }


        /* Chart Title Styles */
        .chart-title {
            text-align: center;
            font-size: 1.5em;
            color: #333333;
            margin-top: 20px;
            font-weight: bold;
            color: white;
        }


    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li class="logo" style="--bg:#333">
                <a href="#">
                    <div class="icon"><ion-icon name="logo-amplify"></ion-icon></div>
                    <div class="text">Go Quiz Inno.</div>
                </a>
            </li>
            <li style="--bg:#f44336" class="active">
                <a href="adminmenu.php">
                    <div class="icon"><ion-icon name="home-outline"></ion-icon></div>
                    <div class="text">Home</div>
                </a>
            </li>
            <li style="--bg:#0fa117">
                <a href="Lecturer Database.php">
                    <div class="icon"><ion-icon name="briefcase-outline"></ion-icon></div>
                    <div class="text">Lecture List</div>
                </a>
            </li>
            <li style="--bg:#0fa117">
                <a href="studentList.php">
                    <div class="icon"><ion-icon name="book-outline"></ion-icon></div>
                    <div class="text">Student List</                </a>
            </li>
            <li style="--bg:#b145e9">
                <a href="subjectList.php">
                    <div class="icon"><ion-icon name="people-circle-outline"></ion-icon></div>
                    <div class="text">Subject</div>
                </a>
            </li>
            <li style="--bg:#333">
                <a href="logout.php">
                    <div class="icon"><ion-icon name="log-out-outline"></ion-icon></div>
                    <div class="text">Logout</div>
                </a>
            </li>
        </ul>
    </div>

    <div id="main">
        <div class="w3-teal-custom">
            <div class="w3-container">
                <h1 id="namepage">Academic Report</h1>
            </div>
        </div>

        <div class="dropdown-container">
            <form method="post" action="generate_chart.php">

                <!-- Subject Code Dropdown -->
                <select class="form-control" id="subjectCode" name="subjectCode" required>
                    <option value="" disabled selected>Select Subject Code</option>
                    <?php
                    if ($subjectResult->num_rows > 0) {
                        while ($row = $subjectResult->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['subjectCode']) . "'>" . htmlspecialchars($row['subjectCode']) . " - " . htmlspecialchars($row['subjectName']) . "</option>";
                        }
                    }
                    ?>
                </select>

                <!-- Class Code Dropdown -->
                <select class="form-control" id="classCode" name="classCode" required>
                    <option value="" disabled selected>Select Class Code</option>
                    <!-- Options will be populated by AJAX -->
                </select>

                <!-- Question Topic Dropdown -->
                <select class="form-control" id="questionTopic" name="questionTopic" required>
                    <option value="" disabled selected>Select Question Topic</option>
                    <!-- Options will be populated by AJAX -->
                </select>

                <!-- Submit Button -->
                <button type="submit">Generate Chart</button>
            </form>
        </div>

        <?php if (isset($_SESSION['chartData'])): ?>
            <?php
            $chartData = $_SESSION['chartData'];
            $studentNames = $chartData['studentNames'];
            $marks = $chartData['marks'];
            $subjectCode = htmlspecialchars($chartData['subjectCode']);
            $classcode = htmlspecialchars($chartData['classCode']);
            $questionTopic = htmlspecialchars($chartData['questionTopic']);
            unset($_SESSION['chartData']); // Clear session data after using it
            ?>
            <div class="chart-title" >
                <?php echo " TITLE: $subjectCode - $classcode - $questionTopic"; ?>
            </div>
            <div>
                <canvas id="myChart" width="250px" height="175px" style="margin-left: 100px;
                background-color: white; border-radius: 8px; border-style: solid; box-shadow:0 4px 8px rgba(0, 0, 0,9);"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var colors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($studentNames); ?>,
                            datasets: [{
                                label: 'Marks',
                                data: <?php echo json_encode($marks); ?>,
                                backgroundColor: colors,
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Marks'
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        <?php endif; ?>

    </div>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        document.getElementById('subjectCode').addEventListener('change', function() {
            const subjectCode = this.value;
            fetch('fetch_classes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `subjectCode=${encodeURIComponent(subjectCode)}`
            })
            .then(response => response.json())
            .then(data => {
                const classCodeSelect = document.getElementById('classCode');
                classCodeSelect.innerHTML = '<option value="" disabled selected>Select Class Code</option>';
                data.forEach(classItem => {
                    classCodeSelect.innerHTML += `<option value="${classItem.classCode}">${classItem.classCode}</option>`;
                });
            });
        });

        document.getElementById('classCode').addEventListener('change', function() {
            const classCode = this.value;
            fetch('fetch_topics.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `classCode=${encodeURIComponent(classCode)}`
            })
            .then(response => response.json())
            .then(data => {
                const questionTopicSelect = document.getElementById('questionTopic');
                questionTopicSelect.innerHTML = '<option value="" disabled selected>Select Question Topic</option>';
                data.forEach(topicItem => {
                    questionTopicSelect.innerHTML += `<option value="${topicItem.questionTopic}">${topicItem.questionTopic}</option>`;
                });
            });
        });

        let menuToggle = document.querySelector('.logo');
        let sidebar = document.querySelector('.sidebar');
        menuToggle.onclick = function() {
            sidebar.classList.toggle('active');
        }

        let Menulist = document.querySelectorAll('.sidebar ul li:not(.logo)');
        function activelink() {
            Menulist.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        Menulist.forEach((item) => item.addEventListener('click', activelink));
    </script>

    <footer class="footer">
        <p>© 2024 Go Guiz - All Rights Reserved</p>
    </footer>
</body>
</html>
