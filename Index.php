<?php
header("Content-Type: text/plain; charset=UTF-8"); // تغییر به text/plain برای نمایش فقط متن

if (!isset($_GET['text'])) {
    echo "خطا: متن ارسال نشده است.";
    exit;
}

$text = urlencode($_GET['text']);
$apiUrl = "https://api.fast-creat.ir/gpt/chat?apikey=1216797484:CPDHaGERwYbUmjV@Api_ManagerRoBot&text=$text";

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_HTTPHEADER => ["Accept: application/json"],
]);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
    echo "خطا در اتصال به API";
    exit;
}

$data = json_decode($response, true);
if (isset($data['result']['text'])) {
    echo $data['result']['text']; // فقط متن پاسخ را چاپ می‌کند
} else {
    echo "پاسخ نامعتبر از API";
}
?>