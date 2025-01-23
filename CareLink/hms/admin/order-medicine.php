<?php
session_start();
include('include/config.php');

// Fetch available medicines
$medicines = mysqli_query($con, "SELECT * FROM medicines WHERE expiry_date >= CURDATE()");

// Initialize variables for displaying order details
$order_items = [];
$total_price = 0;
$order_submitted = false;

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $errors = [];
    $order_items = [];
    $total_price = 0;
    
    foreach ($_POST['medicine_id'] as $key => $medicine_id) {
        $quantity = $_POST['quantity'][$key];

        // Fetch the medicine details
        $stmt = mysqli_prepare($con, "SELECT * FROM medicines WHERE id = ? AND expiry_date >= CURDATE()");
        mysqli_stmt_bind_param($stmt, 'i', $medicine_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $medicine = mysqli_fetch_assoc($result);

        if ($medicine) {
            if ($quantity > $medicine['quantity']) {
                $errors[] = "Insufficient stock for medicine: " . $medicine['name'] . ". Available: " . $medicine['quantity'];
            } else {
                $item_price = $medicine['price'] * $quantity;
                $total_price += $item_price;

                // Add order item details
                $order_items[] = [
                    'medicine_name' => $medicine['name'],
                    'quantity' => $quantity,
                    'price_per_unit' => $medicine['price'],
                    'total_price' => $item_price,
                    'expiry_date' => $medicine['expiry_date']
                ];

                // Update medicine stock using prepared statements
                $update_query = "UPDATE medicines SET quantity = quantity - ? WHERE id = ?";
                $update_stmt = mysqli_prepare($con, $update_query);
                mysqli_stmt_bind_param($update_stmt, 'ii', $quantity, $medicine_id);
                mysqli_stmt_execute($update_stmt);
            }
        } else {
            $errors[] = "Medicine ID $medicine_id is expired or unavailable.";
        }

        // Close prepared statement for the medicine query
        mysqli_stmt_close($stmt);
    }

    if (count($errors) > 0) {
        $_SESSION['msg'] = implode("<br>", $errors);
    } else {
        $user_id = $_SESSION['user_id']; 
        $delivery_fee = 0;

        // Insert order into 'orders' table using prepared statement
        $insert_order_query = "INSERT INTO orders (user_id, total_amount, delivery_fee) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_order_query);
        mysqli_stmt_bind_param($stmt, 'idi', $user_id, $total_price, $delivery_fee);
        
        if (mysqli_stmt_execute($stmt)) {
            $order_id = mysqli_insert_id($con); // Get the ID of the inserted order

            // Insert each item in the order_items table with the generated order ID
            foreach ($order_items as $item) {
                $medicine_name = $item['medicine_name'];
                $quantity = $item['quantity'];
                $price_per_unit = $item['price_per_unit'];
                $item_total_price = $item['total_price'];
                $expiry_date = $item['expiry_date'];

                // Insert order item details into 'order_items' table
                $insert_item_query = "INSERT INTO order_items (order_id, medicine_name, quantity, price_per_unit, total_price, expiry_date)
                                      VALUES (?, ?, ?, ?, ?, ?)";
                $insert_item_stmt = mysqli_prepare($con, $insert_item_query);
                mysqli_stmt_bind_param($insert_item_stmt, 'isidss', $order_id, $medicine_name, $quantity, $price_per_unit, $item_total_price, $expiry_date);
                if (!mysqli_stmt_execute($insert_item_stmt)) {
                    // Log error if there is a problem inserting the order item
                    $_SESSION['msg'] = "Error inserting order item: " . mysqli_error($con);
                    break;
                }
                // Close the prepared statement for each item
                mysqli_stmt_close($insert_item_stmt);
            }

            $_SESSION['msg'] = "Order placed successfully!";
            $order_submitted = true;
        } else {
            // Log error if there is a problem inserting the order
            $_SESSION['msg'] = "Error placing the order: " . mysqli_error($con);
        }

        // Close the prepared statement for order insertion
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Medicine</title>
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
            <style>
                .invoice {
                    margin-top: 30px;
                    padding: 20px;
                    border: 1px solid #ddd;
                    background-color: #f9f9f9;
                }
            </style>
            <div class="main-content">
                <div class="container-fluid">
                    <div class="container">
                        <h1>Order Medicine</h1>

                        <!-- Display Errors -->
                        <?php if (isset($_SESSION['msg'])) { ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
                            </div>
                        <?php } ?>

                        <?php if ($order_submitted): ?>
                            <!-- Display Invoice -->
                            <div class="invoice">
                                <h2>Order Invoice</h2>
                                <p><strong>Order ID:</strong> <?= $order_id; ?></p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Medicine Name</th>
                                            <th>Quantity</th>
                                            <th>Price Per Unit (Rs)</th>
                                            <th>Total Price (Rs)</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_items as $item): ?>
                                            <tr>
                                                <td><?= $item['medicine_name']; ?></td>
                                                <td><?= $item['quantity']; ?></td>
                                                <td><?= $item['price_per_unit']; ?></td>
                                                <td><?= $item['total_price']; ?></td>
                                                <td><?= $item['expiry_date']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total Price</strong></td>
                                            <td colspan="2"><strong><?= number_format($total_price, 2); ?> Rs</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
                            </div>
                        <?php else: ?>
                            <!-- Order Form -->
                            <form method="POST">
                                <div class="form-group">
                                    <label for="medicine_id">Select Medicines</label>
                                    <div id="medicines-container">
                                        <?php $index = 0; ?>
                                        <?php while ($row = mysqli_fetch_assoc($medicines)) { ?>
                                            <div class="medicine-item">
                                                <label>
                                                    <?= $row['name']; ?> (<?= $row['price']; ?> Rs, Available: <?= $row['quantity']; ?>)
                                                </label>
                                                <input type="checkbox" name="medicine_id[]" value="<?= $row['id']; ?>">
                                                <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" min="1" max="<?= $row['quantity']; ?>">
                                            </div>
                                            <hr>
                                            <?php $index++; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <button type="submit" name="place_order" class="btn btn-primary">Place Order</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Dynamically calculate total price
    const medicines = document.querySelectorAll('.medicine-item');
    medicines.forEach(med => {
        const checkbox = med.querySelector('input[type="checkbox"]');
        const qtyInput = med.querySelector('input[type="number"]');
        checkbox.addEventListener('change', calculateTotalPrice);
        qtyInput.addEventListener('input', calculateTotalPrice);
    });

    function calculateTotalPrice() {
        let totalPrice = 0;
        medicines.forEach(med => {
            const cb = med.querySelector('input[type="checkbox"]');
            const qtyInput = med.querySelector('input[type="number"]');
            if (cb.checked && qtyInput.value) {
                const price = parseFloat(med.querySelector('label').textContent.split('(')[1].split(' ')[0]);
                totalPrice += price * parseInt(qtyInput.value, 10);
            }
        });
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }
</script>
</body>
</html>
