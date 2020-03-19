<?php include_once 'includes/components/header.php' ?>

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>

                <th scope="col">Projects</th>
                <th scope="col">View</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM project";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $projects = $row['projects'];
                echo "
                <tr>
                    <th scope='row'>$projects</th>
                    <th class='center' scope='row'>
                    <a href='employee.php?projects=$projects'><i class='fas fa-eye' style='font-size:23'></i></a>
                    </th>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include_once 'includes/components/footer.php' ?>