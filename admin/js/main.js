$(document).ready(function(){
	var DOMAIN = "http://localhost/IMS";
	//getFarmersNO();
	//getCollectorsNO();
	getAllStudents(1);
	getAllSupervisors(1);
	countNoOfStudents();
	countNoOfSupervisors();
	//getMilkLitresNO();
	//getTotalMoney();
	//getMilkDetails(1);

/*get no of students*/
	function countNoOfStudents(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {adminCountNoOfStudents:1},
			success : function(data){
				$("#studentsno").html(data);
			}
		})
	}

/*get no of supervisors*/
	function countNoOfSupervisors(){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {adminCountNoOfSupervisors:1},
			success : function(data){
				$("#supervisorsno").html(data);
			}
		})
	}

/*get all students*/
	function getAllStudents(pn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllStudents:1,pageno:pn},
			success : function(data){
				$("#studentstable").html(data);
			}
		})
	}

/*get all supervisors*/
	function getAllSupervisors(pn){
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllSupervisors:1,pageno:pn},
			success : function(data){
				$("#supervisorstable").html(data);
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		getAllSupervisors(pn);
	})

	function successAlert(){
		$("#classalert").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fa fa-success'></i> Success!</h5></center><center>The Record has been deleted successfully</center></div>");
	}

	function failAlert(){
		$("#classalert").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center><h5><i class='icon fa fa-danger'></i> Fail!</h5></center><center>The Record is in use</center></div>");
	}

	$("body").delegate("#removesupervisor","click",function(){
		var semail = $(this).attr("semail");		
		if (confirm("Are you sure ? You want to delete this..!")) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {deleteSupervisor:1,id:semail},
				success : function(data){
					if (data == "DEPENDENT_RECORD") {
						failAlert();
					}else if(data == "RECORD_DELETED"){
						getAllSupervisors(1);
						successAlert();
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})

	 var semail = "";
	$("body").delegate("#viewsupervisor","click",function(){
		semail = $(this).attr("semail");
		var table = "supervisors";
		var sid = "email";		
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getUserFullDetails:1,usertable:table,pk:sid,userid:semail},
			success : function(data){
				console.log(data);
				$("#editcollector").modal("show");
				for (var i in data){
					$("#editSupervisorFirstName").val(data[i].firstname);
					$("#editSupervisorLastName").val(data[i].lastname);
					$("#editSupervisorEmailaddress").val(data[i].email);
					$("#editSupervisorPhoneno").val(data[i].phone);
				}
			}
		})
	})

	$("#editSupervisorFirstName").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "firstname";
        var table = "supervisors";
        var id = "email";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("#editSupervisorLastName").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "firstname";
        var table = "supervisors";
        var id = "email";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("#editSupervisorEmailaddress").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "firstname";
        var table = "supervisors";
        var id = "email";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("#editSupervisorPhoneno").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "firstname";
        var table = "supervisors";
        var id = "email";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    function updateUserInfo(table,fieldname,inputVal,id){
    	$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateUserInfo:1,tablename:table,field_name:fieldname,field_value:inputVal,pk:id,pk_value:semail},
			success : function(data){
				if (data == "UPDATED") {
					getAllSupervisors(1);
				}else{
					alert("Unknown Error");
				}
			}
		})
    }


/*register new supervisor*/
	$("#supervisorregisterform").on("submit",function(){
		var status = false;
		var sfname = $("#txtSupervisorFirstName");
		var slname = $("#txtSupervisorLastName");
		var spno = $("#txtSupervisorPhoneno");
		var semail = $("#txtSupervisorEmailaddress");
		var cpass1 = $("#txtPassword1");
		var cpass2 = $("#txtPassword2");
		var cterminal = $("#txtCollectorTerminal");
	
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
		if(cpass1.val() == "" || cpass1.val().length < 9){
			cpass1.addClass("border-danger");
			$("#cp1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			cpass1.removeClass("border-danger");
			$("#cp1_error").html("");
			status = true;
		}
		if(cpass2.val() == "" || cpass2.val().length < 9){
			cpass2.addClass("border-danger");
			$("#cp2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status = false;
		}else{
			cpass2.removeClass("border-danger");
			$("#cp2_error").html("");
			status = true;
		}
		if ((cpass1.val() == cpass2.val()) && status == true) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : $("#supervisorregisterform").serialize(),
				success : function(data){
					if (data == "SUPERVISOR_ALREADY_REGISTERED") {
						semail.addClass("border-danger");
						$("#se_error").html("<span class='text-danger'>A Collector with same Email Address already exists</span>");
					}else if(data == "UNKOWN_ERROR"){
						alert("Something Wrong");
					}else if(data == "SUCCESSFULLY_REGISTERED"){
						$("#notif").html("<span class='text-success'>The Details have saved successfully</span>");
						//getAllCollectors();
						setTimeout(function() {
						    location.reload();
						}, 5000);
					}
				}
			})
		}else{
			cpass2.addClass("border-danger");
			$("#cp2_error").html("<span class='text-danger'>Password is not matched</span>");
			status = true;
		}
	})

});