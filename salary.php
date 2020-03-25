<?php include_once 'includes/components/header.php' ?>



<div class="container" id="container">
    </form>
    <div class="row">
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" id="date">
        </div>
        <div class="col-md-4">

            <select class='form-control' id='projectList' name='projectList' required>
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
    <br>
    <div id="displayListOfEmployee"></div>
    <div id="tesst"></div>

</div>

<?php include_once 'includes/components/footer.php' ?>

<script>
    $(document).on("change", "input:checkbox", function() {

        var apply = $(this).is(':checked') ? 1 : 0;

        if (apply === 1) {
            const empId = this.id;
            const date = $("#date").val();
            const projectList = $("#projectList").val();
            $.ajax({
                type: "POST",
                url: "includes/server.php",
                data: {
                    checkedBox: 1,
                    empId: empId,
                    date: date,
                    projectList: projectList,
                    checkboxValue: apply
                },
                success: function(response) {
                    $("#tesst").html(response);
                }
            });
        } else if (apply === 0) {
            const empId = this.id;
            const date = $("#date").val();
            const projectList = $("#projectList").val();
            $.ajax({
                type: "POST",
                url: "includes/server.php",
                data: {
                    checkedBox: 1,
                    empId: empId,
                    date: date,
                    projectList: projectList,
                    checkboxValue: apply
                },
                success: function(response) {
                    $("#tesst").html(response);
                }
            });
        }

    });

    $(document).on("change", "#date", function() {

        $("#projectList").val('');

    });
</script>