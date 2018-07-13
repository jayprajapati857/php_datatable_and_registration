<?php 
//error_reporting(E_WARNING | E_NOTICE | E_DEPRECATED);
// error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & E_STRICT);
include 'conn.php';

$draw = intval( $_REQUEST['draw'] ); //Draw counter. This is used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables(Ajax requests are asynchronous and thus can return out of sequence).
$searchFor = !empty($_POST['search']['value']) ? $_POST['search']['value'] : ''; // global serach value
$orderIndex = !empty($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : ''; // call function to get the column name create function which returns column name from database
$orderBy = !empty($_POST['columns'][$orderIndex]['data']) ? $_POST['columns'][$orderIndex]['data'] : 'user_id';
$orderDirection = !empty($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : ''; //returns how to sort in which direction asc or desc
$start = $_POST['start']; 
$limit = $_POST['length']; 
// $sidx = 'user_id'; //$_GET['sidx']; 
// $sord = 'desc';



//if(!$sidx) $sidx =1; 

// $result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM user_master"); 
// $row = mysqli_fetch_array($result); 

// $count = $row['count']; 
// if( $count > 0 && $limit > 0) { 
//     $total_pages = ceil($count/$limit); 
// } else { 
//     $total_pages = 0; 
// } 
// if ($page > $total_pages) $page=$total_pages;
// $start = $limit*$page - $limit;
// if($start <0) $start = 0; 

$SQL = "SELECT *, (SELECT count(*) from user_master where dead = 0 and hidden = 0 and active = 1 and blocked = 0 ) as cnt FROM user_master where dead = 0 and hidden = 0 and active = 1 and blocked = 0 ". (($searchFor != '') ? "and concat(profile_display_name,first_name,last_name,user_address,user_email,phone_number,blood_group,available_time,type_of_service) like '%". $searchFor ."%'":"") ." ORDER BY $orderBy $orderDirection LIMIT $start , $limit"; 
$result = mysqli_query($conn, $SQL ) or die("Couldn't execute query.".mysqli_error($conn)); 
$totalRowsFetched = mysqli_num_rows($result);
$count = 0;
$i=0;
if($totalRowsFetched > 0)
{
	while($row = mysqli_fetch_array($result)) {		
		$response->data[$i] = array(
									'user_id'=>$row['user_id'],
									'profile_display_name'=>$row['profile_display_name'],
									'first_name'=>$row['first_name'],
									'last_name'=>$row['last_name'],
									'user_address'=>$row['user_address'],
									'user_email'=>$row['user_email'],
									'phone_number'=>$row['phone_number'],
									'blood_group'=>$row['blood_group'],
									'available_time'=>$row['available_time'],
									'type_of_service'=>$row['type_of_service'],
									'profile_img_path'=>$row['profile_img_path']
								);	
		if($row['cnt'] > 0) 
		{
			$count = $row['cnt'];
		}
		$i++;		
	}
}
else
{
	$response = new stdClass();		
	$response->data = [];
}
 $response->draw = intval( $_REQUEST['draw'] );
 $response->recordsTotal = $count;
 $response->recordsFiltered = $count;
 $response->searchFor = $searchFor; 
echo json_encode($response);
?>