<?php
$con = mysqli_connect("localhost", "root", "", "carelink");
if (isset($_POST['btnSubmit'])) {
	$name = $_POST['txtName'];
	$email = $_POST['txtEmail'];
	$contact = $_POST['txtPhone'];
	$message = $_POST['txtMsg'];

	$query = "insert into contact(name,email,contact,message) values('$name','$email','$contact','$message');";
	$result = mysqli_query($con, $query);

	if ($result) {
		echo '<script type="text/javascript">';
		echo 'alert("Message sent successfully!");';
		echo 'window.location.href = "contact.html";';
		echo '</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Carelink- Your Wellness Journey Starts Here</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="health, wellness, appointments, pharmacy" name="keywords">
    <meta content="Carelink connects you with healthcare providers, pharmacies, and wellness services to enhance your health journey." name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet"></head>

  </head>

  <body>

    <!-- Loading Spinner -->
    <div id="spinner" class="show bg-light position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Loading Spinner End -->

    <!-- Header Section -->
    <header class="container-fluid bg-success text-white py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0">Carelink</h1>
                <div>
                    <a href="tel:+1234567890" class="text-white"><i class="bi bi-telephone"></i> +92 333 7626116</a>
                    <a href="mailto:info@Carelink.com" class="text-white ms-3"><i class="bi bi-envelope"></i> info@Carelink.com</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="service.php" class="nav-item nav-link">Services</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pharmacy</a>
                            <div class="dropdown-menu bg-light m-0">
                                <a href="feature.php" class="dropdown-item">Features</a>
                                <a href="team.php" class="dropdown-item">Our Team</a>
                                <a href="pharmacy.php" class="dropdown-item">Medicines</a>
                                <a href="appoinment.php" class="dropdown-item active">Appoinment</a>
                            </div>
                            </div>
                            
                        <a href="login.php" class="nav-item nav-link">Login</a>
                        <a href="contact1.php" class="nav-item nav-link">Contact</a>
                    </div>
        </div>
    </nav>
    <!-- Navigation Bar End -->
     
    <!-- Page Header Start -->
    <div
      class="container-fluid page-header py-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container text-center py-5 mt-4">
        <h1 class="display-2 text-white mb-3 animated slideInDown">Contact</h1>
        <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item" aria-current="page">Contact</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Page Header End -->
    <style>
    /* Contact Form Styles */
.contact-form {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.contact-form h3 {
    color: #343a40;
}

.contact-form .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
}

.contact-form .btnContact {
    background-color: #28a745; /* Green */
    color: white;
}

.contact-form .btnContact:hover {
    background-color: #218838; /* Darker green */
}
</style>
    <!-- Contact Start -->
    <div class="container-fluid py-5">
      <div class="container py-5">
        <div
          class="text-center mx-auto wow fadeInUp"
          data-wow-delay="0.1s"
          style="max-width: 600px"
        >
          <h1 class="display-6 mb-3">
            Have Any Query? Feel Free To Contact Us
          </h1>
          <p class="mb-5">
            We are here to assist you with any questions or concerns you may
            have regarding our services. Your health is our priority.
          </p>
        </div>
        <div class="row contact-info position-relative g-0 mb-5">
          <div class="col-lg-6">
            <a
              href="tel:+92337626116"
              class="d-flex justify-content-lg-center bg-primary p-4"
            >
              <div class="icon-box-light flex-shrink-0">
                <i class="bi bi-phone text-dark"></i>
              </div>
              <div class="ms-3">
                <h5 class="text-white">Call Us</h5>
                <h2 class="text-white mb-0">+012 345 67890</h2>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a
              href="mailto:info@carelink.com"
              class="d-flex justify-content-lg-center bg-primary p-4"
            >
              <div class="icon-box-light flex-shrink-0">
                <i class="bi bi-envelope text-dark"></i>
              </div>
              <div class="ms-3">
                <h5 class="text-white">Mail Us</h5>
                <h2 class="text-white mb-0">info@carelink.com</h2>
              </div>
            </a>
          </div>
        </div>
        <div class="row g-5">
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="contact-form">
              <div class="contact-image">
                <img
                  src="https://image.ibb.co/kUagtU/rocket_contact.png"
                  alt="rocket_contact"
                />
              </div>
              <form method="post" action="contact.php">
                <h3>Drop Us a Message</h3>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input
                        type="text"
                        name="txtName"
                        class="form-control"
                        placeholder="Your Name *"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="email"
                        name="txtEmail"
                        class="form-control"
                        placeholder="Your Email *"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="tel"
                        name="txtPhone"
                        class="form-control"
                        placeholder="Your Phone Number *"
                        minlength="10"
                        maxlength="10"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="submit"
                        name="btnSubmit"
                        class="btnContact"
                        value="Send Message"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea
                        name="txtMsg"
                        class="form-control"
                        placeholder="Your Message *"
                        style="width: 100%; height: 150px"
                        required
                      ></textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
            <iframe
              class="w-100 h-100"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d353199.9999999999!2d74.3587!3d31.5204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919018c1c1c1c1f%3A0x1234567890abcdef!2sLahore%2C%20Pakistan!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
              frameborder="0"
              style="min-height: 300px; border: 0"
              allowfullscreen=""
              aria-hidden="false"
              tabindex="0"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <div
      class="container-fluid footer position-relative bg-dark text-white-50 py-5 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container">
        <div class="row g-5 py-5">
          <div class="col-lg-6 pe-lg-5">
            <a href="index.html" class="navbar-brand">
              <h1 class="h1 text-primary mb-0">
                Care<span class="text-white">Link</span>
              </h1>
            </a>
            <p class="fs-5 mb-4">
              Carelink is dedicated to providing high-quality laboratory
              services, ensuring accurate diagnostics and patient care.
            </p>
            <p>
              <i class="fa fa-map-marker-alt me-2"></i>Raiwind, Lahore, Pakistan
            </p>
            <p><i class="fa fa-phone-alt me-2"></i>+92 333 7626116</p>
            <p><i class="fa fa-envelope me-2"></i>info@carelink.com</p>
            <div class="d-flex mt-4">
              <a class="btn btn-lg-square btn-primary me-2" href="#"
                ><i class="fab fa-twitter"></i
              ></a>
              <a class="btn btn-lg-square btn-primary me-2" href="#"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-lg-square btn-primary me-2" href="#"
                ><i class="fab fa-linkedin-in"></i
              ></a>
              <a class="btn btn-lg-square btn-primary me-2" href="#"
                ><i class="fab fa-instagram"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-6 ps-lg-5">
            <div class="row g-5">
              <div class="col-sm-6">
                <h4 class="text-light mb-4">Quick Links</h4>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
                <a class="btn btn-link" href="">Our Services</a>
                <a class="btn btn-link" href="">Terms & Condition</a>
                <a class="btn btn-link" href="">Support</a>
              </div>
              <div class="col-sm-6">
                <h4 class="text-light mb-4">Popular Links</h4>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
                <a class="btn btn-link" href="">Our Services</a>
                <a class="btn btn-link" href="">Terms & Condition</a>
                <a class="btn btn-link" href="">Support</a>
              </div>
              <div class="col-sm-12">
                <h4 class="text-light mb-4">Newsletter</h4>
                <div class="w-100">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control border-0 py-3 px-4"
                      style="background: rgba(255, 255, 255, 0.1)"
                      placeholder="Your Email Address"
                    />
                    <button class="btn btn-primary px-4">Sign Up</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <div class="container-fluid copyright bg-dark text-white-50 py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start">
            <p class="mb-0">
              &copy; <a href="#">Carelink Healthcare</a>. All Rights Reserved.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Back to Top -->
    <a
      href="#"
      class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>
