<?php
define("OAUTH2_SITE", 'https://api.shop-pro.jp');
define("OAUTH2_CLIENT_ID",'f0f89b250d37bac2807bf997bcb43987528275503a35c1dafd945d4c9d66ac7f');
define("OAUTH2_CLIENT_SECRET", 'ab4425372f8e5f907e21b05f1d57c060ad9ab55d7b36fd480e1c334088c54f94');
define("OAUTH2_REDIRECT_URI", 'https://bond-botanical.jp/inc/get_access_token.php');

$code = $_GET['code'];
// 認可ページへリダイレクトする
if (empty($code)) {
    $params = array(
        'client_id'     => OAUTH2_CLIENT_ID,
        'redirect_uri'  => OAUTH2_REDIRECT_URI,
        'response_type' => 'code',
        'scope'         => 'read_products write_products read_sales write_sales'
    );
    $auth_url = OAUTH2_SITE . '/oauth/authorize?' . http_build_query($params);
    header('Location: ' . $auth_url);
    exit;
}

// 認可後
$params = array(
    'client_id'     => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'code'          => $code,
    'grant_type'    => 'authorization_code',
    'redirect_uri'  => OAUTH2_REDIRECT_URI
);
$request_options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => http_build_query($params)
    )
);
$context = stream_context_create($request_options);

$token_url = OAUTH2_SITE . '/oauth/token';
$response_body = file_get_contents($token_url, false, $context);
$response_json = json_decode($response_body);

echo '<pre>';
// var_dump($response_body);
var_dump($response_json);
echo '</pre>';

exit();

/*
object(stdClass)#1 (3) {
  ["access_token"]=>
  string(64) "c96dca56bc9bcf73ffd97484e5f0d983adcc9b7489d3799768bd1e6dcae32dca"
  ["token_type"]=>
  string(6) "bearer"
  ["scope"]=>
  string(51) "read_products write_products read_sales write_sales"
}
*/