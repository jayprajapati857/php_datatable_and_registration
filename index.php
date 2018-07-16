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
    <link href="css/jatin_foundation.css" rel="stylesheet">

    <style>
      .errMsg
      {
        color:red;
        padding-top:15px;        
      }
      .errBorder
      {
        border-style: solid;
        border-color: red;
      }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="row card" style="margin:15px !important ">
    <div class="col-xs-12"  style="padding-top:15px; padding-bottom:15px;">
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

        $imgPath = "";
        $imgName ="";

        $error=array();
        $errSet = 0;

        if($profile_name=="")
        {
          $error['profile_name']="Enter Profile Name";
          $errSet = 1;
        }
        else if($profile_name != "")
        {
          $sel="SELECT * FROM user_master WHERE profile_display_name='$profile_name'";
          $res=mysqli_query($conn, $sel) or die (mysqli_error($conn));
          $row=mysqli_num_rows($res);
          if($row)
          {
            $error['profile_name']="User name already exist!";  
            $errSet = 1;
          }      
        }
        if($first_name=="")
        {
          $error['first_name']="Enter First Name";
          $errSet = 1;
        }
        if($last_name=="")
        {
          $error['last_name']="Enter Last Name";
          $errSet = 1;
        }
        if($email=="")
        {   
          $error['email']="Please Enter Email";
          $errSet = 1;   
        }	
        else if($email != "")
        {	
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {         
            $error['email']="Invalid email format";
            $errSet = 1;
          }
          else
          {
            $sel="SELECT * FROM user_master WHERE user_email='$email'";
            $res=mysqli_query($conn, $sel) or die (mysqli_error($conn));
            $row=mysqli_num_rows($res);
            if($row)
            {
              $error['email']="Email already exist!";
              $errSet = 1;  
            }
          }      
        }
        if($pwd=="")
        {      
          $error['pwd']="Plese Enter Password";
          $errSet = 1;
        }
        if($pwd != "" && $cpwd == "")
        {
          $error['cpwd']="Plese Enter Confirm-Password";
          $errSet = 1;
        }
        if($pwd != "" && $cpwd != "")
        {
          if($pwd != $cpwd)
          {
            $error['cpwd']="Confirm-password does not match with password";
            $errSet = 1;
          }          
        }
        if($addr=="")
        {          
          $error['addr']="Enter Address";
          $errSet = 1;
        }
        if($num=="")
        {
          $error['num']="Plese Enter Phone number";
          $errSet = 1;
        }
        if($blood_group == "")
        {
          $error['blood_group']="Plese select blood Group";
          $errSet = 1;
        }
        if($avail_time == "")
        {
          $error['avail_time']="Plese Enter Available time";
          $errSet = 1;      
        }
        if($type_of_service == "")
        {
          $error['type_of_service']="Plese Enter type of service"; 
          $errSet = 1;     
        }
        if($_FILES['profile_img']['size'] != 0 && $_FILES['profile_img']['error'] > 0)
        {
          $error['profile_img']="Something went wrong! Please select another Image."; 
          $errSet = 1;
        }        
        if($errSet == 0)
        {          
          if($_FILES['profile_img']['size'] != 0)
          {        
            //echo "<script>alert('" . $_FILES["profile_img"]["error"] . "');</script>";
            if(!file_exists('profile_pictures'))
            {
              mkdir('profile_pictures', 0777, true);
            }

            $imgPath="profile_pictures/" . basename($_FILES["profile_img"]["name"]);
            $imgName = basename($_FILES["profile_img"]["name"]);
            $imgFileType = strtolower(pathinfo($imgPath,PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES["profile_img"]["tmp_name"]);
            if($check !== false)
            {
              copy($_FILES["profile_img"]["tmp_name"],$imgPath);            
              echo "<script>alert('Profile Image uploaded Successfully.! ');</script>"; 
              
              $ins="INSERT INTO user_master (first_name, last_name, profile_display_name,profile_img_path,user_pwd,user_address,user_email,phone_number,blood_group,available_time,type_of_service) VALUES('$first_name','$last_name','$profile_name','$imgName','$pwd','$addr','$email',$num,'$blood_group','$avail_time','$type_of_service')"; 
            
              mysqli_query($conn,$ins) or die (mysqli_error($conn));
              echo "<script>alert('You registered Successfully.! ');window.location='index.php';</script>";	
            }
            else
            {
              $error['profile_img']="Something went wrong! Please select another Image.";
              echo "<script>alert('You cant Upload this File.! ');</script>";          
            }   
          }
          else {
            $ins="INSERT INTO user_master (first_name, last_name, profile_display_name,profile_img_path,user_pwd,user_address,user_email,phone_number,blood_group,available_time,type_of_service) VALUES('$first_name','$last_name','$profile_name','$imgName','$pwd','$addr','$email',$num,'$blood_group','$avail_time','$type_of_service')"; 
            
            mysqli_query($conn,$ins) or die (mysqli_error($conn));
            echo "<script>alert('You registered Successfully.! ');window.location='index.php';</script>";	
          }                 

          		
        }
      }
	  ?>
  <form action="" method="post" name="registr" enctype="multipart/form-data">
        <table class="table table-bordered table-striped" style="padding:20px !important">
          <tr> 
            <td style="text-align: left;"><label for="profilePicture">Profile Picture</label></td>
            <td><label class="form-control-file btn-bs-file btn btn-sm btn-primary upload_profile_pic"><input type="file" name="profile_img" id="profile_img"/></label><span class="errMsg"><?php if(isset($error['profile_img'])) echo $error['profile_img']?></span></td>                     
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="profileDisplayName" class="control-label">User Name<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['profile_name'])) echo 'errBorder'?>" name="profile_name" placeholder="User Name" maxlength="50"  id="profile_name" value="<?php if(isset($profile_name)) echo $profile_name; ?>"/> <span class="errMsg"><?php if(isset($error['profile_name'])) echo $error['profile_name']?></span></td>                        
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="firstName" class="control-label">First Name<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['first_name'])) echo 'errBorder'?>" name="first_name" placeholder="Firstname" maxlength="50"  id="first_name" value="<?php if(isset($first_name)) echo $first_name; ?>"/> <span class="errMsg"><?php if(isset($error['first_name'])) echo $error['first_name']?></span> </td>            
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="lastName">Last Name<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['last_name'])) echo 'errBorder'?>" name="last_name" placeholder="Lastname" maxlength="50"  id="last_name" value="<?php if(isset($last_name)) echo $last_name; ?>"/> <span class="errMsg"><?php if(isset($error['last_name'])) echo $error['last_name']?></span> </td>            
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="email">Email<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['email'])) echo 'errBorder'?>" name="email" id="email" placeholder="E-mail" maxlength="30"  value="<?php if(isset($email)) echo $email; ?>" /><span class="errMsg"><?php if(isset($error['email'])) echo $error['email']?></span></td>          	
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="password">Password<span class="errMsg">*</span></label></td>
            <td><input type="password" class="form-control <?php if(isset($error['pwd'])) echo 'errBorder'?>" name="pwd" id="pwd" placeholder="Enter password" maxlength="20"  value="<?php if(isset($pwd)) echo $pwd; ?>"/> <span class="errMsg"><?php if(isset($error['pwd'])) echo $error['pwd']; ?></span> </td>            
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="confirmPassword">Confirm Password<span class="errMsg">*</span></label></td>
            <td><input type="password" class="form-control <?php if(isset($error['cpwd'])) echo 'errBorder'?>" name="cpwd" id="cpwd" placeholder="Confirm-Password"  value="<?php if(isset($cpwd)) echo $cpwd; ?>" /><span class="errMsg"><?php if(isset($error['cpwd'])) echo $error['cpwd']?></span></td>			      
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="address">Address<span class="errMsg">*</span></label></td>
            <td><textarea name="addr" class="form-control <?php if(isset($error['addr'])) echo 'errBorder'?>" id="addr" placeholder="Enter address" maxlength="50"><?php if(isset($addr)) echo $addr; ?></textarea> <span class="errMsg"><?php if(isset($error['addr'])) echo $error['addr']?></span></td>            
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="phoneNumber">Phone Number<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['num'])) echo 'errBorder'?>" maxlength="12" name="num" id="num"  placeholder="Mobile No" value="<?php if(isset($num)) echo $num; ?>"/><span class="errMsg"><?php if(isset($error['num'])) echo $error['num']?></span></td>               
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="bloodGroup">Blood Group<span class="errMsg">*</span></label></td>
            <td>
              <div class="">                
                <div class="dropdown">
                    <button id= "blood_group_drop_down_button" style="width:  100px; float: left;" class="btn-primary btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown"><span id="selected_blood_group">Blood Group</span>
                    <span class="caret"></span></button>
                    <ul id="ulBloodGroup" class="dropdown-menu">
                      <li><a href="#" onclick="event.preventDefault();">A+</a></li>
                      <li><a href="#" onclick="event.preventDefault();">A-</a></li>
                      <li><a href="#" onclick="event.preventDefault();">B+</a></li>
                      <li><a href="#" onclick="event.preventDefault();">B-</a></li>
                      <li><a href="#" onclick="event.preventDefault();">O+</a></li>
                      <li><a href="#" onclick="event.preventDefault();">O-</a></li>
                      <li><a href="#" onclick="event.preventDefault();">AB+</a></li>
                      <li><a href="#" onclick="event.preventDefault();">AB-</a></li>
                    </ul>
                  </div>
                  <input type="hidden" class="form-control <?php if(isset($error['blood_group'])) echo 'errBorder'?>" name="blood_group" placeholder="Blood Group" maxlength="3"  id="blood_group" value="<?php if(isset($blood_group)) echo $blood_group; ?>"/><span class="errMsg"><?php if(isset($error['blood_group'])) echo $error['blood_group']?></span>
                </div>
            </td>                      
          </tr>
          <tr> 
            <td style="text-align: left;"><label for="availableTime">Available Time<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['avail_time'])) echo 'errBorder'?>" name="avail_time" placeholder="Available Time" maxlength="50"  id="avail_time" value="<?php if(isset($avail_time)) echo $avail_time; ?>"/><span class="errMsg"><?php if(isset($error['avail_time'])) echo $error['avail_time']?></span></td>            
          </tr>  
          <tr> 
            <td style="text-align: left;"><label for="typeOfService">Type of Service<span class="errMsg">*</span></label></td>
            <td><input type="text" class="form-control <?php if(isset($error['type_of_service'])) echo 'errBorder'?>" name="type_of_service" placeholder="Type Of service" maxlength="50"  id="type_of_service" value="<?php if(isset($type_of_service)) echo $type_of_service; ?>"/><span class="errMsg"><?php if(isset($error['type_of_service'])) echo $error['type_of_service']?></span></td>            
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="SUBMIT" class="btn btn-success" value="REGISTER" /> 
            <!-- <input type="button" class="btn btn-primary" name="Login" value="Login">  -->
            <a href="showRecords.php"><input type="button" class="btn btn-primary" name="ShowRecords" value="View Users"></a> </td>
          </tr>          
        </table>
      </form>   
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.3.1.js"></script>

    <script>

      $('#profile_img').change(function(e){
            $('#filename_print').remove();
            $(this).parent().parent().prepend(
							'<label id="filename_print" class="form-control">'+e.target.files[0].name+'</label>');
        });

      $('#ulBloodGroup li').on('click', function(){
          $('#blood_group').val($(this).text());
          $('#selected_blood_group').remove();
          $('#blood_group_drop_down_button').prepend('<span id="selected_blood_group">'+$(this).text()+'</span>');
      });

      function validateEmail(emailField) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(emailField.value) == false) 
          {
            alert('Invalid Email Address');
            return false;
          }
        return true;
      }

      function AllowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
          e.preventDefault();
        }
      }

      $(function(){
        $('#num').keydown(function(e){
            return AllowNumbersOnly(e);
        });
      });
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>