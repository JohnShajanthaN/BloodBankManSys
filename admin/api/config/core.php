<?php

    error_reporting(E_ALL);

    $secret_key  = "example_key";
    $issuer_claim  = "http://example.org";
    $audience_claim  = "http://example.com";
    $issuedat_claim = 1356999524; 
    $notbefore_claim  = 1357000000;
    $expire_claim = (time() + 86400)*1000;

?>