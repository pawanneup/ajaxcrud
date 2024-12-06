<?php

    function response_json(array $jsonObject,$status=200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($jsonObject);
    }
 function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
