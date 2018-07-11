<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Users</title>
	<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css' />
	<link rel='stylesheet' type='text/css' href='css/dataTables.bootstrap.min.css' />
	<link rel='stylesheet' type='text/css' href='css/responsive.bootstrap.min.css' />
	<link rel='stylesheet' type='text/css' href='css/jatin_foundation.css' />
    	
	<script src="js/jquery-3.3.1.js"></script>	
	<script type='text/javascript' src='js/jquery.dataTables.min.js'></script>
	<script type='text/javascript' src='js/dataTables.bootstrap.min.js'></script>
	<script type='text/javascript' src='js/dataTables.responsive.min.js'></script>
	<script type='text/javascript' src='js/responsive.bootstrap.min.js'></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
	
	<script>
	$(document).ready(function () {
	var isSearched = false;
	var oTable = $("#list_records").DataTable({
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
				{ "title": "Address", "data":"user_address", "orderable":false },
				{ "title": "Email", "data":"user_email" , "orderable":false},
				{ "title": "Phone Number", "data":"phone_number", "orderable":false , "render": function ( data, type, full, meta ) {
      return '<a href="tel:'+data+'">'+data+'</a>';
    } },
				{ "title": "Blood Group", "data":"blood_group" },
				{ "title": "Available Time", "data":"available_time"},
				{ "title": "Type Of Service", "data":"type_of_service", "orderable":false }
			],
			"columnDefs": [
				{ "targets": 0,
				"render": function(data) {
					if(data == ""){
						data = "./content/images/default-profile-pic.png";
					}
					return '<a href=""><img class="img-circle img-user center" src="'+data+'" onerror="this.src = \'./content/images/default-profile-pic.png\'"></a>'
				}
				}   
			]				
		});
		$('#list_records_filter input').unbind();
        $('#list_records_filter input').bind('keyup', function(e) {
			if(e.keyCode == 8 && this.value.length == 0 && isSearched){
				oTable.search("").draw();
				isSearched = false;
			}
            if(e.keyCode == 13) {
				isSearched = true;
                oTable.search(this.value).draw();
            }
        }); 	
	});
	</script>
</head>

<body style="padding:25px !important; ">
<div class="row">
	<div class="col-xs-12">
		<table id="list_records" class="table table-striped table-bordered text-center"></table> 
	</div>	
</div>
<div id="perpage"></div>
</body>
</html>
