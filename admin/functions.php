<!-- common function -->
<?php include('../functions.php');

	// Add users................................................................................
	if (isset($_POST['add_user'])) {

	// receive all input values from the form
		$user_name    = ($_POST['user_name']);
		$email       = ($_POST['email']);
		$password_1  = ($_POST['password_1']);
		$password_2  = ($_POST['password_2']);
		$user_type = ($_POST['user_type']);
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];

		

		// form validation: ensure that the form is correctly filled
		if (empty($user_name)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if (empty($user_type)) {
			array_push($errors, "User Type is required");
		}

		if (empty($fname)) {
			array_push($errors, "First Name is required");
		}

		if (empty($lname)) {
			array_push($errors, "Last Name is required");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

				$query = "INSERT INTO staff (`fname`, `lname`, `user_type`, `user_name`, `email`, `password`) 
						  VALUES('$fname','$lname','$user_type','$user_name','$email','$password')";
				mysqli_query($db, $query);
				$_SESSION['message']  = "New user successfully created!!";
				header('location: /pis/admin/user_list.php');
			}else{
						array_push($errors, "Connection errors !");		
			}

		}
	
	// *************************************************************************************

	// Insert data table from database

	$query = "SELECT staff_id,fname,lname,user_type,user_name,email FROM staff";
	$result_set = mysqli_query($db, $query);

	

		
 	// // *********************************************************************************

	//Delete Records

	  if (isset($_GET['del'])) {
	  $staff_id = $_GET['del'];
	  mysqli_query($db, "DELETE FROM staff WHERE staff_id ='$staff_id'"); 
	  
	  $_SESSION['message'] = "Address deleted!";
	  header('location: user_list.php');

	}

	// // *********************************************************************************

	//Update Records

	 if (isset($_POST['update'])) {

	  $fname = $_POST['fname'];
	  $lname = $_POST['lname'];
	  $user_name = $_POST['user_name'];
	  $email = $_POST['email'];
	  $user_type = $_POST['user_type'];
	  $staff_id = $_POST['staff_id'];

	  mysqli_query($db, "UPDATE staff SET fname='$fname',lname='$lname',user_name='$user_name',email='$email',user_type='$user_type' WHERE staff_id='$staff_id'");

	  $_SESSION['message'] = "Data is updated!";
	  header('location: user_list.php');

	 }

	// // *********************************************************************************

	//Reset password

	if (isset($_POST['reset'])) {

	  $staff_id = $_POST['staff_id'];
	  $password_1  =  $_POST['password_1'];
	  $password_2  =  $_POST['password_2'];

    
    if (empty($password_1)) { 
      array_push($errors, "Password is required"); 
    }

    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
    
    // register user if there are no errors in the form
    if (count($errors) == 0) {
       $password = md5($password_1);
      

    mysqli_query($db, "UPDATE staff SET password='$password' WHERE staff_id='$staff_id'");

    array_push($errors, "Password reset Successfully!!");
    header('location: user_list.php');

    }
  }


  //approve appoinments

  if (isset($_POST['approve_appoinment'])) {

	$booking_id =   $_POST['booking_id'];
      $doctor = $_POST['doctor'];
      $p_id = $_POST['p_id'];
      $booking_date =$_POST['booking_date'];
      $selected_time = $_POST['selected_time'];
      $approval_time =$_POST['approval_time'];
      $approval = $_POST['approval'];
      $status = $_POST['status'];


	

	mysqli_query($db, "UPDATE booking SET approval_time = '$approval_time',approval = '$approval', status = '$status' WHERE booking_id ='$booking_id'");

	$_SESSION['message'] = "Data is updated!";
	header('location: admin_home.php');

   }

// ***************************************************************************************************************
  ?>