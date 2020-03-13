<!doctype html>

API URL: https://kora.anthropology.msu.edu/projects/7/{API_FUNCTION_URI}


<?php
echo $_POST[https://kora.anthropology.msu.edu/projects/7/api/search];
?>

<!-- Record Search -->
curl
W3

jquery - ajax - if callin on the client side

https://kora.anthropology.msu.edu/projects/7/api/search
 [
 {
    "bearer_token": "5e4f0278b9e13",
    "form": Heritage_Asset_7_16_
    "return_fields": [“field 1", “field 2", ...],
 }
 ]
kora -> app ->  field helper -> kora search
-- form search builder - 80ish

<!-- Is this how I would call a field? -->
 <div class="portfolio-caption">
     <h4 class="text-left">Description</h4>
     <p class="text-left text-muted"> <strong>Description:</strong>
       <php? echo
       $_POST[{
          "bearer_token": "5e4f0278b9e13",
          "form": 16,
          "return_fields": ["description"],
       }]
       ?>
       </p>
