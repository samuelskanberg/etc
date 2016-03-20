$(document).ready(function(){
  $("#find-button").click(function(){
    var number = $("input[name=number]").val();

    var phoneNumberPattern = /^\+?[\d\- ]+$/
    if (!phoneNumberPattern.test(number)) {
      $("#result").html("Supply a number");
      $("#result").removeClass("success");
      $("#result").addClass("failed");
      return false;
    }

    var cleanNumber = number.replace(/-| |\+/gi, "");

    $.ajax({
      url: "api.php",
      type: "get",
      data:{
        number: cleanNumber
      },
      success: function(response) {
        if (response.status == 'success') {
          if (response.found) {
            $("#result").html("Best operator is "+response.operator);
            //$("#result").css("background-color", "lightgreen");
            $("#result").removeClass("failed");
            $("#result").addClass("success");
          } else {
            $("#result").html("No operator found");
            $("#result").removeClass("success");
            $("#result").addClass("failed");
          }
        } else if (response.status == 'fail'){
          $("#result").html("Some error occured: "+response.message);
          //$("#result").css("background-color", "red");
          $("#result").removeClass("success");
          $("#result").addClass("failed");

        }
      }
    });
    return false;
  });
});
