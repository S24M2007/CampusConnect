<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_name = trim($_POST["student_name"]);
    $email = trim($_POST["email"]);
    $category = trim($_POST["category"]);
    $priority = trim($_POST["priority"]);
    $problem_title = trim($_POST["problem_title"]);
    $description = trim($_POST["description"]);
    $solution = trim($_POST["solution"]);


    if (
        empty($student_name) ||
        empty($email) ||
        empty($category) ||
        empty($priority) ||
        empty($problem_title) ||
        empty($description)
    ) {

        die("Please fill all required fields.");

    }


    $sql = "INSERT INTO problems
    (student_name, email, category, priority,
    problem_title, description, solution)
    VALUES (?, ?, ?, ?, ?, ?, ?)";


    $stmt = mysqli_prepare($conn, $sql);


    if (!$stmt) {

        die("Database error: " . mysqli_error($conn));

    }


    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $student_name,
        $email,
        $category,
        $priority,
        $problem_title,
        $description,
        $solution
    );


    if (mysqli_stmt_execute($stmt)) {

?>

<!DOCTYPE html>

<html>

<head>

    <title>Problem Submitted</title>

    <link rel="stylesheet"
          href="style.css">

</head>


<body>

<div class="success-page">

    <div class="success-box">

        <div class="success-icon">
            ✓
        </div>

        <h1>
            Problem Submitted!
        </h1>

        <p>

            Thank you for helping us improve the campus.
            Your problem has been successfully recorded.

        </p>


        <div class="success-buttons">

            <a href="index.html">
                Back to Home
            </a>

            <a href="problems.php">
                View Problems
            </a>

        </div>

    </div>

</div>

</body>

</html>

<?php

    } else {

        echo "Error submitting problem: "
             . mysqli_stmt_error($stmt);

    }


    mysqli_stmt_close($stmt);

}


mysqli_close($conn);

?>