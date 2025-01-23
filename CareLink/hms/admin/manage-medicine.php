<?php
session_start();
error_reporting(0);
include('include/config.php');

// Add Medicine
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_medicine'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    $sql = mysqli_query($con, "INSERT INTO medicines (name, category, price, quantity, expiry_date) VALUES ('$name', '$category', '$price', '$quantity', '$expiry_date')");
    if ($sql) {
        $_SESSION['msg'] = "Medicine added successfully!";
    } else {
        $_SESSION['msg'] = "Error adding medicine!";
    }
}

// Update Medicine
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_medicine'])) {
    $id = $_POST['medicine_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    $sql = mysqli_query($con, "UPDATE medicines SET name='$name', category='$category', price='$price', quantity='$quantity', expiry_date='$expiry_date' WHERE id='$id'");
    if ($sql) {
        $_SESSION['msg'] = "Medicine updated successfully!";
    } else {
        $_SESSION['msg'] = "Error updating medicine!";
    }
}

// Delete Medicine
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_medicine'])) {
    $id = $_POST['medicine_id'];
    $sql = mysqli_query($con, "DELETE FROM medicines WHERE id='$id'");
    if ($sql) {
        $_SESSION['msg'] = "Medicine deleted successfully!";
    } else {
        $_SESSION['msg'] = "Error deleting medicine!";
    }
}

// Fetch Medicines
$medicines = mysqli_query($con, "SELECT * FROM medicines");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Medicines and Medical History</title>
    
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
                    <h1>Manage Medicines</h1>
                    
                    <!-- Flash Message -->
                    <?php if ($_SESSION['msg']) { ?>
                        <div class="alert alert-info">
                            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
                        </div>
                    <?php } ?>

                    <!-- Add Medicine Form -->
                    <form method="POST">
                        <h3>Add Medicine</h3>
                        <input type="text" name="name" placeholder="Medicine Name" required>
                        <input type="text" name="category" placeholder="Category" required>
                        <input type="number" step="0.01" name="price" placeholder="Price" required>
                        <input type="number" name="quantity" placeholder="Quantity" required>
                        <input type="date" name="expiry_date" required>
                        <button type="submit" name="add_medicine">Add Medicine</button>
                    </form>

                    <!-- Medicine List -->
                    <h3>Medicine List</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($medicines)) { ?>
                            <tr>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['category']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td><?= $row['expiry_date']; ?></td>
                                <td>
                                    <!-- Update Medicine -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="medicine_id" value="<?= $row['id']; ?>">
                                        <input type="text" name="name" value="<?= $row['name']; ?>" required>
                                        <input type="text" name="category" value="<?= $row['category']; ?>" required>
                                        <input type="number" step="0.01" name="price" value="<?= $row['price']; ?>" required>
                                        <input type="number" name="quantity" value="<?= $row['quantity']; ?>" required>
                                        <input type="date" name="expiry_date" value="<?= $row['expiry_date']; ?>" required>
                                        <button type="submit" name="update_medicine">Update</button>
                                    </form>

                                    <!-- Delete Medicine -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="medicine_id" value="<?= $row['id']; ?>">
                                        <button type="submit" name="delete_medicine" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Include Footer -->
    <?php include('include/footer.php'); ?>
</body>
</html>
