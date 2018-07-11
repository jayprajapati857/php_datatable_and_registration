<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Datatable UI</title>
	<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css' />
	<link rel='stylesheet' type='text/css' href='css/dataTables.bootstrap.min.css' />
	<link rel='stylesheet' type='text/css' href='css/responsive.bootstrap.min.css' />
    	
	<script src="js/jquery-3.3.1.js"></script>	
	<script type='text/javascript' src='js/jquery.dataTables.min.js'></script>
	<script type='text/javascript' src='js/dataTables.bootstrap.min.js'></script>
	<script type='text/javascript' src='js/dataTables.responsive.min.js'></script>
	<script type='text/javascript' src='js/responsive.bootstrap.min.js'></script>
    
	
	<script>
	$(document).ready(function () {
		$("#list_records").DataTable({
			"processing": true,
			"serverSide": true,
			"jQueryUI": true,
			"ordering": true,
			"searching": true,
			"responsive":true,
			"order": [[2, 'asc']],//set column 1 (time)
			"ajax": {
				url: "getUsers.php",
				type: 'POST',
				dataSrc: "data",
				error: function(){  // error handling
                    //$(".employee-grid-error").html("");
                    $("#list_records").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#list_records_processing").css("display","none"); 
                	}
				},		 
			"columns": [
				{ "title": "Profile Picture", "data":"profile_img_path", "orderable":false },
				{ "title": "User Name", "data":"profile_display_name" },
				{ "title": "First Name", "data":"first_name" },
				{ "title": "Last Name", "data":"last_name" },
				{ "title": "Address", "data":"user_address", "orderable":false},
				{ "title": "Email", "data":"user_email", "orderable":false },
				{ "title": "Phone Number", "data":"phone_number", "orderable":false },
				{ "title": "Blood Group", "data":"blood_group" },
				{ "title": "Available Time", "data":"available_time", "orderable":false },
				{ "title": "Type Of Service", "data":"type_of_service", "orderable":false }
			],
			"columnDefs": [
				{ "targets": 0,
				"render": function(data) {
					return '<a href=""><img src="profile_pictures/'+data+'" height="80px" width="80px"></a>'
				}
				}   
			]				
		}); 	
	});
	</script>
</head>

<body style="padding:25px !important; ">
<div class="row">
	<div class="col-xs-12">
		<table id="list_records" class="table table-striped table-bordered"></table> 
	</div>	
</div>
<div id="perpage"></div>
</body>
</html>
