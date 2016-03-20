$(document).ready(function(){
  $("#find-button").click(function(){
    var number = $("input[name=number]").val();

    var phoneNumberPattern = /^\+?[\d\- ]+$/
    if (!phoneNumberPattern.test(number)) {
      $("#result").html("Supply a number");
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
          } else {
            $("#result").html("No operator found");
          }
        } else if (response.status == 'fail'){
          $("#result").html("Some error occured: "+response.message);
        }
      }
    });
    return false;
  });
});
