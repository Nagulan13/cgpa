<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numCourses = $_POST["numCourses"];
    
    $totalCreditHours = 0;
    $totalGradePoints = 0;

    for ($i = 1; $i <= $numCourses; $i++) {
        $creditHours = $_POST["creditHours{$i}"];
        $grade = strtoupper($_POST["grade{$i}"]);

        $gradePoints = getGradePoints($grade);

        $totalCreditHours += $creditHours;
        $totalGradePoints += ($creditHours * $gradePoints);
    }

    $cgpa = ($totalGradePoints / $totalCreditHours);
    $gpa = getGrade($cgpa);

    echo "<h3>CGPA: " . number_format($cgpa, 2) . "</h3>";
    echo "<h3>GPA: " . $gpa . "</h3>";
}

function getGradePoints($grade) {
    // Define your grade points mapping
    $gradePointsMap = [
        'A+' => 4.3,
        'A' => 4.0,
        'A-' => 3.7,
        'B+' => 3.3,
        'B' => 3.0,
        'B-' => 2.7,
        'C+' => 2.3,
        'C' => 2.0,
        'C-' => 1.7,
        'D+' => 1.3,
        'D' => 1.0,
        'D-' => 0.7,
        'F' => 0.0,
    ];

    return isset($gradePointsMap[$grade]) ? $gradePointsMap[$grade] : 0.0;
}

function getGrade($cgpa) {
    // Define your grade ranges
    $gradeRanges = [
        'A+' => 4.0,
        'A' => 3.75,
        'A-' => 3.5,
        'B+' => 3.25,
        'B' => 3.0,
        'B-' => 2.75,
        'C+' => 2.5,
        'C' => 2.25,
        'C-' => 2.0,
        'D+' => 1.75,
        'D' => 1.5,
        'D-' => 1.25,
        'F' => 0.0,
    ];

    foreach ($gradeRanges as $grade => $value) {
        if ($cgpa >= $value) {
            return $grade;
        }
    }

    return 'F'; // Default if none of the ranges match
}
?>
