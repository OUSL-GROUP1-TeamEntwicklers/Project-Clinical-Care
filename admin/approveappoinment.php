<?php include('functionsclinics.php');

// Check admin is logged
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

    $booking_id = ''  ;
      $doctor = '';
      $p_id = '';
      $booking_date ='';
      $selected_time = '';
      $approval_time ='';
      $approval = '';
      $status ='' ;

if (isset($_GET['approve_appoinment'])) {
    $p_id = $_GET['approve_appoinment'];
    $approveappoinment= true;
    $rec = mysqli_query($db, "SELECT * FROM booking WHERE p_id = $p_id"); 
  
     $record = mysqli_fetch_array($rec);
      $booking_id =   $record['booking_id'];
      $doctor = $record['doctor'];
      $p_id = $record['p_id'];
      $booking_date = $record['booking_date'];
      $selected_time = $record['selected_time'];
      $approval_time =$record['approval_time'];
      $approval = $record['approval'];
      $status = $record['status'];

    
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Approve Appoinments</title>
	<link rel="stylesheet" type="text/css" href="/pis/css/admin/admin_home.css">
	<link rel="stylesheet" type="text/css" href="/pis/css/all.css">
	<link rel="stylesheet" type="text/css" href="/pis/css/response.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<?php include('link_css.php'); ?>
	<?php include('link_js.php'); ?>
</head>
<body>

	<nav>
    <label id="title">| Clinical Care</label>
      <ul>
        <li><a  href="admin_home.php">Home</a></li>
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

      </ul>
    </nav>

<?php if (isset($_SESSION['message'])):?>
    	<div class="msg">
    	<?php
    		echo $_SESSION['message'];
    		unset($_SESSION['message']);
    	?>	
    	</div>
    <?php endif ?>

<div class="container">

	<h1>Approve Appoinments</h1> <br> <br>

	<form id="reg" method="post" action="approveappoinment.php">
			<?php include('../errors.php'); 
            
            ?>
			<table border="0">
            <tr>
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <input type="hidden" name="doctor" value="<?php echo $doctor; ?>">
<!-- ... other hidden inputs for p_id, booking_date, selected_time, etc. -->


                <td>	
                    <label>Booking ID:</label>
                </td>

                <td>
                    <label><?php echo $booking_id; ?><label>
                </td>
                </tr>
            <tr>
					<td>	
						<label>Clinic Name:</label>
					</td>
                    
                    <td>
						<label><?php echo $doctor; ?></label>
                    </td>
</tr>
<tr>
                    <td>	
						<label>Clinic Date:</label>
					</td>
                    
                    <td>
						<label><?php echo $booking_date; ?></label>
                    </td>
</tr>
<tr>

                    <td>	
						<label>Patient ID:</label>
					</td>
                    
                    <td>
						<label><?php echo $p_id; ?></label>
                    </td>
</tr>
<tr>

                    <td>	
						<label>Selected Time:</label>
					</td>
                    
                    <td>
						<label><?php echo $selected_time; ?></label>
                    </td>
</tr>
<tr>

                    <td>	
						<label>Approval</label>
					</td>
                    
                    <td>
						
                        <input type="text" name="approval"  value="<?php echo $approval; ?>" id="approval">
                    </td>
</tr>
<tr>

                    <td>	
						<label>Approval Time</label>
					</td>
                    
                    <td>
						
                        <input type="time" name="approval_time"  value="<?php echo $approval_time; ?>" id="approval_time">
                    </td>

</tr>
<tr>

                    <td>	
						<label>Status</label>
					</td>
                    
                    <td>
						
                        <input type="text" name="status"  value="<?php echo $status; ?>" id="status">
                    </td>
                    
</tr>
</table>
<input type="submit" name="approve_appoinment" value="Update" id="submit">
</form>

		

</div><br><br><br>


   
</div>

 <!-- data table (search, show entries etc..) -->
    <script>
  	$(document).ready(function() {
    $('#allusers').DataTable();
	} );
	</script>

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