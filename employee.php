<?php include_once 'includes/components/header.php' ?>

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>

                <th scope="col">Employee</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $project = $_GET['projects'];

            $sql = "SELECT * FROM employee WHERE project = '$project'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $lastName = $row['lastName'];
                $firstName = $row['firstName'];
                $middleName = $row['middleName'];
                $empId = $row['empId'];
                echo "
                <tr>
                    <th scope='row'>$lastName, $firstName $middleName</th>
                    <th class='center' scope='row'>
                    <a href='employeeInfo.php?empId=$empId&projects=$project'><i class='fas fa-eye' style='font-size:23'></i></a>
                    </th>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include_once 'includes/components/footer.php' ?>