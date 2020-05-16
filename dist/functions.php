<?php
define("koraApiURL","https://kora.anthropology.msu.edu/api/search"); //"http://www.myKoraInstall.com/api/search"

// Variables

    $fieldValues = array("Asset ID", "Description", "General Type", "Heritage Asset Type", "Display Date", "Cultural Affiliations", "Period Name", "Associated Site", "Images", "Copyright Credit Line");
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
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/search");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonQuery);

        $result = curl_exec($curl);

        curl_close($curl);

       $result = json_decode($result, true);

       if (isset($result['records'])) {
           return $result['records'];
       } else {
           return $result;
       }
    }

    function grab_image($saveto,$koraID,$imageName){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://kora.anthropology.msu.edu/files/$koraID/$imageName");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);

        $raw=curl_exec($ch);

        curl_close ($ch);

        if(file_exists($saveto)){
        unlink($saveto);
        }

        $fp = fopen($saveto,'x');

        fwrite($fp, $raw);

        fclose($fp);
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
