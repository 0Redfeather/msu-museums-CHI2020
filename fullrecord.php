<?php

static function formSearchBuilder($fid,$token,$flags,$fields,$sort,$queries,$qLogic,$index=null,$count=null,$filterCount=null,$fitlerFields=null,$assocFields=null) {
    $form = array();
    $form["form"] = $fid;
    $form["bearer_token"] = $token;

    $form["data"] = in_array("data",$flags) ? in_array("data",$flags) : false;
    $form["meta"] = in_array("meta",$flags) ? in_array("meta",$flags) : false;
    $form["size"] = in_array("size",$flags) ? in_array("size",$flags) : false;

    $form["filters"] = in_array("filters",$flags) ? in_array("filters",$flags) : false;
    if(!is_null($filterCount))
        $form["filter_count"] = $filterCount;
    if(is_array($fitlerFields) && empty($fitlerFields))
        $form["filter_fields"] = "ALL";
    else
        $form["filter_fields"] = $fitlerFields;

    $form["assoc"] = in_array("assoc",$flags) ? in_array("assoc",$flags) : false;
    if(is_array($assocFields) && empty($assocFields))
        $form["assoc_fields"] = "ALL";
    else
        $form["assoc_fields"] = $assocFields;
    $form["reverse_assoc"] = in_array("reverse_assoc",$flags) ? in_array("reverse_assoc",$flags) : false;

    $form["real_names"] = in_array("real_names",$flags) ? in_array("real_names",$flags) : false;
    $form["under"] = in_array("under",$flags) ? in_array("under",$flags) : false;

    if(is_array($fields) && empty($fields))
        $form["return_fields"] = "ALL";
    else
        $form["return_fields"] = $fields;
    if(!empty($sort))
        $form["sort"] = $sort;

    if(!is_null($index))
        $form["index"] = $index;
    if(!is_null($count))
        $form["count"] = $count;

    $form["queries"] = $queries;
    if(!is_null($qLogic))
        $form["logic"] = $qLogic;

    return $form;
}
}
