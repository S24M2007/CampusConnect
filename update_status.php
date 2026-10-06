<?php

include "db.php";

if (!isset($_GET["id"])) {
    header("Location: problems.php");
    exit();
}

$id = intval($_GET["id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST["status"];

    $sql = "UPDATE problems SET status = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            header("Location: problems.php");
            exit();

        } else {

            echo "Error updating status: "
                 . mysqli_stmt_error($stmt);
        }

    } else {

        echo "Database error: "
             . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Update Status</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>

<div class="update-page">

    <div class="update-box">

        <h1>
            Update Problem Status
        </h1>

        <p>
            Select the current progress of this problem.
        </p>

        <form method="POST">

            <select name="status" required>

                <option value="">
                    Select Status
                </option>

                <option value="Pending">
                    Pending
                </option>

                <option value="In Progress">
                    In Progress
                </option>

                <option value="Solved">
                    Solved
                </option>

            </select>

            <button type="submit">
                Update Status
            </button>

            <a href="problems.php">
                Cancel
            </a>

        </form>

    </div>

</div>

</body>

</html>