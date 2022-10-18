<?php
$accessToken = "a8XLxQ6lpvr5xV8FI2nd";
$merchantNumber = "T806323301";
$secretToken = "7dYWApnEduNlWNb8EjcJWsBhRrTjSzJWBrkW8alh";
$apiKey = base64_encode(
    $accessToken . "@" . $merchantNumber . ":" . $secretToken
);
$checkoutUrl = "https://api.v1.checkout.bambora.com/sessions";

$request = array();
$request["order"] = array();
$request["order"]["id"] = "SA3423432";
$request["order"]["amount"] = "19500";
$request["order"]["currency"] = "DKK";

$request["url"] = array();
$request["url"]["accept"] = "https://example.org/accept";
$request["url"]["cancel"] = "https://example.org/cancel";
$request["url"]["callbacks"] = array();
$request["url"]["callbacks"][] = array("url" => "https://example.org/callback");

$request["subscription"] = array();
$request["subscription"]["action"] = "create";
$request["subscription"]["description"] = "Bambora checkout subscription example";
$request["subscription"]["reference "] = $merchantNumber;

$requestJson = json_encode($request);
$contentLength = isset($requestJson) ? strlen($requestJson) : 0;
$headers = array(
    'Content-Type: application/json',
    'Content-Length: ' . $contentLength,
    'Accept: application/json',
    'Authorization: Basic ' . $apiKey
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $requestJson);
curl_setopt($curl, CURLOPT_URL, $checkoutUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$rawResponse = curl_exec($curl);
$response = json_decode($rawResponse);
?>

    <!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bambora Online Checkout PHP example</title>
</head>
<body>
<?php if($response->meta->result) { ?>
<script src="https://static.bambora.com/checkout-sdk-web/latest/checkout-sdk-web.min.js"></script>
<script>
    new Bambora.RedirectCheckout("<?php echo $response->token ?>");
</script>
<?php } else { ?>
<p>Error: <?php echo $response->meta->message->enduser; ?></p>
<?php } ?>
</body>
</html>
