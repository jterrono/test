<?php
$login = 'admin';
$password = 'test';
//$auth = "Authorization: PSSERVER AccessId = $userName;";

$url = 'http://jimmyterrono.com/lawline/api/product/4';

$post_args = json_encode(array('name' => 'test', 'description' => 'test123','price' => '5.99'));
$headers = array("Content-Type: application/json; charset=utf-8", "X-API-KEY: 1234546");

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
//curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
//curl_setopt($curl, CURLOPT_USERPWD, "$login:$password");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($curl, CURLOPT_POSTFIELDS, $post_args);

$result = curl_exec($curl);
//$result = json_decode((curl_exec($curl)));
//$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

echo '<pre>';
print_r($result);
echo '</pre>';



?>