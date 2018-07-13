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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
	    crossorigin="anonymous">


	<script type="text/javascript">
		$(document).ready(function () {
			var isSearched = false;
			var oTable = $("#list_records").DataTable({
				"processing": true,
				"serverSide": true,
				"jQueryUI": true,
				"ordering": true,
				"searching": true,
				"responsive": true,
				"order": [
					[2, 'asc']
				], //set column 1 (time)
				"ajax": {
					url: "getUsers.php",
					type: 'POST',
					dataSrc: "data",
					error: function () { // error handling                    
						$("#list_records").append(
							'<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
						$("#list_records_processing").css("display", "none");
					}
				},
				"columns": [{
						"title": "Profile Picture",
						"data": "profile_img_path",
						"orderable": false
					},
					{
						"title": "User Name",
						"data": "profile_display_name"
					},
					{
						"title": "First Name",
						"data": "first_name"
					},
					{
						"title": "Last Name",
						"data": "last_name"
					},
					{
						"title": "Address",
						"data": "user_address",
						"orderable": false
					},
					{
						"title": "Email",
						"data": "user_email",
						"orderable": false,
						"render":function(data,type,full,meta){
							return '<label id="'+ full.user_email +'" style="font-weight:  200;">'+data +'</label> <i class="fa fa-copy" id="copy_button_icon" title="Copy" style="margin:15px;color:#337ab7" onclick="copyToClipboard(' + "\'" + full.user_email + "\'" + ')"></i>';
						}
					}, 
					{
						"title": "Phone Number",
						"data": "phone_number",
						"orderable": false,
						"render": function (data, type, full, meta) {
							return '<a href="tel:' + data + '">' + data + '</a>';
						}
					},
					{
						"title": "Blood Group",
						"data": "blood_group"
					},
					{
						"title": "Available Time",
						"data": "available_time"
					},
					{
						"title": "Type Of Service",
						"data": "type_of_service",
						"orderable": false
					}
				],
				"columnDefs": [{
					"targets": 0,
					"render": function (data) {
						if (data == "") {
							data = "./content/images/default-profile-pic.png";
						}
						var path = ".\/profile_pictures\/" + data;
						var element = '<img onclick="img_modal(this.src);" class="img-circle img-user center card" src="' + path + '" onerror="this.src = \'./content/images/default-profile-pic.png\'">';
						return element;
					}
				}]
			});
			$('#list_records_filter input').unbind();
			$('#list_records_filter input').bind('keyup', function (e) {
				if (e.keyCode == 8 && this.value.length == 0 && isSearched) {
					oTable.search("").draw();
					isSearched = false;
				}
				if (e.keyCode == 13) {
					isSearched = true;
					oTable.search(this.value).draw();
				}
			});
			$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
   				$($.fn.dataTable.tables(true)).DataTable()
				.columns.adjust()
      			.responsive.recalc();
			});
		});

		function copyToClipboard(element) {
			var ele = document.getElementById(element);
			ele.className = "";
  			var $temp_copy = $("<input>");
  			$("body").append($temp_copy);
  			$temp_copy.val(element).select();
  			document.execCommand("copy");
  			$temp_copy.remove();
			  
			
			  ele.className = "Blink";
			 // $('#'+ element +').addClass("Blink");
		}
	</script>
</head>

<body>
	<div class="row card responsive" style="margin:15px !important">
		<div class="col-xs-12" style="padding-top:15px; padding-bottom:15px;">
			<table id="list_records" class="mobile table table-striped table-bordered text-center dt-responsive" style="width:100%;"></table>
		</div>
	</div>
	<div id="perpage"></div>
	


	<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
</head>
<body>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" >
    <span class="close">&times;</span>
	<div id = "modal_append_here" style="align:center"></div>

  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
// var btn = document.getElementById("myBtne");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// btn.onclick = function() {
//     modal.style.display = "block";
// }

function img_modal(path){
	var image_modal = '<center><img style="width:50%; height:50%;" class="img-circle img-user center card" src="' + path + '" onerror="this.src = \'./content/images/default-profile-pic.png\'"></center>';
	// modal_to_append.appendChild(image_modal);
	document.getElementById("modal_append_here").innerHTML = image_modal;
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
</body>

</html>