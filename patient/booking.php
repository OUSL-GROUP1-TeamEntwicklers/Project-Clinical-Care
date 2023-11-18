<?php include('functions.php');

// if (!isPatient()) {
//         $_SESSION['msg'] = "You must log in first";
//         header('location: ../booking.php');
//     }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="/pis/css/booking.css">
	<link rel="stylesheet" type="text/css" href="/pis/css/all.css">

	<?php include('link_css.php'); ?>
	<?php include('link_js.php'); ?>
</head>
<body>

	<nav>
    <label id="title">| Booking</label>
      <ul>
      	<li><a href="booking.php">Home</a></li>
        <li><a href="/pis/index.php?logout='1' "style="font-size:14px;" id="logout">logout</a></li>
        <li>
				<!-- logged in user information -->
<!-- logged in user information -->
     		<?php  if (isset($_SESSION['user'])) : ?>
                <strong><?php echo $_SESSION['user']['user_type']="Patient"; ?></strong>

                <small>
                    <i  style="color: cyan;">(<?php echo ucfirst($_SESSION['user']['fname']); ?>)</i> 
                    <img src="/pis/images/17.png" class="profile_info">
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

	<h1>Booking</h1>

	<form action="booking.php" method="post" id="frm">
        <?php include('../errors.php'); ?>

		<input type="hidden" name="p_id" value="<?php echo $_SESSION['user']['p_id']; ?>">

		<label>Booking Date</label><br><br>
		<input type="Date" name="booking_date" placeholder="Enter Booking Date" id="name"><br><br>

		<label>Channel Doctor</label><br><br>
		<select id="slt" name="doctor">
			<option value=""></option>
			<option value="Dr. Sampath Hemachandra">Dr. Sampath Hemachandra</option>
			<option value="Dr. Prabhath Weerasiri">Dr. Prabhath Weerasiri</option>
			<option value="Dr. Nishantha D. Gamage">Dr. Nishantha D. Gamage</option>
			<option value="Dr. Hiran Hewage">Dr. Hiran Hewage</option>
			<option value="Dr. Mihira Manamperi">Dr. Mihira Manamperi</option>
			<option value="Dr. Chinthaka Gunarathne">Dr. Chinthaka Gunarathne</option>
			<option value="Dr. Malathi Adhikari">Dr. Malathi Adhikari</option>
            <option value="Dr. Npuna Ranaweera">Dr. Npuna Ranaweera</option>
            <option value="Dr. Pradeep Siriwardhana">Dr. Pradeep Siriwardhana</option>
		</select>
		<br><br>

		<label>Reason</label><br><br>
		<textarea id="test" name="reason"></textarea><br><br>

        <!-- <label>Time</label><br><br>
        <input type="text" name="time" id="name" readonly value=" <?php
        date_default_timezone_set("Asia/Colombo");
        echo date("h:i");
        ?>"><br><br> -->

        

		<input type="submit" name="booking" value="Booking" id="booking">
	</form>

</div><br><br><br>

<div id="s">
<table id="allusers" class="table table-striped table-bordered" style="width: 100%">
    	<thead>
    		<tr>
    			<th>Booking Id</th>
    			<th id="a">Booking Date</th>
    			<th id="a">Reason</th>
    			<th id="a">Channel Doctor</th>
    			<th id="a">Approval</th>
    			<th id="a">Approval Time</th>
    			<th>Action View</th>
    			<th>Action Edit</th>
    		</tr>
    	</thead>

    	<tbody> 
    		<?php 
            $p_id = $_SESSION['user']['p_id'];
            $result_A = mysqli_query($db,"SELECT * FROM booking WHERE p_id = $p_id");
            while ($row = mysqli_fetch_array($result_A)) { ?> 
    		<tr>
    			<td><?php echo $row['booking_id']; ?></td>
    			<td id="a"><?php echo $row['booking_date']; ?></td> <!-- a refer as text align -->
    			<td id="a"><?php echo $row['reason']; ?></td>
    			<td id="a"><?php echo $row['doctor']; ?></td>
    			
                <td>
                    <?php if ($row['approval']==0): ?>
                        <button type="button" class="btn btn-danger btn-sm">Not Approval</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-success btn-sm">Aproveled</button>
                    <?php endif ?>
                </td>
            
                <td>
                    <?php if ($row['approval']==0): ?>
                        Procesing
                    <?php else: ?>
                    <?php echo $row['approval_time']; ?>
                    <?php endif ?>
                </td>
            

    			<td>
    				<a href="view_booking.php?view=<?php echo $row['booking_id']; ?>" class="btn btn-primary btn-sm" ><i class="fas fa-edit"></i>VIEW</a>
    			</td>

    			<td>
    				<a href="edit_booking.php?edit_booking=<?php echo $row['booking_id']; ?>" class="btn btn-primary btn-sm" ><i class="fas fa-eye"></i>EDIT</a>
    			</td>

    		</tr>
    		<?php } ?>
    	</tbody>	
    </table>
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