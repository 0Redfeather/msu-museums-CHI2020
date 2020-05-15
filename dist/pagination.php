<?php

include 'functions.php';

$data = formSearchBuilder($fid, $token, $flags, $fieldValues, null);
$array = array();
$array["forms"] = json_encode(array($data));

$record = getData($array);

// print_r($record);
?>
