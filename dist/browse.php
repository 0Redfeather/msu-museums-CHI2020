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
// Getting necessary data for the page.

// Getting page number
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = 1;
}

// Setting offset for fancyboxes to pull data from php arrays.
$offset = ($page-1) * 9;

// Including functions page to pull data.
include 'functions.php';

// Getting the data from a keyword search if it exists and and building a query array.
//Really need to work out how to explode strings and search for individual words in strings
if (!empty($_REQUEST['keyWords']) || !empty($keywords)) {
    if (!empty($_REQUEST['keyWords'])) {
        $keywords=$_REQUEST['keyWords'];
        $initialKeyword = explode(" ", $_REQUEST['keyWords']);
        foreach ($initialKeyword as $other => $thing) {
            $explodedWords = array();
            $explodedWords[] = $thing;
        }
        $keywordQuery = keywordQueryBuilder("$keywords", "OR");
        $queries = array($keywordQuery);
    } elseif (!empty($keywords)) {
        $keywordQuery = keywordQueryBuilder("$keywords", "OR");
        $queries = array($keywordQuery);
    } else {
        echo "An error happened.";
    }
} else {
    $queries=null;
    $keywords = null;
}

//Building form for performing a search in kora - see functions.php
$data = formSearchBuilder($fid, $token, $flags, $browserFieldValues, $queries);

// Building an array to json_encode the form for searching. This is what's necessary to get the code back
$array = array();
$array["forms"] = json_encode(array($data));

//Perform a cURL to get the data back from Kora and store into $results. Get back an array.
$results = getData($array);

//Counting the total number of records received
$totalRecords = count($results[0]);

//Making a variable to describe the total number of pages that I want since I am displaying 9 records per page
$totalPages = ceil($totalRecords/9);

//setting variable for image counters - without this, it only displays the same image.
$i = 1;
?>

<body id="page-top">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="browse.php">Browse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="random.php">Random</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Browsing Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- <h2 class="text-uppercase section-heading">Browse</h2> -->
                <h3 class="section-subheading text-muted">Browser is still being improved, but <?php echo $totalRecords; ?> record(s) resulted for your query of
                    <?php if (!empty($_REQUEST['keyWords'])) { echo "\"$keywords\""; } else { echo "all records"; } ?>! You are on page <?php echo $page;?> of <?php echo $totalPages?></h3>
                <br>
            </div>
        </div>

<!-- Top pagination Code -->
        <?php if ($totalRecords >= 4){ // need to change this so that it is the total number of records on the page. stops top pagination links from appearing when
            // there are a small amount of records?>
         <div>
            <?php  // Each pagination link submits a new form to browse.php with the proper page number and submitted keywords?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="1">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">First</button>
                        </form>
                    </li>
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo ($page - 1);?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Previous</button>
                        </form></li>
                    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo ($page + 1);?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Next</button>
                        </form>
                    </li>
                    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo $totalPages; ?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Last</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <?php } ?>

        <!-- Fancy Box -->
        <?php for ($x=1; $x<=3; ++$x) { ?>
        <div class="row">
            <?php foreach (array_splice($results[0],$offset,3) as $browse) {

                $koraID = $browse['kid'];
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
                    <h4><?php echo $asset;?></h4>
                    <form method="post" action="fullrecord.php" class="inline">
                        <input type="hidden" name="extra_submit_param" value="<?php echo $koraID;?>">
                        <button type="submit" name="koraID" value="<?php echo $koraID;?>" class="btn btn-secondary">Full Record Page</button>
                    </form>
                </div>
            </div>
            <?php $i++;}?>
        </div>
        <?php } ?>


    <!-- pagination bottom-->
        <div>
            <?php  // Each pagination link submits a new form to browse.php with the proper page number and submitted keywords?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="1">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">First</button>
                        </form>
                    </li>
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo ($page - 1);?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Previous</button>
                        </form></li>
                    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo ($page + 1);?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Next</button>
                        </form>
                    </li>
                    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; }?>">
                        <form method="post" action="browse.php" class="inline">
                            <input type="hidden" name="page" value="<?php echo $totalPages; ?>">
                            <button class="page-link" type="submit" name="keyWords" value="<?php echo $keywords?>">Last</button>
                        </form>
                    </li>
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
