<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

// Get user data from session
$userid = $_SESSION['id'];

if (isset($_POST['submit'])) {
    // Retrieve image file
    $paymentImage = $_FILES['paymentImage']['name'];
    $paymentImageTmp = $_FILES['paymentImage']['tmp_name'];

    // Check for upload errors
    if ($_FILES['paymentImage']['error'] != UPLOAD_ERR_OK) {
        echo "<script>alert('Error uploading file: " . $_FILES['paymentImage']['error'] . "');</script>";
    } else {
        // Validate image type
        $imageType = $_FILES['paymentImage']['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imageType, $allowedTypes)) {
            echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.');</script>";
            return;
        }

        // Generate a unique name for the image
        $imageName = time() . "_" . basename($paymentImage);

        // Ensure the "payment_images" directory exists
        $imageDir = 'payment_images';
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        // Set the image path
        $imagePath = $imageDir . DIRECTORY_SEPARATOR . $imageName;

        // Move the uploaded file to the "payment_images" folder
        if (move_uploaded_file($paymentImageTmp, $imagePath)) {
            // Insert payment details into the database
            $insertPayment = $con->prepare(
                "INSERT INTO payment_details (userId, paymentImagePath, status) 
                 VALUES (?, ?, ?)"
            );
            $status = 'Pending'; // Initial status, to be updated after admin verification
            $insertPayment->bind_param("iss", $userid, $imagePath, $status);

            if ($insertPayment->execute()) {
                echo "<script>alert('Your payment details have been submitted for verification.');</script>";
            } else {
                echo "<script>alert('Failed to submit payment details. Please try again later.');</script>";
            }

            $insertPayment->close();
        } else {
            echo "<script>alert('Failed to upload payment image. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Page</title>
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
            <?php include('include/header.php'); ?>

            <div class="main-content">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Payment Verification</h1>
                            <hr>
                            <h2 style="font-family: Arial; font-size: 20px;">Bank Name: Meezan Bank<br>
Account Holder Name: Ayesha Urooj<br>
Account Number: 123456789012<br>
IBAN Number: PK36123456789012</h2>
                        </div>
                    </div>
                </section>

                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Upload Payment Verification Image</h5>
                                </div>
                                <div class="panel-body">
                                    <form role="form" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="paymentImage">Upload Payment Verification Image</label>
                                            <input type="file" name="paymentImage" class="form-control" required="required">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('include/footer.php'); ?>
        </div>
    </div>
</body>
</html>