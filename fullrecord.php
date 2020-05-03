<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - MSU Archaeology Collections</title>
    <meta name="description" content="A website built for displaying objects from the MSU Digital Repository">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
</head>



<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">MSU Archaeology Collections</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" data-toogle="collapse" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto text-uppercase">
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="#portfolio">Browse</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="#contact">Search</a><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="portfolio" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 offset-md-0 text-center">
                    <h2 class="text-uppercase section-heading"> Heritage Asset:
                        <?php
                            // Getting user submitted data from search.php

                            $koraID = $_REQUEST['koraID'];
                            $keywords = explode(" ", $_REQUEST['keywords']);

                            // Setting the title of the page to the user submitted kora id
                            echo $koraID;

                            include 'functions.php';

                            // Turning kid into an array

                            $idArray = array($koraID);

                            $kidQuery = kidQueryBuilder($idArray);

                            if ($keywords == array("")) {
                                $queries = array($kidQuery);
                                //$queries = json_encode($queries);
                            } else {
                                $keywordQuery = keywordQueryBuilder($keywords, "AND");
                                $queries = array($kidQuery, $keywordQuery);
                            }

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
                    </h2>
                    <h3 class="section-subheading text-muted">Full Record Page</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-5 col-xl-5 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/1-thumbnail.jpg"></a>
                    <div class="portfolio-caption">
                        <h4>Kora Version</h4>
                        <p class="text-muted">Image Name: Image Description
                            <br>
                            <?php
                          // echo "Image Description";
                          echo "\n";
                          echo "-----Data Received------- " . "\n";
                          print_r($record);
                          echo "\n";
                          ?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-7 col-xl-7 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal6"></a>
                    <div class="text-left portfolio-caption">
                        <h3>Asset Identification</h3>
                        <p class="text-left text-muted"><strong>Asset ID: </strong><?php echo $record[0][$koraID]['Asset ID']; ?></p>
                        <p class="text-left text-black-50 text-muted"><strong>Collection:</strong> Schmidt Collection</p>
                    </div>
                    <div class="portfolio-caption">
                        <h4 class="text-left">Description</h4>
                        <p class="text-left text-muted"> <strong>Description:</strong> <?php echo $record[0][$koraID]['Description']; ?></p>
                    </div>
                    <div class="portfolio-caption">
                        <h4 class="text-left">Type</h4>
                        <p class="text-left text-muted"><strong>General Type:</strong> <?php echo $record[0][$koraID]['General Type']; ?></p>
                        <p class="text-left text-muted"><strong>Specific Type:</strong> <?php echo print_r($record[0][$koraID]['Heritage Asset Type']); ?></p>
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
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal4">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal5">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal6">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/6-full.jpg">
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-unstyled">
                                        <li>Date: January 2017</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>

</html>
