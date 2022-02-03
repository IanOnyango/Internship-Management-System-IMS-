$(document).ready(function(){
	var DOMAIN = "http://localhost/IMS";
	getAllStudents(1);
	getStudentLogBook(1);
	countNoOfStudents();

	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});

	function getAllUsers(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllUsers:1},
			success : function(data){
				var choose = "<option value=''>- Select -</option>";
				$("#userid").html(choose+data);
			}
		})
	}

	$("body").delegate("#chat-button","click",function(){
		var uid = $("#colid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateMessageStatus:1,userid:uid},
			success : function(data){
			}
		})
	})

	function getCollectorMessage(){
		var uid = $("#colid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getUserMessage:1,Uid:uid},
			success : function(data){
				$("#collectormessage").html(data);
			}
		})
	}

	//setInterval(getCollectorMessage, 1000);

	function countNoOfStudents(){
		var semail = $("#supervisoremail").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {supervisorCountNoOfStudents:1,sEmail:semail},
			success : function(data){
				$("#studentsno").html(data);
			}
		})
	}

/*get all students*/
	function getAllStudents(pn){
		var semail = $("#supervisoremail").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {supervisorGetAllStudents:1,sEmail:semail,pageno:pn},
			success : function(data){
				$("#supervisorfarmerstable").html(data);
			}
		})
		//alert(cid);
	}

    $("body").delegate("#sendmessage","click",function(){
		var sid = $("#colid").val();
		var rid = $("#userid").val();
		var msg = $("#txtUserMessage").val();
		if (rid == "") {
			alert("Select your chat partner");
		}
		if (msg == "") {
			alert("Enter your message");
		}
		if (rid != "" && msg != "") {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {sendMessage:1,senderid:sid,recipientid:rid,message:msg},
				success : function(data){
					if (data == "SEND") {
						getCollectorMessage();
						$("#txtUserMessage").val("");
					}else{
						alert("Error");
					}
				}
			})
		}
	})

	function successAlert(){
		$("#classalert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fa fa-success'></i> Success!</h5></center><center>The Record has been deleted successfully</center></div>");
	}

	function failAlert(){
		$("#classalert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fa fa-danger'></i> Fail!</h5></center><center>The Record is in use</center></div>");
	}

	$("body").delegate("#remove","click",function(){
		var sregno = $(this).attr("sregno");		
		if (confirm("Are you sure ? You want to delete this student..!")) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {deleteStudent:1,id:sregno},
				success : function(data){
					if (data == "DEPENDENT_RECORD") {
						failAlert();
					}else if(data == "RECORD_DELETED"){
						successAlert();
						getAllStudents(1);
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})

	$("body").delegate('.sparkline8-collapse-link','click',function() {
		var button = $(this).find('i');
		$(this).parent().find('.icon-t').toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
		$(this).parent().parent().parent().parent().find( ".sparkline8-graph" ).slideToggle( "slow" );
	});
	$(".sparkline8-collapse-close").on('click', function(){
		$( "div.sparkline8-list" ).fadeOut( 600 );
	});

	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});

	$("body").delegate("#viewstudent","click",function(){
		var sregno = $(this).attr("sregno");
		var table = "students";
		var sid = "regno";		
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getUserFullDetails:1,usertable:table,pk:sid,userid:sregno},
			success : function(data){
				console.log(data);
				$("#editstudent").modal("show");
				for (var i in data){
					$("#editStudentFirstName").val(data[i].firstname);
					$("#editStudentLastName").val(data[i].lastname);
					$("#editStudentRegno").val(data[i].regno);
					$("#editStudentPhoneno").val(data[i].phone);
					$("#editStudentEmailaddress").val(data[i].email);
				}
			}
		})
	})

	function checkRemarksStatus(){
		var sr = $(".supervisor-remarks-available").attr("sr");
		if (sr) {
			$(".supervisor-remarks-available").parent().find( ".sparkline8-graph" ).slideToggle( "slow" );
		}
	}

	$("body").delegate("#sremarksbtn","click",function(){
		var status = false;
		var weekid = $(this).attr("weekid");		
		var remarks = $(this).parent().parent().find("#txtsremarks");
		if (remarks.val() == "") {
			remarks.addClass("border-danger");
			status = false;
		}else{
			remarks.removeClass("border-danger");
			status = true;
		}

		if (status) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {updateLogbookWeekStatus:1,weekID:weekid,sremarks:remarks.val()},
				success : function(data){
					if (data == "UPDATED_SUCCESSFULLY") {
						getStudentLogBook(1);
					}else{
						alert("UNKOWN_ERROR");
					}
				}
			}) 
		}
		
	})

	$("body").delegate("#viewstudentlogbook","click",function(){
		var sregno = $(this).attr("sregno");		
		window.location.href = encodeURI(DOMAIN+"/supervisor/studentlogbook.php?studentregno="+sregno);
		getStudentLogBook(1);
	})

	function getStudentLogBook(pn){
		var sregno = $("#studentregno").val();
		var semail = $("#supervisoremail").val();
		//console.log(sregno);
		//alert(sregno);
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getStudentLogBookWeeks:1,studentRegno:sregno,pageno:pn},
			success : function(data){
				$("#logbook-entries").html(data);
				checkRemarksStatus();
			}
		}) 
	}

/*register new student*/
	$("#studentregisterform").on("submit",function(){
		var status = false;
		var sfname = $("#txtStudentFirstName");
		var slname = $("#txtStudentLastName");
		var sregno = $("#txtStudentRegno");
		var spno = $("#txtStudentPhoneno");
		var semail = $("#txtStudentEmailaddress");
		var spass1 = $("#txtPassword1");
		var spass2 = $("#txtPassword2");
		//var cterminal = $("#txtCollectorTerminal");
	
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(sfname.val() == ""){
			sfname.addClass("border-danger");
			$("#sf_error").html("<span class='text-danger'>Please Enter Firstname</span>");
			status = false;
		}else{
			sfname.removeClass("border-danger");
			$("#sf_error").html("");
			status = true;
		}
		if(slname.val() == ""){
			slname.addClass("border-danger");
			$("#sl_error").html("<span class='text-danger'>Please Enter Lastname</span>");
			status = false;
		}else{
			slname.removeClass("border-danger");
			$("#sl_error").html("");
			status = true;
		}
		if(sregno.val() == ""){
			sregno.addClass("border-danger");
			$("#sr_error").html("<span class='text-danger'>Please Enter Regstration Number</span>");
			status = false;
		}else{
			sregno.removeClass("border-danger");
			$("#sr_error").html("");
			status = true;
		}
		if(spno.val() == ""){
			spno.addClass("border-danger");
			$("#sp_error").html("<span class='text-danger'>Please Enter Phone Number</span>");
			status = false;
		}else{
			spno.removeClass("border-danger");
			$("#sp_error").html("");
			status = true;
		}
		if(!e_patt.test(semail.val())){
			semail.addClass("border-danger");
			$("#se_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
			status = false;
		}else{
			semail.removeClass("border-danger");
			$("#se_error").html("");
			status = true;
		}
		if(spass1.val() == "" || spass1.val().length < 9){
			spass1.addClass("border-danger");
			$("#sp1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			spass1.removeClass("border-danger");
			$("#sp1_error").html("");
			status = true;
		}
		if(spass2.val() == "" || spass2.val().length < 9){
			spass2.addClass("border-danger");
			$("#sp2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			spass2.removeClass("border-danger");
			$("#sp2_error").html("");
			status = true;
		}
		if ((spass1.val() == spass2.val()) && status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#studentregisterform").serialize(),
				success : function(data){
					if (data == "STUDENT_ALREADY_REGISTERED") {
						sregno.addClass("border-danger");
						$("#sr_error").html("<span class='text-danger'>A student with same registration number already exists</span>");
					}else if(data == "UNKOWN_ERROR"){
						alert("Something Wrong");
					}else if(data == "SUCCESSFULLY_REGISTERED"){
						$("#msg").html("<span class='text-success'>The Details have saved successfully</span>");
						setTimeout(function() {
						    hideFarmerModal();
						}, 5000);
						getAllStudents(1);
					}
				}
			})
		}else{
			spass2.addClass("border-danger");
			$("#sp2_error").html("<span class='text-danger'>Password is not matched</span>");
			status = true;
		}
	})

});