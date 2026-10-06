<?php

include "db.php";


if (isset($_GET["id"])) {

    $id = intval($_GET["id"]);


    $sql = "DELETE FROM problems
            WHERE id = ?";


    $stmt = mysqli_prepare(
        $conn,
        $sql
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );


    mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);

}


mysqli_close($conn);


header("Location: problems.php");

exit();

?>