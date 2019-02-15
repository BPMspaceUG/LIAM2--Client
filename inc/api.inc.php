<?php
function api($data) {
    $url = "http://dev.bpmspace.org:4040/~daniel/APMS_test/bpmspace_liam2_v2/api.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $url);
    $headers = array();
    //JWT token for Authentication
    /************** change following line **********************/
    $headers[] = 'Cookie: token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEzMzcsImZpcnN0bmFtZSI6Ik1hY2hpbmUiLCJsYXN0bmFtZSI6Ik1hY2hpbmUifQ.wuQyBfke8r7Mxx_Z8x_C5nFN8bxgadTWpJUvVNHGkAw';
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($data);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($ch);
}