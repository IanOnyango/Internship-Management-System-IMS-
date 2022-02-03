$(document).ready(function(){

	var DOMAIN = "http://localhost/IMS";

	/*===Student Login===*/

	$("#student-form").on("submit",function(){
		var studentid = $("#student_id");
		var studentpass = $("#student_password");
		var status = false;
		if (studentid.val() == "") {
			studentid.addClass("border-danger");
			$("#student_id_error").html("<span class='text-danger'>Please Enter Registration NO</span>");
			status = false;
		}else{
			studentid.removeClass("border-danger");
			$("#student_id_error").html("");
			status = true;
		}
		if (studentpass.val() == "") {
			studentpass.addClass("border-danger");
			$("#student_password_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			studentpass.removeClass("border-danger");
			$("#student_password_error").html("");
			status = true;
		}
		if (status) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#student-form").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						//$(".overlay").hide();
						studentid.addClass("border-danger");
						$("#student_id_error").html("<span class='text-danger'>Your are not yet Registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						//$(".overlay").hide();
						studentpass.addClass("border-danger");
						$("#student_password_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else if(data == "LOGGED_IN"){
						window.location.href = DOMAIN+"/student/index.php";
					}
				}
			})
		}
	});

	/*===Supervisor Login===*/

	$("#supervisor-form").on("submit",function(){
		var supervisoremail = $("#supervisor_email");
		var supervisorpass = $("#supervisor_password");
		var status = false;
		if (supervisoremail.val() == "") {
			supervisoremail.addClass("border-danger");
			$("#supervisor_email_error").html("<span class='text-danger'>Please Enter your email</span>");
			status = false;
		}else{
			supervisoremail.removeClass("border-danger");
			$("#supervisor_email_error").html("");
			status = true;
		}
		if (supervisorpass.val() == "") {
			supervisorpass.addClass("border-danger");
			$("#supervisor_password_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			supervisorpass.removeClass("border-danger");
			$("#supervisor_password_error").html("");
			status = true;
		}
		if (status) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#supervisor-form").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						//$(".overlay").hide();
						supervisoremail.addClass("border-danger");
						$("#supervisor_email_error").html("<span class='text-danger'>Your are not yet Registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						//$(".overlay").hide();
						supervisorpass.addClass("border-danger");
						$("#supervisor_password_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else if(data == "LOGGED_IN"){
						window.location.href = DOMAIN+"/supervisor/index.php";
					}
				}
			})
		}
	});

	/*===Admin Login===*/

	$("#admin-form").on("submit",function(){
		var adminemail = $("#admin_email");
		var adminpass = $("#admin_password");
		var status = false;
		if (adminemail.val() == "") {
			adminemail.addClass("border-danger");
			$("#admin_email_error").html("<span class='text-danger'>Please Enter your email</span>");
			status = false;
		}else{
			adminemail.removeClass("border-danger");
			$("#admin_email_error").html("");
			status = true;
		}
		if (adminpass.val() == "") {
			adminpass.addClass("border-danger");
			$("#admin_password_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			adminpass.removeClass("border-danger");
			$("#admin_password_error").html("");
			status = true;
		}
		if (status) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#admin-form").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
						//$(".overlay").hide();
						adminemail.addClass("border-danger");
						$("#admin_email_error").html("<span class='text-danger'>Your are not yet Registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						//$(".overlay").hide();
						adminpass.addClass("border-danger");
						$("#admin_password_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else if(data == "LOGGED_IN"){
						window.location.href = DOMAIN+"/admin/index.php";
					}
				}
			})
		}
	});

});