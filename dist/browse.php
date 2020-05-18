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
    <!-- Fancy Box CSS -->
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
</head>
<?php
// Getting user submitted data from search.php

//$koraID = $_REQUEST['searchResults'];
//$initialKeyword = explode(" ", $_REQUEST['keyWords']);
//$keywords = array();
//foreach ($initialKeyword as $key => $value) {
//    $keywords[]=$value;
//}

include 'functions.php';
if (!empty($_REQUEST['keyWords'])) {
    $keywords=$_REQUEST['keyWords'];
    $keywordQuery = keywordQueryBuilder("$keywords", "OR");
    $queries = array($keywordQuery);
} else {
    $queries=null;
}

// Turning kid into an array

//$idArray = array($koraID);

//$kidQuery = kidQueryBuilder($idArray);

//if ($keywords == array("")) {
//$queries = array($kidQuery);
//$queries = json_encode($queries);
//} else {
    //   $keywordQuery = keywordQueryBuilder("$keywords", "OR");
    //     $queries = array($keywordQuery);
//}

$data = formSearchBuilder($fid, $token, $flags, $browserFieldValues, $queries);

$array = array();
$array["forms"] = json_encode(array($data));

$results = getData($array);

$totalRecords = count($results[0]);

?>

<body id="page-top">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.html">Home</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="search.php">Search</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Browse</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Masthead-->
<header class="masthead2">
    <div class="container">
        <div class="masthead-heading masthead-subheading">Browse</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">Random Set of records</a>
    </div>
</header>

<!-- Browsing Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- <h2 class="text-uppercase section-heading">Browse</h2> -->
                <?php // print_r($keywords); echo "<br>"; print_r($queries); echo "<br>";echo $array["forms"];?>
                <h3 class="section-subheading text-muted">Browser is still being improved, but <?php echo $totalRecords; ?> record(s) resulted for your query of <?php
                if (!empty($_REQUEST['keyWords'])) {
                    echo "\"$keywords\"";
                } else {
                    echo "all records";
                } ?>!</h3>
                <br>
                <?php //print_r($results); echo "<br>";
                ?>
            </div>
        </div>

        <!-- Fancy Box - Row 1-->
        <?php
        //$koraID = '7-16-62';
        //$caption = $results[0][$koraID]['Images'][0]['caption'];
        //$name = $results[0][$koraID]['name'];
        //$asset = $results[0][$koraID]['Asset ID'];
        //$description = $results[0][$koraID]['Description'];
        //$type = $results[0][$koraID]['Heritage Asset Type'];
        //$affiliation = $results[0][$koraID]['Cultural Affiliations'];
        //$imageName = $results[0][$koraID]['Images'][0]['name'];
        //$tempName = "temp2.jpg";
        $i = 1; ?>


        <div class="row">
            <?php foreach (array_splice($results[0],0,3) as $browse) {

                $koraID = $browse['kid'];
                $caption = $browse['Images'][0]['caption'];
                //$name = $results[0][$koraID]['name'];
                $asset = $browse['Asset ID'];
                $description = $browse['Description'];
                $type = $browse['Heritage Asset Type'];
                $affiliation = $browse['Cultural Affiliations'];
                $imageName = $browse['Images'][0]['name'];
                $tempName = "temp" . "$i" . ".jpg";

                grab_image($tempName,$koraID,$imageName);
                ?>
            <div class="col-sm-6 col-md-4 portfolio-item">
                <a href="<?php echo $tempName;?>" class="portfolio-link" data-fancybox="gallery" data-caption="<?php
                echo "<strong> Description: </strong>";
                if (!empty($description)) { echo $description;} else { echo "(No Description Available)";}
                echo "<br>" . "<strong>Type: </strong>";
                foreach($type as $item){echo $item . " ";}
                echo "<br>" . "<strong>Cultural Affiliations: </strong>";
                foreach($affiliation as $item){echo $item . " ";}
                ?>">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                    </div><img class="img-fluid" src="<?php echo $tempName;?>" alt="" /> </a>
                <div class="portfolio-caption">
                    <h4><?php echo $asset;//if(!empty($name)) { echo $name;} else { echo $asset;}?></h4>
                    <form method="post" action="fullrecord.php" class="inline">
                        <input type="hidden" name="extra_submit_param" value="<?php echo $koraID;?>">
                        <button type="submit" name="koraID" value="<?php echo $koraID;?>" class="btn btn-secondary">Full Record Page</button>
                    </form>
                </div>
            </div>
            <?php $i++;
            }?>

          <!-- Fancy Box Row 2 -->
            <?php foreach (array_splice($results[0],0,3) as $browse) {

                $koraID = $browse['kid'];
                $caption = $browse['Images'][0]['caption'];
                //$name = $results[0][$koraID]['name'];
                $asset = $browse['Asset ID'];
                $description = $browse['Description'];
                $type = $browse['Heritage Asset Type'];
                $affiliation = $browse['Cultural Affiliations'];
                $imageName = $browse['Images'][0]['name'];
                $tempName = "temp" . "$i" . ".jpg";

                grab_image($tempName,$koraID,$imageName);
                ?>
                <div class="col-sm-6 col-md-4 portfolio-item">
                    <a href="<?php echo $tempName;?>" class="portfolio-link" data-fancybox="gallery" data-caption="<?php
                    echo "<strong> Description: </strong>";
                    if (!empty($description)) { echo $description;} else { echo "(No Description Available)";}
                    echo "<br>" . "<strong>Type: </strong>";
                    foreach($type as $item){echo $item . " ";}
                    echo "<br>" . "<strong>Cultural Affiliations: </strong>";
                    foreach($affiliation as $item){echo $item . " ";}
                    ?>">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="<?php echo $tempName;?>" alt="" /> </a>
                    <div class="portfolio-caption">
                        <h4><?php echo $asset;//if(!empty($name)) { echo $name;} else { echo $asset;}?></h4>
                        <form method="post" action="fullrecord.php" class="inline">
                            <input type="hidden" name="extra_submit_param" value="<?php echo $koraID;?>">
                            <button type="submit" name="koraID" value="<?php echo $koraID;?>" class="btn btn-secondary">Full Record Page</button>
                        </form>
                    </div>
                </div>
                <?php $i++;
            } ?>


    <!-- Fancy Box 3rd Row -->
                <?php foreach (array_splice($results[0],0,3) as $browse) {

                    $koraID = $browse['kid'];
                    $caption = $browse['Images'][0]['caption'];
                    //$name = $results[0][$koraID]['name'];
                    $asset = $browse['Asset ID'];
                    $description = $browse['Description'];
                    $type = $browse['Heritage Asset Type'];
                    $affiliation = $browse['Cultural Affiliations'];
                    $imageName = $browse['Images'][0]['name'];
                    $tempName = "temp" . "$i" . ".jpg";

                    grab_image($tempName,$koraID,$imageName);
                    ?>
                    <div class="col-sm-6 col-md-4 portfolio-item">
                        <a href="<?php echo $tempName;?>" class="portfolio-link" data-fancybox="gallery" data-caption="<?php
                        echo "<strong> Description: </strong>";
                        if (!empty($description)) { echo $description;} else { echo "(No Description Available)";}
                        echo "<br>" . "<strong>Type: </strong>";
                        foreach($type as $item){echo $item . " ";}
                        echo "<br>" . "<strong>Cultural Affiliations: </strong>";
                        foreach($affiliation as $item){echo $item . " ";}
                        ?>">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                            </div><img class="img-fluid" src="<?php echo $tempName;?>" alt="" /> </a>
                        <div class="portfolio-caption">
                            <h4><?php echo $asset;//if(!empty($name)) { echo $name;} else { echo $asset;}?></h4>
                            <form method="post" action="fullrecord.php" class="inline">
                                <input type="hidden" name="extra_submit_param" value="<?php echo $koraID;?>">
                                <button type="submit" name="koraID" value="<?php echo $koraID;?>" class="btn btn-secondary">Full Record Page</button>
                            </form>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
        </div>

    <!-- pagination -->
    <div>
        <?php
        // Get total page number
        //$totalPages = intdiv($totalRecords,9); echo $totalPages; ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
    </div>


</section>


<footer class="footer py-4 bg-secondary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"></span></div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a><a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">MSU Archaeology Digital Collections by <a xmlns:cc="http://creativecommons.org/ns#" href="https://chi.franc230.msu.domains/" property="cc:attributionName" rel="cc:attributionURL">Zach Francis</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- FancyBox JS - Already have jquery?
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="js/jquery.fancybox.min.js"></script>
</body>
</html>
