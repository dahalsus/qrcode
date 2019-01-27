function post()
{
  var comment = document.getElementById("message").value;
  var name = document.getElementById("name").value;
  if(comment && name)
  {
    $.ajax
    ({
      type: 'post',
      url: 'post_comments.php',
      data: 
      {
         user_comm:comment,
	       user_name:name
      },
        cache: false,
      success: function (response) {
	     document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	     document.getElementById("comment").value="";
        document.getElementById("username").value="";
  
      },
        error: function() {
          // Fail message
          $('#success').html("<div class='alert alert-danger'>");
          $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success > .alert-danger').append($("<strong>").text("Sorry " + name + ", there seems to be a problem with the feedback system. Please try again later!"));
          $('#success > .alert-danger').append('</div>');
          //clear all fields
          $('#contactForm').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
          }, 1000);
        }
    });
  }
  
  return false;
}