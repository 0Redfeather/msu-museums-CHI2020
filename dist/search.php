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
                    <a class="nav-link" href="browse.php">browse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <section id="about" class="page-section">
        <div class="container">
            <div class="masthead-subheading">

                <h4 class="section-heading text-uppercase">You may search by keyword here. Alternatively you may browse a list of clickable Kora IDs below for their full record pages. </h4>
                <form action="browse.php" method="post">
                    <!-- <label for="koraID">Search:</label> -->
                    <input type="text" name="keyWords" id="keyWords" required>
                    <br>
                    <br>
                    <!-- <label for="keywords">Keywords:</label>
                    <input type="text" name="keywords" id="keywords">
                    <br> -->
                    <input type="submit">
                </form>
                <br>
            </div>
            <div class="text-left">
               <!-- <h2 class="section-heading text-uppercase">About</h2> -->
                <h3 class="text-muted section-subheading">Here is a list of all Kora Records. Currently, Kora IDs (x-xx-xx) have to be pasted into the search bar, but a keyword search is in the works. You may also click on the Kora ID to check out its full record page.</h3>
                    <p><?php
                        //print_r($record);
                        $kidAvailable = array_keys($record['0']);
                        //print_r($kidAvailable);

                        foreach($kidAvailable as $item) {  ?>
                            <form method="post" action="fullrecord.php" class="inline">
                                <input type="hidden" name="extra_submit_param" value="<?php echo $item;?>">
                                <button type="submit" name="koraID" value="<?php echo $item;?>" class="link-button"><?php echo $item;?></button>
                            </form>
                            <?php echo " | ";
                            echo "<strong>Asset ID: </strong>" . $record[0][$item]['Asset ID'] . " | ";
                            //echo "<strong>Site:</strong> " . $record[0][$item]['Name Site'] . " | ";
                            echo "<strong>Asset Type: </strong>" . $record[0][$item]['General Type'] . " | ";
                            echo "<strong>Description:</strong> " . $record[0][$item]['Description'] . "<br>";
                        }
                    ?>
                    </p>

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
                <div class="col-lg-4 text-lg-right">MSU Archaeology Digital Collections by <a xmlns:cc="http://creativecommons.org/ns#" href="https://chi.franc230.msu.domains/" property="cc:attributionName" rel="cc:attributionURL">Zach Francis</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</div>
            </div>
        </div>
    </footer>
