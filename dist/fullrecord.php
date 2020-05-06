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
// Getting user submitted data from search.php

$koraID = $_REQUEST['koraID'];
//$keywords = explode(" ", $_REQUEST['keywords']);

include 'functions.php';

// Turning kid into an array

$idArray = array($koraID);

$kidQuery = kidQueryBuilder($idArray);

//if ($keywords == array("")) {
$queries = array($kidQuery);
//$queries = json_encode($queries);
//} else {
//    $keywordQuery = keywordQueryBuilder($keywords, "AND");
//   $queries = array($kidQuery, $keywordQuery);
//}

$data = formSearchBuilder($fid, $token, $flags, $fieldValues, $queries);

//$data = array_walk_recursive($data, function (&$entry) { $entry = mb_convert_encoding($entry,'UTF-8'); });

$array = array();
//json_encode($data);
$array["forms"] = json_encode(array($data));
//$array["format"] = "JSON";

// var_dump($array);
$record = getData($array);
//echo "--------------";
//var_dump($record);
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
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Full Record Content -->
<section id="portfolio" class="bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 offset-md-0 text-center">
                    <h2 class="text-uppercase section-heading">Full Record</h2>
                    <!-- <h3 class="section-subheading text-muted">Full Record Page</h3> -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-5 col-xl-5 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"></div>
                        </div>
                        <?php
                        $imageName = $record[0][$koraID]['Image'][0]['name'];
                        grab_image("temp.jpg",$koraID,$imageName);
                        ?>
                        <img class="img-fluid" src="temp.jpg"></a>
                    <div class="text-left portfolio-caption">
                        <h4>Asset Image</h4>
                        <p class="text-muted">(click image for metadata)</p>
                        <?php
                        //print_r($record) // Check out the array data coming in?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-7 col-xl-7 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal6"></a>
                    <div class="text-left portfolio-caption">
                        <h3>Identification</h3>
                        <p class="text-left text-muted"><strong>Asset ID: </strong><?php echo $record[0][$koraID]['Asset ID']; ?></p>
                        <p class="text-left text-black-50 text-muted"><strong>Collection:</strong> Schmidt Collection</p>
                    </div>
                    <div class="portfolio-caption">
                        <h4 class="text-left">Description</h4>
                        <p class="text-left text-muted"> <strong>Description:</strong> <?php echo $record[0][$koraID]['Description']; ?></p>
                        <p class="text-left text-muted"><strong>General Type:</strong> <?php echo $record[0][$koraID]['General Type']; ?></p>
                        <p class="text-left text-muted"><strong>Specific Type:</strong> <?php echo $record[0][$koraID]['Heritage Asset Type'][0]; ?></p>
                    </div>
                    <div class="portfolio-caption">
                        <h4 class="text-left">Provenance&nbsp;</h4>
                        <p class="text-left text-muted"><strong>Time Period: </strong><?php echo $record[0][$koraID]['Period Name']; ?></p>
                        <p class="text-left text-muted"><strong>Cultural Affiliation:&nbsp;</strong><?php echo $record[0][$koraID]['Cultural Affiliations']; ?></p>
                        <p class="text-left text-muted"><strong>Date:&nbsp;</strong><?php echo $record[0][$koraID]['Display Date']; ?></p>
                        <p class="text-left text-muted"><strong>Site:</strong> <?php echo $record[0][$koraID]['Name Site']; ?></p>
                    </div>
                    <div class="portfolio-caption">
                        <h4 class="text-left">Copyright</h4>
                        <p class="text-left text-muted"><strong>Heritage Asset Copyright:</strong> <?php echo $record[0][$koraID]['Copyright Credit Line']; ?></p>
                        <p class="text-left text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Image Pop-up Module -->
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase"><?php echo $imageName; // $record[0][$koraID]['Image'][0]['name'];?></h2>
                                    <p class="item-intro text-muted"></p><img class="img-fluid d-block mx-auto" src="temp.jpg">
                                    <ul class="list-inline">
                                        <li><strong>Image Caption: </strong><?php $caption = $record[0][$koraID]['Image'][0]['caption'];
                                            if (empty($caption)) {
                                                echo "(no caption)";
                                            } else {
                                                echo $caption;
                                                }
                                            ?> </li>
                                        <li><strong>Image Date: </strong><?php echo $record[0][$koraID]['Image'][0]['timestamp'];?> (working on timestamp converter)</li>
                                        <li><strong>Image Size: </strong><?php echo $record[0][$koraID]['Image'][0]['size'];?></li>
                                        <li><strong>Image Type: </strong><?php echo $record[0][$koraID]['Image'][0]['type'];?></li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer-->
<footer class="footer py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"></span></div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">MSU Archaeology Digital Collections</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://chi.franc230.msu.domains/" property="cc:attributionName" rel="cc:attributionURL">Zach Francis</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
