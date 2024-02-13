<!DOCTYPE html>
<html>
<head>
    <title>Maximum and Minimum CGPA/GPA Calculator</title>
</head>
<body>

<h2>Maximum and Minimum CGPA/GPA Calculator for UTHM</h2>

<form method="post" action="">
    <label>Number of Courses: </label>
    <input type="number" name="num_courses" min="1" required><br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numCourses = $_POST["num_courses"];
        
        echo '<h3>Enter Course Details:</h3>';
        for ($i = 1; $i <= $numCourses; $i++) {
            echo '<label>Course ' . $i . ' Name: </label>';
            echo '<input type="text" name="course_name[' . $i . ']" required><br>';
            
            echo '<label>Credit Hours for Course ' . $i . ': </label>';
            echo '<input type="number" name="credit_hours[' . $i . ']" min="1" required><br>';
            
            echo '<label>Grade obtained for Course ' . $i . ': </label>';
            echo '<input type="text" name="grade[' . $i . ']" pattern="[A-E][\+\-]?|F" title="Enter a valid grade (A, A+, A-, ..., E, F)" required><br><br>';
        }
        
        echo '<input type="submit" value="Calculate Maximum and Minimum CGPA/GPA">';
    }
    ?>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numCourses = $_POST["num_courses"];
    $maxGPA = 0;
    $minGPA = PHP_FLOAT_MAX;

    for ($i = 1; $i <= $numCourses; $i++) {
        $creditHours = $_POST["credit_hours"][$i];
        $grade = $_POST["grade"][$i];

        $creditPoints = getCreditPoints($grade);
        $gradePoints = $creditHours * $creditPoints;

        // Calculate Maximum GPA
        $maxGPA += 4.0;

        // Calculate Minimum GPA
        $minGPA = min($minGPA, $creditPoints);
    }

    $maxCGPA = $maxGPA / $numCourses;
    $minCGPA = $minGPA;

    echo '<h3>Results:</h3>';
    echo '<p>Maximum CGPA: ' . number_format($maxCGPA, 2) . '</p>';
    echo '<p>Minimum CGPA: ' . number_format($minCGPA, 2) . '</p>';
    echo '<p>Maximum GPA: ' . number_format($maxGPA, 2) . '</p>';
    echo '<p>Minimum GPA: ' . number_format($minGPA, 2) . '</p>';
}

function getCreditPoints($grade) {
    switch ($grade) {
        case 'A+':
            return 4.0;
        case 'A':
            return 4.0;
        case 'A-':
            return 3.94;
        case 'B+':
            return 3.62;
        case 'B':
            return 3.24;
        case 'B-':
            return 2.94;
        case 'C+':
            return 2.62;
        case 'C':
            return 2.24;
        case 'C-':
            return 1.90;
        case 'D':
            return 1.40;
        case 'E':
            return 0.0;
        case 'F':
            return 0.0;
        default:
            return 0.0; // for any invalid input
    }
}
?>

</body>
</html>
