<?php
include_once 'includes/components/header.php';
require_once("includes/classes/Employee.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$employee = new Employee($con);

if (isset($_POST["addEmployee"])) {

    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $address = $_POST["address"];
    $project = $_POST["project"];
    $rate = $_POST["rate"];

    $wasSuccessful = $employee->addEmployee($lastName, $firstName, $middleName, $address, $project, $rate);

    if ($wasSuccessful) {
        header("Location: add.php");
    }
}

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <?php echo $employee->getSuccess(Constants::$employeeAddedSuccessfully); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo $employee->getError(Constants::$lastNameCharacters); ?>
                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" value="<?php getInputValue('lastName'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo $employee->getError(Constants::$firstNameCharacters); ?>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?php getInputValue('firstName'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" value="<?php getInputValue('middleName'); ?>" required>
                        </div>
                    </div>
                </div>
                <!-- End of Row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address" name="address" aria-describedby="address" placeholder="Address" value="<?php getInputValue('address'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" id="project" name="project" value="<?php getInputValue('project'); ?>" required>
                                <option><?php getInputValue('project'); ?></option>
                                <option>RLCS MAIN</option>
                                <option>GUINLAJON</option>
                                <option>SEABREEZE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" name="rate" id="rate" placeholder="Rate" value="<?php getInputValue('rate'); ?>" required>
                        </div>
                    </div>
                </div>
                <!-- End of Row -->
                <button type="submit" id="addEmployee" name="addEmployee" class="btn btn-primary">Add Employee</button>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include_once 'includes/components/footer.php' ?>