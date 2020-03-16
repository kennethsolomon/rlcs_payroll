<?php
include_once 'includes/components/header.php';
?>
<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>

            <div id="display_area"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" required>
                    </div>
                </div>
            </div>
            <!-- End of Row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address" aria-describedby="address" placeholder="Address" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class='form-control' id='project' name='project' required>
                            <option></option>
                            <?php
                            $queryProjects = "SELECT * FROM project";
                            $resultProjects = mysqli_query($conn, $queryProjects);

                            if (mysqli_num_rows($resultProjects) > 0) {
                                while ($row = mysqli_fetch_assoc($resultProjects)) {
                                    $projects = $row['projects'];
                                    echo "
                                    <option value='$projects'>$projects</option>
                                    
                                    ";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" min="0" class="form-control" name="rate" id="rate" placeholder="Rate" required>
                    </div>
                </div>
            </div>
            <!-- End of Row -->
            <button type="button" id="addEmployee" name="addEmployee" class="btn btn-primary">Add Employee</button>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include_once 'includes/components/footer.php' ?>