<?php
session_start();
include('include/config.php');

// Fetch current date
$current_date = date('Y-m-d');

// Fetch Valid Medicines (not expired)
$valid_medicines = mysqli_query($con, "SELECT * FROM medicines WHERE expiry_date >= '$current_date'");

// Fetch Expired Medicines
$expired_medicines = mysqli_query($con, "SELECT * FROM medicines WHERE expiry_date < '$current_date'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Medicines</title>
        
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
            <?php include('include/header.php'); ?>

            <div class="main-content">
                <div class="container-fluid">
                    <h1>View Medicines</h1>

                    <!-- Flash Message -->
                    <?php if ($_SESSION['msg']) { ?>
                        <div class="alert alert-info">
                            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
                        </div>
                    <?php } ?>

                    <!-- Valid Medicines -->
                    <h3>Valid Medicines</h3>
                    <?php if (mysqli_num_rows($valid_medicines) > 0) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($valid_medicines)) { ?>
                                    <tr>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['category']; ?></td>
                                        <td><?= $row['price']; ?></td>
                                        <td><?= $row['quantity']; ?></td>
                                        <td><?= $row['expiry_date']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No valid medicines available.</p>
                    <?php } ?>

                    <!-- Expired Medicines -->
                    <h3>Expired Medicines</h3>
                    <?php if (mysqli_num_rows($expired_medicines) > 0) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($expired_medicines)) { ?>
                                    <tr>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['category']; ?></td>
                                        <td><?= $row['price']; ?></td>
                                        <td><?= $row['quantity']; ?></td>
                                        <td><?= $row['expiry_date']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No expired medicines found.</p>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include('include/footer.php'); ?>
</body>
</html>
