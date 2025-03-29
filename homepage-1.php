<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. John The Baptist Parochial School - Admission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background-color: #4a90e2;
            color: white;
            padding: 10px 0;
            position: relative;
        }
        .logo-text {
            font-weight: bold;
            font-size: 1rem;
        }
        
        /* Responsive Logo and School Name */
        .logo-container {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .logo-text {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .logo-text {
                display: inline !important;
                font-size: 0.7rem;
            }
        }
        
        /* Navigation Styles */
        .top-links {
            font-size: 0.9rem;
        }
        .top-links a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .top-links a:hover {
            opacity: 0.8;
        }

        /* Responsive Navigation */
        .navbar-toggler {
            color: white;
            border: none;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Social Media Icons */
        .social-media-container {
            background-color: #4a90e2;
            padding: 20px;
            color: white;
        }

        .social-media-icons {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: white;
            color: #4a90e2;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .social-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 8px rgba(0,0,0,0.2);
        }

        .social-icon i {
            font-size: 30px;
        }

        .social-icon.facebook:hover {
            color: #3b5998;
        }

        .social-icon.instagram:hover {
            color: #e1306c;
        }

        /* Mobile Styles */
        @media (max-width: 991px) {
            .top-links {
                display: none;
            }
            .navbar-toggler {
                display: block !important;
            }
            .mobile-menu {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: #4a90e2;
                z-index: 1000;
                display: none;
            }
            .mobile-menu.show {
                display: block;
            }
            .mobile-menu a {
                color: white;
                display: block;
                padding: 15px;
                text-decoration: none;
                border-top: 1px solid rgba(255,255,255,0.1);
            }
            .mobile-menu a:first-child {
                border-top: none;
            }
            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }
        }

        /* Desktop Styles */
        @media (min-width: 992px) {
            .navbar-toggler {
                display: none !important;
            }
            .mobile-menu {
                display: none !important;
            }
        }

        /* Existing styles */
        .banner {
            position: relative;
            background-color: white;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .call-to-action {
            text-align: center;
            margin: 40px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .enroll-btn {
            background-color: #25478a;
            color: white;
            padding: 8px 25px;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .enroll-btn:hover {
            background-color: #1a365d;
            color: white;
        }
        .mission-vision {
            background-color: #4a90e2;
            color: white;
            border-radius: 10px;
            margin-top: 20px;
            padding: 20px;
        }
        .mission-vision-box {
            background-color: white;
            color: black;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .mission-vision-box:hover {
            transform: translateY(-5px);
        }

        /* Footer Styles */
        .footer {
            background-color: #4a90e2;
            color: white;
            padding: 20px 0;
            margin-top: 20px;
        }
        @media (max-width: 767px) {
            .footer .row {
                text-align: center;
            }
        }
        .enrollment-highlight {
            background-color: #f8f9fa;
            border-left: 4px solid #4a90e2;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 0 5px 5px 0;
        }
        .procedure-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            transition: box-shadow 0.3s;
        }
        .procedure-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .call-to-action {
            text-align: center;
            margin: 40px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header position-relative">
        <div class="container">
            <div class="header-content d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="images/logo/st-johns-logo.png" alt="School Logo" width="75" class="me-2">
                    <span class="logo-text d-md-inline logo-container">ST. JOHN THE BAPTIST PAROCHIAL SCHOOL</span>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="top-links d-none d-lg-flex flex-wrap justify-content-end">
                    <a href="#procedures" class="me-2 mb-2"><i class="fas fa-list-ul me-1"></i> Enrollment Procedures</a>
                    <a href="admission-form.php" class="me-2 mb-2"><i class="fas fa-pen-to-square me-1"></i> Enroll Now</a>
                    <a href="login.php" class="me-2 mb-2"><i class="fas fa-sign-in-alt me-1"></i> Log In</a>
                </div>
                
                <!-- Mobile Hamburger Menu -->
                <button class="navbar-toggler d-lg-none" type="button" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
                </button>
            </div>
            
            <!-- Mobile Menu Dropdown -->
            <div class="mobile-menu">
                <a href="#procedures"><i class="fas fa-list-ul me-2"></i>Enrollment Procedures</a>
                <a href="admission-form.php"><i class="fas fa-pen-to-square me-2"></i>Enroll Now</a>
                <a href="login.php"><i class="fas fa-sign-in-alt me-2"></i>Log In</a>
            </div>
        </div>
    </div>

    <!-- Banner Carousel -->
    <div id="bannerCarousel" class="carousel slide container banner" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/carousel/banner1.jpeg" alt="Banner 1" class="d-block w-100 rounded" style="height: 50vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/banner2.png" alt="Banner 2" class="d-block w-100 rounded" style="height: 50vh; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/banner3.jpg" alt="Banner 3" class="d-block w-100 rounded" style="height: 50vh; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Call to Action -->
    <div class="container call-to-action">
        <h2>Shape Your Future with Quality Catholic Education</h2>
        <p class="mb-4">St. John The Baptist Parochial School offers a comprehensive learning experience that combines academic excellence, Christian values, and 21st century skills.</p>
        <a href="admission-form.php" class="enroll-btn"><i class="fas fa-graduation-cap me-2"></i>Start Your Journey Today</a>
    </div>

    <!-- Mission Vision -->
    <div class="container mission-vision">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="mission-vision-box">
                    <h3><i class="fas fa-bullseye me-2"></i>Mission</h3>
                    <p>The St. John the Baptist Parochial School commits itself as a living witness of Christ and as an agent of quality Catholic education in response to the mission of the Church by proclaiming the Gospel Values and providing 21st century competencies to the Johannine community through the spirit of St. sJohn.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mission-vision-box">
                    <h3><i class="fas fa-eye me-2"></i>Vision</h3>
                    <p>The St. John Baptist Parochial School envisions itself as globally academic competent community that embodies Christ's teachings.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Procedures -->
    <div id="procedures" class="container procedures">
        <h2 class="text-center mb-4">ENROLLMENT PROCEDURES</h2>
        
        <div class="enrollment-highlight">
            <h5><i class="fas fa-info-circle me-2"></i>Important Information</h5>
            <p>Enrollment for the Academic Year 2025-2026 is now open. Early registrants can avail of special discounts and privileges. Senior High School applicants enjoy 100% FREE TUITION!</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="procedure-card">
                    <h4 class="procedure-title"><i class="fas fa-user-plus me-2"></i>For Transferee/New Students</h4>
                    <ol>
                        <li>Accomplish the online admission form at <a href="https://bit.ly/sjbps25" target="_blank">https://bit.ly/sjbps25</a> or you may visit the school office to fill out the admission form.</li>
                        <li>Submit the initial requirements at the Registrar's Office:
                            <ul>
                                <li>Original and Photocopy of Birth Certificate</li>
                                <li>Copy of Latest Report Card</li>
                                <li>Recent 2×2 ID Picture (2 pcs)</li>
                                <li>Good Moral Certificate</li>
                            </ul>
                        </li>
                        <li>The Guidance Counselor and/or the Academic Coordinator will conduct an assessment/interview of the student applicant.</li>
                        <li>Submit the other requirements for the official registration.</li>
                        <li>Pay the necessary fees at the Cashier's or Finance Office.</li>
                        <li>Check the school's official social media accounts for the latest announcements.</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-6">
                <div class="procedure-card">
                    <h4 class="procedure-title"><i class="fas fa-user-check me-2"></i>For Old Students</h4>
                    <ol>
                        <li>Accomplish the online admission form at <a href="https://bit.ly/sjbps25" target="_blank">https://bit.ly/sjbps25</a> or you may visit the school office to fill out the admission form.</li>
                        <li>Proceed to the registrar's section to secure a permit to enroll.</li>
                        <li>Proceed to the Finance section for payment.</li>
                        <li>Submit the other requirements for the official registration.</li>
                        <li>Check the school's official social media accounts for the latest announcements.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-3">
                        <img src="images/logo/st-johns-logo.png" alt="School Logo" width="75" class="me-2">
                        <span class="logo-text">ST. JOHN THE BAPTIST PAROCHIAL SCHOOL</span>
                    </div>
                    <div class="footer-text text-center text-md-start">
                        <p><i class="fas fa-map-marker-alt me-2"></i><a href="https://www.google.com/maps?q=Sumulong+Street+San+Isidro+Taytay+Rizal" target="_blank" style="color: white; text-decoration: none;">Sumulong Street, Brgy. San Isidro, Taytay, Rizal Philippines</a></p>
                        <p><i class="fas fa-envelope me-2"></i><a href="mailto:sjbps_10@yahoo.com" style="color: white; text-decoration: none;">sjbps_10@yahoo.com</a></p>
                        <p><i class="fas fa-phone me-2"></i><a href="tel:+63282965896" style="color: white; text-decoration: none;">(+632) 8296-5896</a> | <a href="tel:+639201225764" style="color: white; text-decoration: none;">0920 122 5764</a></p>
                    </div>
                </div>
                
                <div class="col-md-4 offset-md-4 text-center text-md-end">
                    <div class="social-media-container">
                        <h5 class="mb-3">Follow Us</h5>
                        <div class="social-media-icons">
                            <a href="https://www.facebook.com/sjbps2003" class="social-icon facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/sjbps2003" class="social-icon instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p>© 2025 St. John The Baptist Parochial School. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.navbar-toggler');
            const mobileMenu = document.querySelector('.mobile-menu');

            hamburger.addEventListener('click', function() {
                mobileMenu.classList.toggle('show');
                this.classList.toggle('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!hamburger.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.remove('show');
                    hamburger.classList.remove('active');
                }
            });

            // Prevent mobile menu from closing when clicking inside it
            mobileMenu.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
</body>
</html>