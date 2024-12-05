<?php

    function response_json(array $jsonObject,$status=200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($jsonObject);
    }