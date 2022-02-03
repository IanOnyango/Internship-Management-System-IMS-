$(document).ready(function(){
	var DOMAIN = "http://localhost/IMS";

	getAllLogBookWeeks(1);
	toggleUserSettingsDetails();
	toggleUserPasswordDetails();
	hideArrowClass();
	getStudentFullDetails();
	getStudentProgress();

	$(".img-profile").on("click",function(){
		openSideNav();
	})

	$("#closebtn").on("click",function(){
		closeNav();
	})

	$("#btn-fname").on("click", function(){

	})

	$("body").delegate("#slogbook","click",function(){
		var userid = $("#sid").val();		
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {generateStudentLogbook:1,studentRegno:userid},
			success : function(data){
				
			}
		})
	})

	$("#btn-change-password").on("click", function(){
			var status = false;
			var cpass1 = $("#input-password");
			var cpass2 = $("#input-confirm-password");
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
				var userid = $("#sid").val();
			    var userpassword = $("#input-password").val();
			    var table = "students";
			    var fieldname = "password";
			    var id = "regno";
			    $.ajax({
					url : DOMAIN+"/includes/action.php",
					method : "POST",
					data : {updateUserInfo:1,tablename:table,field_name:fieldname,field_value:userpassword,pk:id,pk_value:userid},
					success : function(data){
						if (data == "UPDATED") {
							$("#cp1_error").html("<span class='text-success'>Successfully Updated</span>").fadeOut(5000);
							cpass1.val("");
							cpass2.val("");
							getUserFullDetails();
						}else{
							alert("Unknown Error");
						}
					}
				})
			}else{
				cpass2.addClass("border-danger");
				$("#cp2_error").html("<span class='text-danger'>Password is not matched</span>");
				status = true;
			}
		})


	$("input[name=edit1]").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "firstname";
        var table = "students";
        var id = "regno";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("input[name=edit2]").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "lastname";
        var table = "students";
        var id = "regno";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("input[name=edit3]").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "phone";
        var table = "students";
        var id = "regno";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    $("input[name=edit4]").on("keyup input", function(){
        var inputVal = $(this).val();
        var fieldname = "email";
        var table = "students";
        var id = "regno";
        if(inputVal.length){
            updateUserInfo(table,fieldname,inputVal,id);
        } else{
            
        }
    });

    function getStudentProgress(){
    	var userid = $("#sid").val();
    	$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getStudentProgress:1,studentRegno:userid},
			success : function(data){
				$("#progress-weekly").html(data);
				getStudentDailyProgress();
			}
		})
    }

    function getStudentDailyProgress(){
    	var userid = $("#sid").val();
    	$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getStudentDailyProgress:1,studentRegno:userid},
			success : function(data){
				console.log(data);
				if (data != "") {
					var dataArray = [];
					//var content = "";
					var n = '<b style="color: #5e72e4;">Latest Task</b>';
					for(var i in data){
						if (data[i].role != "") {
							dataArray.push(data[i].task);
							//var newdata = data.slice(1)[0];
							//console.log(newdata);
							//console.log(data[i].role)
							//content += '<tr><td>' + n + '</td><td>' + data[i].role + '</td><td>' + data[i].task + '</td><td>' + data[i].date_added + '</td></tr>';
						}
						//n++;
					}
					//console.log(dataArray);
					if (dataArray != "") {
						var lastitem = dataArray.slice(-1)[0];
						console.log(lastitem);
						$("#daily-progress").html(n + " " + lastitem);
						updateWeeklyProgress(dataArray.length);
					}else{
						$("#daily-progress").html("No progress yet");
					}
					
					//content += '<tr><td>' + n + '</td><td>' + lastitem.role + '</td><td>' + lastitem.task + '</td><td>' + lastitem.date_added + '</td></tr>';
					
    				
    				
				}else{

				}
			}
		})
    }

    function updateWeeklyProgress(no){
    	var t = no / 5;

    	let options = {
	        startAngle: -1.55,
	        size: 150,
	        value: t,
	        fill: {gradient: ['#5e72e4', '#32325d']}
	      }
	  
	      $(".circle .bar").circleProgress(options).on('circle-animation-progress',
	      function(event, progress, stepValue){
	        $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
	      });
	      $(".js .bar").circleProgress({
	        value: t
	      });
    }

    function updateUserInfo(table,fieldname,inputVal,id){
    	var userid = $("#sid").val();
    	$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateUserInfo:1,tablename:table,field_name:fieldname,field_value:inputVal,pk:id,pk_value:userid},
			success : function(data){
				if (data == "UPDATED") {
					getUserFullDetails();
				}else{
					alert("Unknown Error");
				}
			}
		})
    }

	function openSideNav() {
        document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

   /* $("input[name=edit]").prop("disabled",true);*/

   $("input[name=edit]").on('focus',function(){
   		$(this).parent().parent().parent().parent().find('.arrow').show();
   })

    function hideArrowClass(){
    	$('.arrow').hide();
    }

    function toggleUserSettingsDetails(){
    	$('.chev-down').toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
		$( ".user-settings" ).slideToggle( "slow" );
    }

    function toggleUserPasswordDetails(){
    	$('.chev-down-password').toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
		$( ".user-settings-password" ).slideToggle( "slow" );
    }

    $("body").delegate('.chev-down','click',function() {
		toggleUserSettingsDetails();
	});

	$("body").delegate('.chev-down-password','click',function() {
		toggleUserPasswordDetails();
		hideArrowClass();
	});

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

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		getAllLogBookWeeks(pn);
	})

	function getStudentFullDetails(){
		var studentregno = $("#sid").val();
		var table = "students";
		var pkey = "regno";
		var day = "";
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getUserFullDetails:1,usertable:table,pk:pkey,userid:studentregno},
			success : function(data){
				if (data == "NO_DATA") {
					console.log("No Data");
				}else{
					console.log(data);
					var firstname = [];
					var lastname = [];
					for (var i in data) {
						var welcomeusername = '';
						var username = '';
						var datejoined = '';
						var idnumber = '';
						var userfirstname = data[i].firstname;
						$("#txtUfirstname").val(userfirstname);
						var userlastname = data[i].lastname;
						$("#txtUlastname").val(userlastname);
						day = (data[i].date_added) * 1000
						var d = new Date(parseInt(day, 10));
		            	var dat = d.toDateString();
						datejoined += 'You Joined on ' + dat;
						

						
						$("#txtUregno").val(data[i].regno);
						$("#txtUphone").val(data[i].phone);
						$("#txtUemail").val(data[i].email);
						$("#txtUdatejoined").val(datejoined);
						$(".account-info").html(userfirstname + " " + userlastname);
					}
					
				}
			}
		})

	}

	$("body").delegate("#savedaytask","click",function(){
		var status = false;
		var did = $(this).attr("dayid");
		var dayrole = $(this).parent().parent().find("#dayrole");
		var daytask = $(this).parent().parent().find("#daytask");
		if (dayrole.val() == "") {
			dayrole.addClass("border-danger");
			status = false;
		}else{
			dayrole.removeClass("border-danger");
			status = true;
		}

		if (daytask.val() == "") {
			daytask.addClass("border-danger");
			status = false;
		}else{
			daytask.removeClass("border-danger");
			status = true;
		}

		if (status) {
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {updateDayTask:1,DID:did,dayRole:dayrole.val(),dayTask:daytask.val()},
				success : function(data){
					if (data == "UPDATED_SUCCESSFULLY") {
						getAllLogBookWeeks(1);
					}else{
						alert("Unknown Error");
					}
				}
			})
		}
		
	})

	function getNewWeek(){
		var studentregno = $("#sid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getNewWeek:1,studentRegno:studentregno},
			success : function(data){
				if (data == "ADDED_SUCCESSFULLY") {
					getAllLogBookWeeks(1);
				}else{
					alert("Unknown Error");
				}
			}
		})
	}

	$("#addnewweek").on("click",function(){
		getNewWeek();
	})

	function checkRemarksStatus(){
		var sr = $(".supervisor-remarks-available").attr("sr");
		if (sr) {
			$(".supervisor-remarks-available").parent().find( ".sparkline8-graph" ).slideToggle( "slow" );
		}
	}

	function getAllLogBookWeeks(pn){
		var studentregno = $("#sid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getAllLogBookWeeks:1,studentRegno:studentregno,pageno:pn},
			success : function(data){
				$("#logbook-entries").html(data);
				checkRemarksStatus();
			}
		}) 
	}

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

	function showGraph(p){
		/*
		$("#sparkline51").sparkline([f, s], {
			 type: 'pie',
			 height: '70',
			 sliceColors: ['#1ab394', '#ebebeb']
		 });

		$("#timeout").html("<p>"+ s +"</p>");
		*/
		//$(".progress-bar").css("width", p + "%").text(p + " %");
	}

	function getFarmerMessage(){
		var uid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getUserMessage:1,Uid:uid},
			success : function(data){
				$("#farmermessage").html(data);
			}
		})
	}

	$("body").delegate("#chat-button","click",function(){
		var uid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateMessageStatus:1,userid:uid},
			success : function(data){
			}
		})
	})

	$("body").delegate("#sendmessage","click",function(){
		var sid = $("#fid").val();
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
						getFarmerMessage();
						$("#txtUserMessage").val("");
					}else{
						alert("Error");
					}
				}
			})
		}
	})

	function calcTimeout(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			dataType : "json",
			data : {calcTimeout:1,Uid:fid},
			success : function(data){
				//$("#clock").val(data["timeout_time"]);

				var f = 100;

				var s = (data["timeout_time"]);

				var p = (s / f)*100;

				showGraph(p);
				
			}
		})
	}

	function checkLoginTime(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {checkLoginTime:1,Uid:fid},
			success : function(data){
				if (data == "REQUEST") {
					requestPassword();
				}
			}
		})
	}

	function requestPassword(){
		$("#passwordModal").modal({
            backdrop: 'static',
            keyboard: false
        });
		$("#passwordModal").modal("show");
	}

	$("#passwordModal").on('shown.bs.modal', function(){
        $(this).find('#txtFarmerPassword').focus();
    });

	//setInterval(checkLoginTime, 1000);

	$("body").delegate("#txtFarmerPassword","keyup",function(event){
		event.preventDefault();

		var fid = $("#fid").val();

		var farmerPassword = $("#txtFarmerPassword");

		var farmerpasswordlength = $("#fpl").val();

		if (farmerPassword.val().length == farmerpasswordlength) {
			var fPassword = $("#txtFarmerPassword").val();
			$.ajax({
				url : DOMAIN+"/includes/action.php",
				method : "POST",
				data : {confirmPassword:1,Uid:fid,FarmerPassword:fPassword},
				success : function(data){
					if (data == "CONFIRMED") {
						$("#passwordModal").modal("hide");
					}else if (data == "CONFIRMED_FAILED"){
						window.location.href = encodeURI(DOMAIN+"/farmer/logout.php?farmerid="+fid+"");
					}else{
						alert("Error");
					}
				}
			})
		}	
						
	})

	function getAllNotification(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getNotification:1,Uid:fid},
			success : function(data){
				$("#fnotif").html(data);
			}
		})
	}

	//setInterval(getAllNotification, 1000);

	function getTotalNewNotification(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {countNewNotification:1,Uid:fid},
			success : function(data){
				$("#notifcount").html(data);
			}
		})
	}

	function manageNotification(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {manageNotification:1,Uid:fid},
			success : function(data){
				if (data == "DELETED") {
					getAllNotification();
					getTotalNewNotification();
				}
			}
		})
	}

	$("body").delegate("#alertsDropdown","click",function(){
		var fid = $("#fid").val();		
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {updateNotification:1,Uid:fid},
			success : function(data){
				if (data == "UPDATED") {
					getAllNotification();
					getTotalNewNotification();
				}else{
					alert("Unknown Error");
				}
			}
		})
	})

	$("body").delegate("#freport","click",function(){
		var fid = $("#fid").val();		
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {farmerReport:1,Uid:fid},
			success : function(data){
				
			}
		})
	})

	function getFarmerTotalMilkDetails(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getFarmerTotalMilkDetails:1,FarmerID:fid},
			success : function(data){
				$("#amount").html(data);
			}
		})
	}

	function getFarmerTotalMoneyDetails(){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {getFarmerTotalMoneyDetails:1,FarmerID:fid},
			success : function(data){
				$("#money").html(data);
			}
		})
	}

	function getMilkDetails(pn){
		var fid = $("#fid").val();
		$.ajax({
			url : DOMAIN+"/includes/action.php",
			method : "POST",
			data : {farmerGetMilkDetails:1,FID:fid,pageno:pn},
			success : function(data){
				$("#farmermilkdetailstable").html(data);
			}
		})
		//alert(fid);
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		getMilkDetails(pn);
	})

});