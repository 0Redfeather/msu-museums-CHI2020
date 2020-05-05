<?php
define("koraApiURL","https://kora.anthropology.msu.edu/api/search"); //"http://www.myKoraInstall.com/api/search"

$fieldValues = array("Asset ID", "Description", "General Type", "Heritage Asset Type", "Display Date", "Cultural Affiliations", "Period Name", "Name Site", "Copyright Credit Line");
// "Associated_Collection_7_16_",
$token = '5e4f0278b9e13';
$fid = 'Heritage_Asset_7_16_'; // 16
$flags = array("data"); // "meta"
     //$fieldValues = array("Asset ID", "Collection", "Name", "Description");
     // $keywords = array("description", "PHP");
     //$koraID = array("7-16-23", "7-16-24", "7-16-25");
     //$queries1 = array();
     //$queries2 = array();
     //$flagValue = array("data");
     //$queries1["search"] = "kid";
    // $queries1["kids"] = $koraID;
     //$queries2["search"] = "keyword";
     //$queries2["key_words"] = $keywords;
     //$queries2["key_fields"] = $fieldValues;
     //$queries = array($queries1, $queries2);


   //  * Builds the query string for a KID search.
  //  * @param  array $kids - KIDs we are searching for
   //  * @param  bool $not - Get the negative results of the search
   // * @param  bool $legacy - Search for legacy kid instead
  //  * @return array - The query array

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

   //$kidQuery = kidQueryBuilder($koraID);
    //* Builds the query string for a keyword search.
  //  *
 //  * @param  string $keyString - Keywords for the search
 //  * @param  string $method - Defines if search is AND, OR, or EXACT
  //  * @param  bool $not - Get the negative results of the search
   //  * @param  array $fields - Specific fields to search in
    //  * @param  bool $customWildCards - Is the user providing wildcards
   // * @return array - The query array
   //  */

      function keywordQueryBuilder($keys,$method,$not=false,$fields=array(),$customWildCards=false) {
          $qkey = array();
          $qkey["search"] = "keyword";
          $qkey["key_words"] = $keys;
          $qkey["key_method"] = $method;
          if ($not)
              $qkey["not"] = $not;
          if (!empty($fields))
              $qkey["key_fields"] = $fields;
           if ($customWildCards)
               $qkey["custom_wildcards"] = $customWildCards;
           return $qkey;
      }

      //$keywordQuery = keywordQueryBuilder($keywords, "AND", $not=false, $fields = $fieldValues);
        ///**
        //* Takes queries and other information to build the full forms string value in an array.
         //*
         //* @param  string $fid - Form ID
        //* @param  string $token - Token to authenticate search
       //* @param  array $flags - Array of flags that customize the search further
       //* @param  array $fields - For each record, the fields that should actually be returned
       //* @param  array $sort - Defines what fields we are sorting by
       //* @param  array $queries - The collection of query arrays in the search
       //* @param  array $qLogic - Logic array for the search
       //* @param  int $index - In final result set, what record should we start at
       //* @param  int $count - Determines, starting from $index, how many records to return
       //* @param  int $filterCount - Determines what the minimum threshold us for a filter to appear
       //* @param  array $fitlerFields - Determines what fields are processed for filters
       //* @param  array $assocFields - Determines what fields are returned for associated records
       //* @return array - Array representation of the form search for the API
       //*/

       // function formSearchBuilder($fid,$token,$flags,$fields,$sort,$queries,$qLogic,$index=null,$count=null,$filterCount=null,$filterFields=null,$assocFields=null) {

      function formSearchBuilder($fid,$token,$flags,$fields,$queries) {
          $form = array();
          $form["bearer_token"] = $token;
          $form["form"] = $fid;

          $form["data"] = in_array("data",$flags) ? in_array("data",$flags) : false;
          $form["meta"] = in_array("meta",$flags) ? in_array("meta",$flags) : false;
          $form["size"] = in_array("size",$flags) ? in_array("size",$flags) : false;

          //$form["filters"] = in_array("filters",$flags) ? in_array("filters",$flags) : false;
          ////if(!is_null($filterCount))
          /// //   $form["filter_count"] = 1;
          /// //if(is_array($filterFields) && empty($filterFields))
          /// //    $form["filter_fields"] = "ALL";
          // //else
          //    $form["filter_fields"] = "ALL";//$filterFields;

          //$form["assoc"] = in_array("assoc",$flags) ? in_array("assoc",$flags) : false;
          ////if(is_array($assocFields) && empty($assocFields))
          //  $form["assoc_fields"] = "ALL";
          //else
          // $form["assoc_fields"] = $assocFields;
          //$form["reverse_assoc"] = in_array("reverse_assoc",$flags) ? in_array("reverse_assoc",$flags) : false;

          // $form["real_names"] = in_array("real_names",$flags) ? in_array("real_names",$flags) : false;
          //// $form["under"] = in_array("under",$flags) ? in_array("under",$flags) : false;

          if(is_array($fields) && empty($fields))
              $form["return_fields"] = "ALL";
          else
              $form["return_fields"] = $fields;

          // if(!empty($sort))
          // $form["sort"] = $sort;

          //if(!is_null($index))
          //$form["index"] = $index;

          //if(!is_null($count))
          //$form["count"] = $count;

          $form["queries"] = $queries;

          //if(!is_null($qLogic))
            //  $form["logic"] = $qLogic;
          return $form;
      }

                            //$value = formSearchBuilder("Heritage_Asset_7_16_", "5e4f0278b9e13", array("data", "meta"),
                              //array(), null, array($kidQuery, $keywordQuery), null, $filterFields = array());
                            // $value = "[" . json_encode($value) . "]";
                            //$value = json_encode($value);

                          //$value = kidQueryBuilder($koraID);
                          //$value = "[" . json_encode($value) . "]";

    $value = array();
      $value["bearer_token"] = "5e4f0278b9e13";
      $value["form"] = "16";
      //$value = "[" . json_encode($value) . "]";
      $value = json_encode($value);

    function getData($jsonQuery) {
        //$array = array();
        //$array["forms"] =$jsonQuery;
        //$array = json_encode($array);

        $curl = curl_init();

        // curl -X POST -H 'Content-Type: application/json' -d '{"username":"davidwalsh","password":"something"}' http://domain.tld/login

        curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/search");
        //if(!empty($userInfo)) {
         //   curl_setopt($curl, CURLOPT_USERPWD, $userInfo["franc230@msu.edu"] . ":" . $userInfo["nnn_UVfk~.)^em#H"]);
         //   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //}
        //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // This asks for the data back in json, which it should already be sending
        curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($jsonQueryValues));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonQuery);
        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/

        //$headers = array();
        //$headers[] = 'Content-Type: application/json';
        //curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //$result = curl_exec($ch);
        //if (curl_errno($ch)) {
         //   echo 'Error:' . curl_error($ch);
       // }
       // curl_close($ch);


        // curl_exec($curl);
       $result = curl_exec($curl);

        //if (!$result = curl_exec($curl)) {
        //    trigger_error(curl_error($curl));
        //}

        curl_close($curl);

       $result = json_decode($result, true);
       // $result = json_decode(file_get_contents("php://input"));

        if (isset($result['records'])) {
            return $result['records'];
        } else {
            return $result;
        }
    }

// Get functions to get various things from Kora's API

function getProjectForms()
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/projects/7/forms");
    $data = curl_exec($curl);

    //json_decode($data);
    //if(!$result = curl_exec($curl))
    //{
    //   trigger_error(curl_error($curl));
    //}
    curl_close($curl);
    return $data;
    //return $result;
    //$result = json_decode($result,true);

    //if(isset($result['records']))
    //  return $result['records'];
    //else
    //   return $result;
}

function getFormFields()
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://kora.anthropology.msu.edu/api/projects/7/forms/16/fields");
    $data = curl_exec($curl);

    //json_decode($data);
    //if(!$result = curl_exec($curl))
    //{
    //   trigger_error(curl_error($curl));
    //}
    curl_close($curl);
    return $data;
    //return $result;
    //$result = json_decode($result,true);

    //if(isset($result['records']))
    //  return $result['records'];
    //else
    //   return $result;
}

//$projectForms = getProjectForms();
//settype($projectForms, "string");
//$formsJSON = json_decode($projectForms, true);
//echo gettype($formsJSON);
//echo $formsJSON;
// print_r($projectForms);


$formFields = getFormFields();
settype($formFields, "string");
$formFields = json_decode($formFields);
// echo gettype($formFields);
// echo $formFields;

    // $data = getData($value);

    //echo "-----DATA SENT-------- " . "\n";
    //print_r($value);
    //echo "\n";

    //echo "\n" . "-----RESULTS-----" . "\n";
    //print_r($data);
