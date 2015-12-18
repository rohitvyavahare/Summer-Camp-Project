$(document).ready(function()  {
        $('#submit_button').on('click', function() {
            processUpload();
            }
        );});

    function processUpload() {
        send_file();    // picture upload takes longer, get it going
     //   check_dup();
    }

    function send_file() {
        var form_data = new FormData($('#signUpForm')[0]);
        form_data.append("image", document.getElementById("fileInput").files[0]);
        $.ajax( {
            url: "upload_file.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
               $('#status').html(response);
               check_dup();
            },
            error: function(response) {
               $('#status').css('color','red');
               $('#status').html("Sorry, an upload error occurred, "+response.statusText);
            }
        });
    }

	function check_dup() {

	   $('#busy_wait').css('visibility','visible');

	    var form_data = new FormData($('form')[0]);
        form_data.append("image", document.getElementById("fileInput").files[0]);
        $.ajax( {
            url: "check_dup.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
	       console.log(response);
               $('#busy_wait').css('visibility','hidden');
		       if(response.indexOf("DUP") > -1)
			   {
			       $('#status').text("This record appears to be a duplicate.");
			   }
		       else if(response.indexOf("OK") > -1) {
			        $('#signUpForm').serialize();
                                $('#signUpForm').submit();
                       }
            },
            error: function(response) {
               $('#status').css('color','red');
               $('#status').html("Sorry, an upload error occurred, "+response.statusText);
            }
        });


	}

	function handleData(response){
		console.log(response);
		$('#busy_wait').css('visibility','hidden');
		if(response.startsWith("DUP"))
			$('#status').text("This record appears to be a duplicate.");
		else if(response.startsWith("OK")) {
			$('#status').text("This record is OK, not a duplicate.");
        }
    }
