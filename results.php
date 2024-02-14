<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .main {
            align-items: center;
        }
    </style>
    <title>Calculate CGPA UTHM</title>
</head>
<body>
    <div class="main">
        <h1>UTHM CGPA CALCULATOR RESULTS</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the number of subjects from the form
            $numSubjects = isset($_POST["subjects"]) ? intval($_POST["subjects"]) : 0;

            // Check if the number of subjects is valid
            if ($numSubjects > 0) {
                echo "<form action='calculate_cgpa.php' method='post'>";
                echo "<table>";
                echo "<tr><th>Subject</th><th>Grade</th><th>Credit</th></tr>";

                // Loop through each subject to input grade and credit
                for ($i = 1; $i <= $numSubjects; $i++) {
                    echo "<tr>";
                    echo "<td>Subject $i:</td>";
                    echo "<td><input type='text' name='grade[]' placeholder='Enter Grade'></td>";
                    echo "<td><input type='text' name='credit[]' placeholder='Enter Credit'></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "<input type='hidden' name='numSubjects' value='$numSubjects'>";
                echo "<input type='submit' name='calculate' value='Calculate CGPA'>";
                echo "</form>";
            } else {
                echo "<p>Please enter a valid number of subjects.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
