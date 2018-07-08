<!DOCTYPE html>
<?php 
  ini_set('display_errors', 'On');
	include 'conn.php';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Jatin's Foundation</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div>
    <div class="col-xs-12">
    <?php 
	if(isset($_POST['SUBMIT']) && $_POST['SUBMIT']=='REGISTER')
	{
		$profile_name=trim($_POST['profile_name']);
    $first_name=trim($_POST['first_name']);
    $last_name=trim($_POST['last_name']);		
		$email=trim($_POST['email']);
		$pwd=trim($_POST['pwd']);
    $cpwd=trim($_POST['cpwd']);
    $addr=trim($_POST['addr']);		
		$num=trim($_POST['num']);
		$blood_group = trim($_POST['blood_group']);
    $avail_time = trim($_POST['avail_time']);
    $type_of_service = trim($_POST['type_of_service']);

		$error=array();
    if($profile_name=="")
		{
			$error['profile_name']="Enter Profile Name";
		}
    else if($first_name=="")
		{
			$error['first_name']="Enter First Name";
		}
		else if($last_name=="")
		{
			$error['last_name']="Enter Last Name";
    }
    else if($email=="")
		{   
      $error['email']="Please Enter Email";   
    }	
    // else if($email != "")
		// 	{	$sel="SELECT * FROM user_master WHERE user_email='$email'";
		// 		$res=mysql_query($sel);
		// 		$row=mysql_num_rows($res);
		// 		if($row)
		// 		{
		// 			echo "<script>alert('email exist');</script>";
		// 		}
		// 	}
    else if($pwd=="")
		{      
			$error['pwd']="Plese Enter Password";
		}
		else if($addr=="")
		{
      echo 'addre';
			$error['addr']="Enter Address";
		}
		else if($num=="")
		{
			$error['num']="Plese Enter Phone number";
		}
    else if($blood_group == "")
    {
      $error['blood_group']="Plese Enter blood Group";
    }
    else if($avail_time == "")
    {
      $error['avail_time']="Plese Enter Available time";      
    }
    else if($type_of_service == "")
    {
      $error['type_of_service']="Plese Enter type of service";      
    }
		else
		{
      $imgPath = "";
			if($_FILES["profile_img"]["error"] > 0)
      {        
        echo "<script>alert('" . $_FILES["profile_img"]["error"] . "');</script>";
      }
      else
      {
        $imgPath="profile_pictures/" . basename($_FILES["profile_img"]["name"]);
      
        $imgFileType = strtolower(pathinfo($imgPath,PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["profile_img"]["tmp_name"]);
        if($check !== false)
         {
          copy($_FILES["profile_img"]["tmp_name"],$imgPath);            
          echo "<script>alert('Profile Image uploaded Successfully.! ');</script>";          
         }
        else
         {
          echo "<script>alert('You cant Upload this File.! ');</script>";          
         }              
      } 

			$ins="INSERT INTO user_master (first_name, last_name, profile_display_name,profile_img_path,user_pwd,user_address,user_email,phone_number,blood_group,available_time,type_of_service) VALUES('$first_name','$last_name','$profile_name','$imgPath','$pwd','$addr','$email',$num,'$blood_group','$avail_time','$type_of_service')"; 
				
			mysqli_query($conn,$ins) or die (mysqli_error($conn));
			echo "<script>alert('You registered Successfully.! ');window.location='index.php';</script>";			
		}
	}
	  ?>
  <form action="" method="post" name="registr" style="padding-right:70px;" enctype="multipart/form-data">
        <table class="table table-bordered">
          <tr> 
            <td>Profile Picture</td>
            <td><input type="file" name="profile_img" id="profile_img"/></td>         
            <td></td>
          </tr>
          <tr> 
            <td>Profile Display Name</td>
            <td><input type="text" name="profile_name" placeholder="Profile Display Name" maxlength="50" autocomplete="off" id="profile_name" value="<?php if(isset($profile_name)) echo $profile_name; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['profile_name'])) echo $error['profile_name']?></span></td>                   
          </tr>
          <tr> 
            <td>First Name</td>
            <td><input type="text" name="first_name" placeholder="Firstname" maxlength="50" autocomplete="off" id="first_name" value="<?php if(isset($first_name)) echo $first_name; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['first_name'])) echo $error['first_name']?></span></td>          
          </tr>
          <tr> 
            <td>Last Name</td>
            <td><input type="text" name="last_name" placeholder="Lastname" maxlength="50" autocomplete="off" id="last_name" value="<?php if(isset($last_name)) echo $last_name; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['last_name'])) echo $error['last_name']?></span></td>                   
          </tr>
          <tr> 
            <td>Email</td>
            <td><input type="text" name="email" id="email" placeholder="E-mail" maxlength="30" autocomplete="off" value="<?php if(isset($email)) echo $email; ?>" /></td>
          	<td width="50%"><span class="msg"><?php if(isset($error['email'])) echo $error['email']?></span></td>
          </tr>
          <tr> 
            <td>Password</td>
            <td><input type="password" name="pwd" id="pwd" placeholder="Enter password" maxlength="20" autocomplete="off" value="<?php if(isset($pwd)) echo $pwd; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['pwd'])) echo $error['pwd']; ?></span></td>        
          </tr>
          <tr> 
            <td>Confirm Password</td>
            <td><input type="password" name="cpwd" id="cpwd" placeholder="Confirm-Password" autocomplete="off"  /></td>
			      <td width="50%"><span class="msg"><?php if(isset($error['cpwd'])) echo $error['cpwd']?></span></td>        
          </tr>
          <tr> 
            <td>Address</td>
            <td><textarea name="addr" id="addr" placeholder="Enter address" maxlength="50"><?php if(isset($addr)) echo $addr; ?></textarea></td>
            <td width="50%"><span class="msg"><?php if(isset($error['addr'])) echo $error['addr']?></span></td>         
          </tr>
          <tr> 
            <td>Phone Number</td>
            <td><input type="text" maxlength="12" name="num" id="num" autocomplete="off" placeholder="Mobile No" value="<?php if(isset($num)) echo $num; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['num'])) echo $error['num']?></span></td>        
          </tr>
          <tr> 
            <td>Blood Group</td>
            <td><input type="text" name="blood_group" placeholder="Blood Group" maxlength="50" autocomplete="off" id="blood_group" value="<?php if(isset($blood_group)) echo $blood_group; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['blood_group'])) echo $error['blood_group']?></span></td>                            
          </tr>
          <tr> 
            <td>Available Time</td>
            <td><input type="text" name="avail_time" placeholder="Available Time" maxlength="50" autocomplete="off" id="avail_time" value="<?php if(isset($avail_time)) echo $avail_time; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['avail_time'])) echo $error['avail_time']?></span></td>                            
          </tr>  
          <tr> 
            <td>Type of Service</td>
            <td><input type="text" name="type_of_service" placeholder="Type Of service" maxlength="50" autocomplete="off" id="type_of_service" value="<?php if(isset($type_of_service)) echo $type_of_service; ?>"/></td>
            <td width="50%"><span class="msg"><?php if(isset($error['type_of_service'])) echo $error['type_of_service']?></span></td>                            
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="SUBMIT" value="REGISTER" /> <input type="button" name="Login" value="Login"></td><td> <a href="showRecords.php"><input type="button" name="ShowRecords" value="View Users"></a></td>
          </tr>          
        </table>
      </form>   
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>