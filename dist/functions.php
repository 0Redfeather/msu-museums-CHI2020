<?php
define("koraApiURL","https://kora.anthropology.msu.edu/api/search"); //"http://www.myKoraInstall.com/api/search"

// Variables

    $fieldValues = array("Asset ID", "Description", "General Type", "Heritage Asset Type", "Display Date", "Cultural Affiliations", "Period Name", "Associated Site", "Images", "Copyright Credit Line");
    $browserFieldValues = array("Asset ID", "Description", "Heritage Asset Type", "Cultural Affiliations", "Images");

$token = '5e4f0278b9e13';
    $fid = 'Heritage_Asset_7_16_'; // 16
    $flags = array("data"); // "meta"

//  Functions

    // Build queries for kid and keywords

    function kidQueryBuilder($kids,$not=false,$legacy=false) {
        $qkid = array();
        if(!$legacy) {
            $qkid["search"] = "kid";
            $qkid["kids"] = $kids;
        } else {
            $qkid["search"] = "legacy_kid";
            $qkid["legacy_kids"] = $kids;
        }
        if($not)
            $qkid["not"] = $not;
        return $qkid;
    }

    function keywordQueryBuilder($keys,$method,$not=false,$fields=array(),$customWildCards=false) {
        $qkey = array();
        $qkey["search"] = "keyword";
        $qkey["key_words"] = array($keys);
        $qkey["key_method"] = $method;
        if ($not)
            $qkey["not"] = $not;
        if (!empty($fields))
            $qkey["key_fields"] = $fields;
        if ($customWildCards)
            $qkey["custom_wildcards"] = $customWildCards;
        return $qkey;
    }

    // Build Search Array for json to be sent to Kora
    function formSearchBuilder($fid,$token,$flags,$fields,$queries) {
        $form = array();
        $form["bearer_token"] = $token;
        $form["form"] = $fid;

        $form["data"] = in_array("data",$flags) ? in_array("data",$flags) : false;
        $form["meta"] = in_array("meta",$flags) ? in_array("meta",$flags) : false;
        $form["size"] = in_array("size",$flags) ? in_array("size",$flags) : false;

        if(is_array($fields) && empty($fields))
            $form["return_fields"] = "ALL";
        else
            $form["return_fields"] = $fields;

        if(!is_null($queries))
            $form["queries"] = $queries;

        return $form;
    }

// curl for getting data from kora

    function getData($jsonQuery) {
        // Initiating curl parameters to get data from the Kora API
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/search");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonQuery);

        $result = curl_exec($curl);

       $result = json_decode($result, true);

        curl_close($curl);

       if (isset($result['records'])) {
           return $result['records'];
       } else {
           return $result;
       }
    }

    function grab_image($saveto,$koraID,$imageName){
        // Initiating curl parameters to get the image page for a Heritage Asset
        // This pulls the image, and saves it to the repository before we end up deleting it.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://kora.anthropology.msu.edu/files/$koraID/$imageName");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);

        $raw=curl_exec($ch);

        // Deleting file path that the image you are attempting to retrieve will be saved to.
        if(file_exists($saveto)){
        unlink($saveto);
        }

        // Saving the file to the desired filepath, which we will then be able to call in the code.
        // Will have to figure out a way to directly insert the images from the Kora API into your code without having to seperately save it.
        $fp = fopen($saveto,'x');
        fwrite($fp, $raw); //$raw
        fclose($fp);

        // Resizing the images and Lowering the resolution to make it easier to handle and to make our images more valuable.
        $percent = 0.35;
        list($width, $height) = getimagesize($saveto);
        $new_width = $width * $percent;
        $new_height = $height * $percent;

        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($saveto);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        //Saving newly formatted image to original file path.
        imagejpeg($image_p, $saveto, 50);

        curl_close ($ch);
}

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


