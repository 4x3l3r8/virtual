function SubmitFormData() {
	var course = $("#course").val();
	var message = $("#message").val();
	
	
	$.post("chatsend.php", { course: course, message: message},
	   function(data) {
		 $('#results').html(data);
		 $('#myForm')[0].reset();
	   });
}

