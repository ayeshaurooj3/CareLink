<?php
session_start();
include('include/config.php');

// Update payment status and book appointment
if (isset($_POST['updateStatus'])) {
    $paymentId = intval($_POST['paymentId']);
    $status = $_POST['status'];

    // Update payment status
    $updatePayment = $con->prepare("UPDATE payment_details SET status = ? WHERE id = ?");
    $updatePayment->bind_param("si", $status, $paymentId);

    if ($updatePayment->execute()) {
        // If the payment is verified, update appointment status to 'Booked'
        if ($status === 'Verified') {
            $updateAppointment = $con->prepare("
                UPDATE appointment 
                SET status = 'Booked' 
                WHERE userId = (SELECT userId FROM payment_details WHERE id = ?)
            ");
            $updateAppointment->bind_param("i", $paymentId);
            $updateAppointment->execute();
        }
        echo "<script>alert('Payment status updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update payment status.');</script>";
    }
}

// Fetch all payment details
$query = $con->prepare("
    SELECT 
    p.id AS paymentId,
    p.userId,
    p.paymentImagePath,
    p.status AS paymentStatus,
    u.fullName AS userName,
    a.id AS appointmentId, 
    a.appointmentDate AS appointmentDate,
    d.doctorName AS name 
FROM 
    payment_details p
LEFT JOIN 
    users u ON p.userId = u.id
LEFT JOIN 
    appointment a ON p.userId = a.userId
LEFT JOIN 
    doctors d ON a.doctorId = d.id
GROUP BY 
    p.id
");
$query->execute();
$result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Payment Verification</title>
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
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>

            <div class="main-content">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="mainTitle">Admin - Payment Verification</h1>

                        <div class="row">
                            <div class="col-md-12">
                                
                                    <div class="panel-heading">
                                        <h5 class="panel-title">User Payment Details</h5>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Payment ID</th>
                                                    <th>User Name</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Appointment Date</th>
                                                    <th>Doctor</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td ><?php echo htmlspecialchars($row['paymentId']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['userName']); ?></td>
                                                        <td>
    <img src="http://localhost/CareLink/hms/<?php echo htmlspecialchars($row['paymentImagePath']); ?>" width="100" height="100" >
</td>
                                                        <td><?php echo htmlspecialchars($row['paymentStatus']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['appointmentDate']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                        <td>
                                                            <form method="POST" >
                                                                <input type="hidden" name="paymentId" value="<?php echo htmlspecialchars($row['paymentId']); ?>">
                                                                <select name="status" class="form-control">
                                                                    <option value="Pending" <?php echo $row['paymentStatus'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                                    <option value="Verified" <?php echo $row['paymentStatus'] == 'Verified' ? 'selected' : ''; ?>>Verified</option>
                                                                    <option value="Rejected" <?php echo $row['paymentStatus'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                                                                </select>
                                                                <button type="submit" name="updateStatus" class="btn btn-primary btn-sm mt-2">Update</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                                </div>
                            </div>
                            
                            

                            <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/main.js"></script>
  
</body>
</html>