<?php include_once 'includes/components/header.php' ?>

<div class="container" id="container">

    <?php
    $project = $_GET['projects'];
    $empId = $_GET['empId'];

    $sql = "SELECT * FROM employee WHERE empId = '$empId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $lastName = $row['lastName'];
        $firstName = $row['firstName'];
        $middleName = $row['middleName'];
        $empId = $row['empId'];
        $rate = $row['rate'];
        $address = $row['address'];
        $eProject = $row['project'];
    }
    ?>

    <div class="card" id="cardInfo">
        <div class="card-header">
            <strong>Employee Info</strong>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <script>
                    window.setTimeout(function() {
                        $("#alert_message").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 3000);
                </script>
                <div id="alert_message" class="alert alert-success text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <form action="includes/server.php" method="post">
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="empId" class="form-control" id="empId" value="<?php echo $empId ?>">
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last name" value="<?php echo $lastName ?>">
                    </div>
                    <div class="col">
                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First name" value="<?php echo $firstName ?>">
                    </div>
                    <div class="col">
                        <input type="text" name="middleName" class="form-control" id="middleName" placeholder="Middle name" value="<?php echo $middleName ?>">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?php echo $address ?>">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="rate" class="form-control" id="rate" placeholder="Rate" value="<?php echo $rate ?>">
                    </div>
                    <div class="col-md-4">
                        <select class='form-control' id='project' name='project' required>
                            <option><?php echo $_GET['projects'] ?></option>
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
                <button type="submit" id="updateEmployeeBtn" name="updateEmployeeBtn" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <div id="display_area" class="mt-5"></div>
    <div class="row mt-3">

        <div class="col-md-6">
            <select class='form-control' id='month' name='month'>
                <option value=""></option>
                <option value="01">Janruary</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="year" class="form-control" id="year" placeholder="Year">
        </div>
        <div class="col-md-3">
            <button type="submit" id="addMonthAndYear" name="addMonthAndYear" class="btn btn-primary">Update</button>
        </div>
    </div>

    <table class=" border table mt-2">
        <thead>
            <tr>
                <th scope="col">Day</th>
                <th scope="col">Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
            </tr>
        </tbody>
    </table>


</div>

<?php
include_once 'includes/components/footer.php' ?>

<script>
    $(document).ready(function() {
        $(document).on("click", "#addMonthAndYear", function() {
            var month = $("#month").val();
            var year = $("#year").val();

            if (month == "" || year == "") {
                const emptyFields =
                    '<div id="alert_message" class="alert alert-danger text-center">' +
                    "You need to fill all the fields!" +
                    "</div>";
                window.setTimeout(function() {
                    $("#alert_message")
                        .fadeTo(500, 0)
                        .slideUp(500, function() {
                            $(this).remove();
                        });
                }, 3000);
                $("#display_area").append(emptyFields);
            } else {
                const updated =
                    '<div id="alert_message" class="alert alert-success text-center">' +
                    "You need to fill all the fields!" +
                    "</div>";
                window.setTimeout(function() {
                    $("#alert_message")
                        .fadeTo(500, 0)
                        .slideUp(500, function() {
                            $(this).remove();
                        });
                }, 3000);
                $("#display_area").append(updated);
                window.history.pushState('', '', 'employeeInfo.php?empId=<?php echo $_GET['empId'] ?>&projects=<?php echo $_GET['projects'] ?>&month=' + month + '&year=' + year);
            }

        });

    })
</script>