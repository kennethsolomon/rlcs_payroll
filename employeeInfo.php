<?php include_once 'includes/components/header.php' ?>

<div class="container">

    <?php
    $project = $_GET['projects'];
    $empId = $_GET['empId'];

    $sql = "SELECT * FROM employee WHERE project = '$project' AND empId = '$empId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $lastName = $row['lastName'];
        $firstName = $row['firstName'];
        $middleName = $row['middleName'];
        $empId = $row['empId'];
        $rate = $row['rate'];
        $address = $row['address'];
        $project = $row['project'];
    }
    ?>

    <div class="card" id="cardInfo">
        <div class="card-header">
            <strong>Employee Info</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="lastName" placeholder="Last name" value="<?php echo $lastName ?>">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="firstName" placeholder="First name" value="<?php echo $firstName ?>">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="middleName" placeholder="Middle name" value="<?php echo $middleName ?>">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="address" placeholder="Address" value="<?php echo $address ?>">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="rate" placeholder="Rate" value="<?php echo $rate ?>">
                </div>
                <div class="col-md-4">
                    <select class='form-control' id='project' name='project' required>
                        <option><?php echo $project ?></option>
                        <?php
                        $queryProjects = "SELECT * FROM project";
                        $resultProjects = mysqli_query($conn, $queryProjects);
                        if (mysqli_num_rows($resultProjects) > 0) {
                            while ($row = mysqli_fetch_assoc($resultProjects)) {
                                $projects = $row['projects'];
                                echo "
                                <option value='$projects'>$projects</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <button class="btn btn-primary" type="button" id="updateEmployeeBtn">Update</button>
        </div>
    </div>

</div>

<?php include_once 'includes/components/footer.php' ?>