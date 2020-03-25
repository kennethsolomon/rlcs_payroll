<?php
include_once 'config.php';

//Search Patient
if (isset($_POST['searchText'])) {
    $inpText = $_POST['searchText'];
    $query = "SELECT * FROM patient WHERE lastName LIKE '%$inpText%' OR firstName LIKE '%$inpText%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo ' <a href="searchList.php?uId=' . $row['uId'] . '" id="searchList" class="list-group-item list-group-item-action border-1">' . $row['lastName'] .  ', ' . $row['firstName'] . ' ' . $row['middleName'] . '</a>';
        }
    } else {
        echo ' <a href="#" class="list-group-item list-group-item-action border-1">No Result</a>';
    }
}

//Add Employee
if (isset($_POST['addEmployee'])) {

    $empId = $_POST['empId'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $address = $_POST['address'];
    $project = $_POST['project'];
    $rate = $_POST['rate'];

    $queryAlreadyExist = "SELECT * FROM employee WHERE lastName='$lastName' AND firstName='$firstName' AND middleName='$middleName'";
    $resultAlreadyExist = mysqli_query($conn, $queryAlreadyExist);

    if (mysqli_num_rows($resultAlreadyExist) > 0) {
        $alreadyExist = '
        <script>
        window.setTimeout(function() {
            $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            });
          }, 3000);
        </script>
        <div id="alert_message" class="alert alert-danger text-center">
          Employee Already Exist!
        </div>
        ';
        echo $alreadyExist;
    } else {
        $sql = "INSERT INTO employee (empId, lastName, firstName, middleName, address, project, rate) 
              VALUES ('$empId', '$lastName', '$firstName', '$middleName', '$address', '$project', '$rate')";
        if (mysqli_query($conn, $sql)) {
            $insertSuccessful = '
            <script>
            window.setTimeout(function() {
                $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
                });
            }, 3000);
            </script>
            <div id="alert_message" class="alert alert-success text-center">
            Employee Added Successfuly!
            </div>
            ';
            echo $insertSuccessful;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        exit();
    }
}


// // delete comment fromd database
// if (isset($_GET['delete'])) {
//     $id = $_GET['id'];
//     $sql = "DELETE FROM comments WHERE id=" . $id;
//     mysqli_query($conn, $sql);
//     exit();
// }
// if (isset($_POST['update'])) {
//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $comment = $_POST['comment'];
//     $sql = "UPDATE comments SET name='{$name}', comment='{$comment}' WHERE id=" . $id;
//     if (mysqli_query($conn, $sql)) {
//         $id = mysqli_insert_id($conn);
//         $saved_comment = '<div class="comment_box">
//   		  <span class="delete" data-id="' . $id . '" >delete</span>
//   		  <span class="edit" data-id="' . $id . '">edit</span>
//   		  <div class="display_name">' . $name . '</div>
//   		  <div class="comment_text">' . $comment . '</div>
//   	  </div>';
//         echo $saved_comment;
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
//     exit();
// }

// // Retrieve comments from database
// $sql = "SELECT * FROM comments";
// $result = mysqli_query($conn, $sql);
// $comments = '<div id="display_area">';
// while ($row = mysqli_fetch_array($result)) {
//     $comments .= '<div class="comment_box">
//   		  <span class="delete" data-id="' . $row['id'] . '" >delete</span>
//   		  <span class="edit" data-id="' . $row['id'] . '">edit</span>
//   		  <div class="display_name">' . $row['name'] . '</div>
//   		  <div class="comment_text">' . $row['comment'] . '</div>
//   	  </div>';
// }
// $comments .= '</div>';

if (isset($_POST['updateEmployeeBtn'])) {
    $empId = $_POST['empId'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $address = $_POST['address'];
    $project = $_POST['project'];
    $rate = $_POST['rate'];

    $sql = "UPDATE employee SET 
      lastName='{$lastName}', 
      firstName='{$firstName}', 
      middleName='{$middleName}',
      address='{$address}',
      project='{$project}',
      rate='{$rate}'
      WHERE empId='{$empId}'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Employee Update Successfully!';
        $url = "../employeeInfo.php?empId=$empId&projects=$project";
        $url = str_replace(PHP_EOL, '', $url);
        header("Location: $url");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}

if (isset($_POST['getProjectList'])) {

    $date = $_POST['date'];
    $projectList = $_POST['projectList'];
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $comments = '
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Attendance</th>
                </tr>
            </thead>';
        while ($row = mysqli_fetch_array($result)) {
            $lastName = $row['lastName'];
            $firstName = $row['firstName'];
            $middleName = $row['middleName'];
            $address = $row['address'];
            $empId = $row['empId'];
            $comments .= '
                <tbody >
                    <tr class="trID">
                        <th scope="row">' . $lastName . ',' . $firstName . ' ' . $middleName . '</th>
                        <th scope="row" class="eAddress">' . $address . '</th>';

            $sql2 = "SELECT * FROM salary where empId = '$empId'";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                $comments .= '<th scope="row"><input type="checkbox" class="form-control" id="' . $empId . '" checked></th>';
            } else {
                $comments .= '<th scope="row"><input type="checkbox" class="form-control" id="' . $empId . '"></th>';
            }

            $comments .= '  </tr></tbody>';
        }
        $comments .= '</table> ';

        echo $comments;
    } else {
        echo 'No Result';
    }
}

if (isset($_POST['checkedBox'])) {
    $date = $_POST['date'];
    $projectList = $_POST['projectList'];
    $empId = $_POST['empId'];
    $checkboxValue = $_POST['checkboxValue'];

    $sql2 = "SELECT * FROM employee JOIN salary ON employee.empId =  salary.empId";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_array($result2)) {
            $rate = $row2['rate'];
            $totalDaysWork = $row2['totalDaysWork'];
        }
        if ($checkboxValue == 1) {
            $sql = "INSERT INTO salary (empId, date, rate, totalDaysWork) 
                VALUES ('$empId', '$date', '$rate', '$totalDaysWork')";
            if (mysqli_query($conn, $sql)) {
                $insertSuccessful = '
              <script>
              window.setTimeout(function() {
                  $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove(); 
                  });
              }, 3000);
              </script>
              <div id="alert_message" class="alert alert-success text-center">
              Salary Added Successfuly!
              </div>
              ';
                echo $insertSuccessful;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            exit();
        } else if ($checkboxValue == 0) {
            $sql = "DELETE FROM salary WHERE empId='$empId'";
            if (mysqli_query($conn, $sql)) {
                $deletedSuccessfuly = '
                <script>
                window.setTimeout(function() {
                    $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                    });
                }, 3000);
                </script>
                <div id="alert_message" class="alert alert-danger text-center">
                Salary Deleted Successfuly!
                </div>
                ';
                echo $deletedSuccessfuly;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            exit();
        }
    } else {
        $sql3 = "SELECT * FROM employee WHERE empId = '$empId'";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_array($result3)) {
            $rate = $row3['rate'];
        }
        if ($checkboxValue == 1) {
            $sql = "INSERT INTO salary (empId, date, rate, totalDaysWork) 
            VALUES ('$empId', '$date', '$rate', 1)";
            if (mysqli_query($conn, $sql)) {
                $insertSuccessful = '
          <script>
          window.setTimeout(function() {
              $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
              });
          }, 3000);
          </script>
          <div id="alert_message" class="alert alert-success text-center">
          Employee Added Successfuly!
          </div>
          ';
                echo $insertSuccessful;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            exit();
        }
    }
}
