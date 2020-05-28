
<li class="nav-item">
    <a class="nav-link" href="browse.php">Random Records</a>
</li>

<?php
// Get functions to get various things from Kora's API

function getProjectForms() {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/projects/7/forms");
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

function getFormFields() {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/projects/7/forms/16/fields");
    $data = curl_exec($curl);

    curl_close($curl);

    return $data;
}
?>
          <!-- Fancy Box Row 2 -->
            <?php foreach (array_splice($results[0],$offset,3) as $browse) {

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
                <?php foreach (array_splice($results[0],$offset,3) as $browse) {

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

?>
