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
        <h1>CGPA and GPA CALCULATION</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate"])) {
            // Retrieve the number of subjects, grades, and credits from the form
            $numSubjects = isset($_POST["numSubjects"]) ? intval($_POST["numSubjects"]) : 0;
            $grades = isset($_POST["grade"]) ? $_POST["grade"] : array();
            $credits = isset($_POST["credit"]) ? $_POST["credit"] : array();

            // Check if the number of subjects, grades, and credits are valid
            if ($numSubjects > 0 && count($grades) === $numSubjects && count($credits) === $numSubjects) {
                // Calculate total grade points and total credits
                $totalGradePoints = 0;
                $totalCredits = 0;

                for ($i = 0; $i < $numSubjects; $i++) {
                    // Convert grades to grade points (you can customize this based on your grading system)
                    $gradePoints = getGradePoints($grades[$i]);

                    // Calculate subject GPA for each subject
                    $subjectGPA = $gradePoints * $credits[$i];

                    // Accumulate total grade points and total credits
                    $totalGradePoints += $subjectGPA;
                    $totalCredits += $credits[$i];
                }

                // Calculate CGPA
                $cgpa = ($totalGradePoints / $totalCredits);

                // Display the results
                echo "<p>CGPA: " . number_format($cgpa, 2) . "</p>";
                echo "<p>GPA: " . number_format(($totalGradePoints / $numSubjects), 2) . "</p>";
            } else {
                echo "<p>Error: Invalid input.</p>";
            }

             // Add button to go back to main.php
             echo "<form action='main.php' method='get'>";
             echo "<input type='submit' value='Go back to Main Page'>";
             echo "</form>";
        }

        // Function to convert grades to grade points (customize based on your grading system)
        function getGradePoints($grade) {
            // Example grading system, you can modify it based on your grading system
            $gradingSystem = array(
                "A+" => 4.0,
                "A"  => 4.0,
                "A-" => 3.7,
                "B+" => 3.3,
                "B"  => 3.0,
                "B-" => 2.7,
                "C+" => 2.3,
                "C"  => 2.0,
                "C-" => 1.7,
                "D+" => 1.3,
                "D"  => 1.0,
                "D-" => 0.7,
                "F"  => 0.0
            );

            // Default to 0.0 if grade not found
            return isset($gradingSystem[$grade]) ? $gradingSystem[$grade] : 0.0;
        }
        ?>
    </div>
</body>
</html>
