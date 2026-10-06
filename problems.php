<?php

include "db.php";

$sql = "SELECT * FROM problems ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Campus Problems</title>

    <link rel="stylesheet"
          href="style.css">

</head>


<body>


<nav>

    <div class="logo">
        CampusConnect
    </div>

    <div class="nav-links">

        <a href="index.html">
            Home
        </a>

        <a href="index.html#report">
            Report Problem
        </a>

        <a href="problems.php">
            View Problems
        </a>

    </div>

</nav>



<section class="problems-page">


    <div class="page-heading">

        <p class="small-title">
            COMMUNITY BOARD
        </p>

        <h1>
            Campus Problems
        </h1>

        <p>

            Explore problems submitted by students
            and track their progress.

        </p>

    </div>



    <div class="problem-grid">


        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>


        <div class="problem-card">


            <div class="card-top">

                <span class="category">

                    <?php

                    echo htmlspecialchars(
                        $row["category"]
                    );

                    ?>

                </span>


                <span class="priority
                    <?php

                    echo strtolower(
                        $row["priority"]
                    );

                    ?>">

                    <?php

                    echo htmlspecialchars(
                        $row["priority"]
                    );

                    ?>

                </span>

            </div>



            <h2>

                <?php

                echo htmlspecialchars(
                    $row["problem_title"]
                );

                ?>

            </h2>



            <p class="description">

                <?php

                echo nl2br(
                    htmlspecialchars(
                        $row["description"]
                    )
                );

                ?>

            </p>



            <?php

            if (!empty($row["solution"])) {

            ?>

            <div class="solution">

                <strong>
                    Suggested Solution
                </strong>

                <p>

                    <?php

                    echo nl2br(
                        htmlspecialchars(
                            $row["solution"]
                        )
                    );

                    ?>

                </p>

            </div>

            <?php

            }

            ?>



            <div class="card-bottom">

                <div>

                    <strong>

                        <?php

                        echo htmlspecialchars(
                            $row["student_name"]
                        );

                        ?>

                    </strong>


                    <small>

                        <?php

                        echo date(
                            "d M Y",
                            strtotime(
                                $row["created_at"]
                            )
                        );

                        ?>

                    </small>

                </div>


                <span class="status">

                    <?php

                    echo htmlspecialchars(
                        $row["status"]
                    );

                    ?>

                </span>

            </div>



            <div class="admin-buttons">

                <a
                    href="update_status.php?id=<?php echo $row['id']; ?>"
                    class="edit-button">

                    Update Status

                </a>


                <a
                    href="delete.php?id=<?php echo $row['id']; ?>"
                    class="delete-button"
                    onclick="return confirm('Are you sure you want to delete this problem?');">

                    Delete

                </a>

            </div>


        </div>


        <?php

            }

        } else {

        ?>


        <div class="no-data">

            <h2>
                No Problems Yet
            </h2>

            <p>
                Be the first student to share a campus problem.
            </p>

            <a href="index.html#report">
                Report a Problem
            </a>

        </div>


        <?php

        }

        ?>


    </div>

</section>


</body>

</html>

<?php

mysqli_close($conn);

?>