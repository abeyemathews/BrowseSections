<?php

// Initialize the variables
$aboutTitle = "";
$aboutSubtitle = "";

// Initialize the $aboutItems variable as an empty array
$aboutItems = array();
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'landing_page_db';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch SEO data from the database
$sql = "SELECT * FROM seo_data LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $seoData = $result->fetch_assoc();
    $meta_keywords = $seoData['meta_keywords'];
    $meta_description = $seoData['meta_description'];
} else {
    // Set default values if no SEO data found
    $meta_keywords = 'default, keywords';
    $meta_description = 'Default meta description';
}

// Fetch page data from the database
$sql = "SELECT * FROM page_data LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $pageData = $result->fetch_assoc();
    $page_title = $pageData['page_title'];
    $banner_heading = $pageData['banner_heading'];
    $banner_subheading = $pageData['banner_subheading'];
    $cta_button_text = $pageData['cta_button_text'];
} else {
    // Set default values if no page data found
    $page_title = 'Default Page Title';
    $banner_heading = 'Default Banner Heading';
    $banner_subheading = 'Default Banner Subheading';
    $cta_button_text = 'Default CTA Button Text';
}

// Fetch menu items from the database
$menuItems = array();
$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

// Query to fetch image paths from the database
$sql = "SELECT image_path FROM gallery_images";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $imageData = array();

    // Fetch image paths from the result and store them in the $imageData array
    while ($row = mysqli_fetch_assoc($result)) {
        $imageData[] = $row['image_path'];
    }
}

// Query to fetch testimonial data from the database
$sql = "SELECT quote, author FROM testimonials";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $testimonials = array();

    // Fetch testimonial data from the result and store them in the $testimonials array
    while ($row = mysqli_fetch_assoc($result)) {
        $testimonials[] = array(
            'quote' => $row['quote'],
            'author' => $row['author']
        );
    }
}


// Query to fetch testimonial data from the database
$sql = "SELECT image, quote, author FROM customer_feedback";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $testimonials = array();

    // Fetch testimonial data from the result and store them in the $testimonials array
    while ($row = mysqli_fetch_assoc($result)) {
        $testimonials[] = array(
            'image' => $row['image'],
            'quote' => $row['quote'],
            'author' => $row['author']
        );
    }
}



// Query to fetch company data from the database
$sql = "SELECT logo, name FROM client_companies";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $companies = array();

    // Fetch company data from the result and store them in the $companies array
    while ($row = mysqli_fetch_assoc($result)) {
        $companies[] = array(
            'logo' => $row['logo'],
            'name' => $row['name']
        );
    }
}


// Query to fetch pricing package data from the database
$sql = "SELECT name, description, price, features FROM pricing_packages";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $pricingPackages = array();

    // Fetch pricing package data from the result and store them in the $pricingPackages array
    while ($row = mysqli_fetch_assoc($result)) {
        $pricingPackages[] = $row;
    }
}

// Query to fetch social media links from the database
$sql = "SELECT platform, link FROM social_media_links";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $socialMediaLinks = array();

    // Fetch social media links from the result and store them in the $socialMediaLinks array
    while ($row = mysqli_fetch_assoc($result)) {
        $socialMediaLinks[] = $row;
    }
}

// Query to fetch features from the database
$sql = "SELECT title, description FROM features";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $features = array();

    // Fetch features from the result and store them in the $features array
    while ($row = mysqli_fetch_assoc($result)) {
        $features[] = $row;
    }
}

// Get the current page URL without query parameters
$currentURL = strtok($_SERVER["REQUEST_URI"], '?');
// Close the database connection



$conn->close();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <!--Page Title-->
    <title><?php echo $page_title; ?></title>

    <!--Meta Keywords and Description-->
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" title="Favicon"/>

    <!-- Main CSS Files -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Namari Color CSS -->
    <link rel="stylesheet" href="css/namari-color.css">

    <!--Icon Fonts - Font Awesome Icons-->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Animate CSS-->
    <link href="css/animate.css" rel="stylesheet" type="text/css">

    <!--Google Webfonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status" class="la-ball-triangle-path">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!--End of Preloader-->

<div class="page-border" data-wow-duration="0.7s" data-wow-delay="0.2s">
    <div class="top-border wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"></div>
    <div class="right-border wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;"></div>
    <div class="bottom-border wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>
    <div class="left-border wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>
</div>

<div id="wrapper">

<header id="banner" class="scrollto clearfix" data-enllax-ratio=".5">
            <div id="header" class="nav-collapse">
                <div class="row clearfix">
                    <div class="col-1">

                        <!--Logo-->
                        <div id="logo">
                            <!-- ... Your existing logo content ... -->
                        </div>
                        <!--End of Logo-->

                        <aside>
                            <!-- ... Your existing social icons content ... -->
                        </aside>

                        <!--Main Navigation-->
                        <nav id="nav-main">
                            <ul>
                                <?php
                                // Loop through the menu items to generate the navigation links
                                foreach ($menuItems as $menuItem) {
                                    $title = $menuItem['title'];
                                    $url = $menuItem['url'];

                                    // Check if the current URL matches the menu item URL
                                    $active_class = ($currentURL == '/' . $url) ? 'active' : '';
                                    echo "<li><a href=\"/$url\" class=\"$active_class\">$title</a></li>";
                                }
                                ?>
                            </ul>
                        </nav>
                        <!--End of Main Navigation-->

                        <div id="nav-trigger"><span></span></div>
                        <nav id="nav-mobile"></nav>

                    </div>
                </div>
            </div><!--End of Header-->

            <!--Banner Content-->
            <div id="banner-content" class="row clearfix">
                <div class="col-38">
                    <div class="section-heading">
                        <h1>A FREE AND SIMPLE LANDING PAGE</h1>
                        <h2>Namari is a free landing page template you can use for your projects. It is free to use for your
                            personal and commercial projects, enjoy!</h2>
                    </div>
                    <!--Call to Action-->
                    <a href="#" class="button">START CREATING TODAY</a>
                    <!--End Call to Action-->
                </div>
            </div><!--End of Row-->
        </header>
    <!--Banner Content-->
    <div id="banner-content" class="row clearfix">
        <div class="col-38">
            <div class="section-heading">
                <h1><?php echo $banner_heading; ?></h1>
                <h2><?php echo $banner_subheading; ?></h2>
            </div>
            <!--Call to Action-->
            <a href="#" class="button"><?php echo $cta_button_text; ?></a>
            <!--End Call to Action-->
        </div>
    </div>
    <!--End Banner Content-->

    <!--Main Content Area-->
    <!-- ... -->

    <!--Footer-->
    <!-- ... -->

</div>

<main id="content">
<section id="about" class="introduction scrollto">
    <div class="row clearfix">
        <div class="col-3">
            <div class="section-heading">
                <h3>SUCCESS</h3>
                <h2 class="section-title">How We Help You To Sell Your Product</h2>
                <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam!</p>
            </div>
        </div>

        <div class="col-2-3">
            <?php
            // Display the fetched features in the Introduction section
            if (!empty($features)) {
                foreach ($features as $feature) {
                    echo '<div class="col-2 icon-block icon-top wow fadeInUp" data-wow-delay="0.1s">';
                    echo '<div class="icon"><i class="fa fa-html5 fa-2x"></i></div>';
                    echo '<div class="icon-block-description">';
                    echo '<h4>' . $feature['title'] . '</h4>';
                    echo '<p>' . $feature['description'] . '</p>';
                    echo '</div></div>';
                }
            }
            ?>
        </div>
    </div>
</section>
<!--End of Introduction-->

<aside id="gallery" class="row text-center scrollto clearfix" data-featherlight-gallery data-featherlight-filter="a">
    <?php
    // Display the fetched image paths in the dynamic image gallery
    if (!empty($imageData)) {
        foreach ($imageData as $imagePath) {
            echo '<a href="' . $imagePath . '" data-featherlight="image" class="col-3 wow fadeIn">';
            echo '<img src="' . $imagePath . '" alt="Landing Page"/>';
            echo '</a>';
        }
    }
    ?>
</aside>
<div id="services" class="scrollto clearfix">
    <div class="row no-padding-bottom clearfix">
        <!--Content Left Side-->
        <div class="col-3">
            <?php
            // Display the fetched testimonials in the dynamic content section
            if (!empty($testimonials)) {
                foreach ($testimonials as $testimonial) {
                    echo '<blockquote class="testimonial text-right bigtest">';
                    echo '<q>' . $testimonial['quote'] . '</q>';
                    echo '<footer>— ' . $testimonial['author'] . ', Happy Customer</footer>';
                    echo '</blockquote>';
                }
            }
            ?>
        </div>
        <!--End Content Left Side-->

        <!--Content of the Right Side-->
        <div class="col-3">
            <!-- Rest of the static content goes here -->
            <div class="section-heading">
                <h3>BELIEVING</h3>
                <h2 class="section-title">Focusing On What Matters Most</h2>
                <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam!</p>
            </div>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet!</p>
            <!-- Just replace the Video ID "UYJ5IjBRlW8" with the ID of your video on YouTube (Found within the URL) -->
            <a href="#" data-videoid="UYJ5IjBRlW8" data-videosite="youtube" class="button video link-lightbox">
                WATCH VIDEO <i class="fa fa-play" aria-hidden="true"></i>
            </a>
        </div>
        <!--End Content Right Side-->

        <div class="col-3">
            <img src="images/dancer.jpg" alt="Dancer"/>
        </div>
    </div>
</div>

<!--Testimonials-->
<aside id="testimonials" class="scrollto text-center" data-enllax-ratio=".2">
    <div class="row clearfix">
        <div class="section-heading">
            <h3>FEEDBACK</h3>
            <h2 class="section-title">What our customers are saying</h2>
        </div>

        <?php
        // Display the fetched testimonials in the dynamic testimonial section
        if (!empty($testimonials)) {
            foreach ($testimonials as $testimonial) {
                echo '<blockquote class="col-3 testimonial classic">';
                echo '<img src="images/user-images/' . $testimonial['image'] . '" alt="User"/>';
                echo '<q>' . $testimonial['quote'] . '</q>';
                echo '<footer>' . $testimonial['author'] . ' - Happy Customer</footer>';
                echo '</blockquote>';
            }
        }
        ?>

    </div>
</aside>
<!--End of Testimonials-->

<!--Clients-->
<section id="clients" class="scrollto clearfix">
    <div class="row clearfix">
        <div class="col-3">
            <div class="section-heading">
                <h3>TRUST</h3>
                <h2 class="section-title">Companies who use our services</h2>
                <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam!</p>
            </div>
        </div>

        <div class="col-2-3">
            <?php
            // Display the fetched companies in the dynamic clients section
            if (!empty($companies)) {
                foreach ($companies as $company) {
                    echo '<a href="#" class="col-3">';
                    echo '<img src="images/company-images/' . $company['logo'] . '" alt="' . $company['name'] . '"/>';
                    echo '<div class="client-overlay"><span>' . $company['name'] . '</span></div>';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
</section>
<!--End of Clients-->

<!--Pricing Tables-->
<section id="pricing" class="secondary-color text-center scrollto clearfix">
    <div class="row clearfix">
        <div class="section-heading">
            <h3>YOUR CHOICE</h3>
            <h2 class="section-title">We have the right package for you</h2>
        </div>

        <?php
        // Display the fetched pricing package data in the dynamic pricing tables section
        if (!empty($pricingPackages)) {
            foreach ($pricingPackages as $package) {
                echo '<div class="pricing-block col-3 wow fadeInUp" data-wow-delay="0.4s">';
                echo '<div class="pricing-block-content">';
                echo '<h3>' . $package['name'] . '</h3>';
                echo '<p class="pricing-sub">' . $package['description'] . '</p>';
                echo '<div class="pricing">';
                echo '<div class="price"><span>$</span>' . number_format($package['price'], 2) . '</div>';
                echo '<p>' . $package['description'] . '</p>';
                echo '</div>';
                echo '<ul>';
                $features = explode(', ', $package['features']);
                foreach ($features as $feature) {
                    echo '<li>' . $feature . '</li>';
                }
                echo '</ul>';
                echo '<a href="#" class="button">BUY TODAY</a>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

    </div>
</section>
<!--End of Pricing Tables-->

</main>
<footer id="landing-footer" class="clearfix">
    <div class="row clearfix">

        <p id="copyright" class="col-2">Made with love by <a href="https://www.shapingrain.com">ShapingRain</a></p>

        <!--Social Icons in Footer-->
        <ul class="col-2 social-icons">
            <?php
            // Display the fetched social media links in the footer
            if (!empty($socialMediaLinks)) {
                foreach ($socialMediaLinks as $link) {
                    echo '<li>';
                    echo '<a target="_blank" title="' . $link['platform'] . '" href="' . $link['link'] . '">';
                    echo '<i class="fa fa-' . strtolower($link['platform']) . ' fa-1x"></i><span>' . $link['platform'] . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
        <!--End of Social Icons in Footer-->
    </div>
</footer>
<!-- Include JavaScript resources -->
<script src="js/jquery.1.8.3.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/featherlight.min.js"></script>
<script src="js/featherlight.gallery.min.js"></script>
<script src="js/jquery.enllax.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.stickyNavbar.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/images-loaded.min.js"></script>
<script src="js/lightbox.min.js"></script>
<script src="js/site.js"></script>


</body>
</html>
