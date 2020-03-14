$(document).ready(function() {
  // search patient from database
  $("#search").keyup(function() {
    const searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "server.php",
        method: "POST",
        data: {
          searchText: searchText
        },
        success: function(response) {
          $("#show-list").html(response);
        }
      });
    } else {
      $("#show-list").html("");
    }
  });
  // $(document).on("click", "#searchList", function () {
  //   $("#search").val($(this).text());
  //   $("#show-list").html("");
  // });

  // save comment to database
  $(document).on("click", "#addEmployee", function() {
    const generateEmpId =
      Date.now().toString(36) +
      Math.random()
        .toString(36)
        .substr(2);

    var empId = generateEmpId;
    var lastName = $("#lastName").val();
    var firstName = $("#firstName").val();
    var middleName = $("#middleName").val();
    var address = $("#address").val();
    var project = $("#project").val();
    var rate = $("#rate").val();

    if (lastName == "" || firstName == "" || middleName == "") {
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
      $.ajax({
        url: "includes/server.php",
        type: "POST",
        data: {
          save: 1,
          empId: empId,
          lastName: lastName,
          firstName: firstName,
          middleName: middleName,
          address: address,
          project: project,
          rate: rate
        },
        success: function(response) {
          $("#lastName").val("");
          $("#firstName").val("");
          $("#middleName").val("");
          $("#address").val("");
          $("#project").val("");
          $("#rate").val("");

          $("#display_area").append(response);
        }
      });
    }
  });

  // delete from database
  $(document).on("click", ".delete", function() {
    var id = $(this).data("id");
    $clicked_btn = $(this);
    $.ajax({
      url: "server.php",
      type: "GET",
      data: {
        delete: 1,
        id: id
      },
      success: function(response) {
        // remove the deleted comment
        $clicked_btn.parent().remove();
        $("#name").val("");
        $("#comment").val("");
      }
    });
  });
  var edit_id;
  var $edit_comment;
  $(document).on("click", ".edit", function() {
    edit_id = $(this).data("id");
    $edit_comment = $(this).parent();
    // grab the comment to be editted
    var name = $(this)
      .siblings(".display_name")
      .text();
    var comment = $(this)
      .siblings(".comment_text")
      .text();
    // place comment in form
    $("#name").val(name);
    $("#comment").val(comment);
    $("#submit_btn").hide();
    $("#update_btn").show();
  });
});
