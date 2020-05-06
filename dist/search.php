<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MSU Archaeology Collections</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<?php
    include 'functions.php';
    $data = formSearchBuilder($fid, $token, $flags, $fieldValues, null);
    $array = array();
    $array["forms"] = json_encode(array($data));

    $record = getData($array);
?>
<body id="page-top">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.html">Home</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="search.php">Search</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="browse.php">Browse</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#kidrecords">available searches</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--masthead -->
<header class="masthead">
    <div class="container">
        <div class="masthead-subheading"><form action="fullrecord.php" method="post">
                <!-- <label for="koraID">Search:</label> -->
                <input type="text" name="koraID" id="koraID" required>
                <br>
                <br>
                <!-- <label for="keywords">Keywords:</label>
                <input type="text" name="keywords" id="keywords">
                <br> -->
                <input type="submit">
            </form></div>
        <div>
            <br>
        </div>
        <div class="text-center">
            <h4 class="section-heading text-uppercase">*Only Kora ID searches currently available.</h4>
            <h4> Check Below for a catalog of available Kora IDs, or browse the catalog. </h4>
            <h4> And please come back to see how the site improves! (Updated: 5/4/2020)</h4>
        </div>
            <!-- <div class="masthead-heading text-uppercase"></div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="browse.php">Browse our Records</a> -->
    </div>
</header>

    <section class="page-section bg-light" id="kidrecords">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">About</h2>
                <h3 class="text-muted section-subheading">Here is a list of all Kora Records</h3>
                    <h4><?php

                        print_r($record);
                        $kidAvailable = array_keys($record[0]);

                        print_r($kidAvailable);

                        echo "<br>";

                        foreach($kidAvailable as $item) {
                            //$imageName = $record[0][$item]['Image'][0]['name'];
                            //$file = $item['Asset ID'] . ".jpg";
                            //grab_image($file,$item,$imageName); // Putting the image in
                            echo "<img class=\"img-fluid\" src=\"temp.jpg\"></a>";
                            echo "<strong>KID: </strong>" . $item . " | ";
                            echo "<strong>Asset ID: </strong>" . $record[0][$item]['Asset ID'] . " | ";
                            echo "<strong>Site:</strong> " . $record[0][$item]['Name Site'] . " | ";
                            echo "<strong>Asset Type: </strong>" . $record[0][$item]['General Type'] . "<br>";
                            //unlink($file);
                        }

                    ?>

            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer py-4 bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-left"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"></div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-right">MSU Archaeology Digital Collections</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://chi.franc230.msu.domains/" property="cc:attributionName" rel="cc:attributionURL">Zach Francis</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</div>
            </div>
        </div>
    </footer>
