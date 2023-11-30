<!-- Main function -->
<?php include('../functions.php'); 

// Check admin is logged
	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Home</title>
	<link rel="stylesheet" type="text/css" href="/pis/css/admin/admin_home.css">
	<link rel="stylesheet" type="text/css" href="/pis/css/all.css">
	<link rel="stylesheet" type="text/css" href="/pis/css/response.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<?php include('link_css.php'); ?>
	<?php include('link_js.php'); ?>
</head>
<body>
	<nav>

		<!-- <input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars"></i>
		</label> -->
		
		<label id="title">| Admin</label>
			<ul>
				<li><a class="active" href="admin_home.php">Home</a></li>
				<li><a href="add_user.php">Add User</a></li>
				<li><a href="user_list.php">Edit User</a></li>
				<li><a href="add_item.php">Schedule Clinic</a></li>
				<li><a href="item_list.php">View Clinic</a></li>
				<li><a href="/pis/index.php?logout='1' "style="font-size: 14px;" id="logout">Log out</a></li>
				
			    <li>
					<!-- logged in user information -->

			    <?php  if (isset($_SESSION['user'])) : ?>
                <strong><?php echo $_SESSION['user']['user_type']; ?></strong>

                <small>
                    <i  style="color: cyan;">(<?php echo ucfirst($_SESSION['user']['user_name']); ?>)</i> 
                    <img src="/pis/images/18.png" class="profile_info">
                </small>

            	<?php endif ?>
			 	</li>
				
          
	</nav>
	
<!--ul>
				<li><a class ="tile1" href="admin_home.php">Home</a></li>
				<li><a class ="tile1" href="add_user.php">Add User</a></li>
				<li><a class ="tile1" href="user_list.php">Edit User</a></li>
				<li><a class ="tile1" href="add_item.php">Schedule Clinic</a></li>
				<li><a class ="tile1" href="item_list.php">View Clinic</a></li>
				<li><a id = "approve_appoinment"href="approveappoinment.php">Approve Appoinments</a></li>
				<li><a class ="tile1" href="view_appoinments.php">View Appoinments</a></li>
</ul-->


<!-- Error Mesage Displaying -->
	<?php if (isset($_SESSION['message'])):?>
		<div class="msg">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>	
		</div>
	<?php endif ?>

	<!-- ************************* error massage time out  ********************************** -->

	<script type="text/javascript">

	$(document).ready(function () {
	 
	window.setTimeout(function() {
	    $(".msg").fadeTo(1000, 0).slideUp(1000, function(){
	        $(this).remove();
	    });
	}, 5000);
	 
	});
	</script>






</body>
</html>