<?php
// データを受け取る
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力データを取得
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");

    // CSVに書き込む
    $file = 'contact_data.csv';
    $entry = [$name, $email, $message, date("Y-m-d H:i:s")];

    // ファイルが存在しない場合はヘッダーを追加
    if (!file_exists($file)) {
        $header = ['名前', 'メールアドレス', 'お問い合わせ内容', '送信日時'];
        $csvFile = fopen($file, 'w');
        fputcsv($csvFile, $header);
        fclose($csvFile);
    }

    // データをCSVに追加
    $csvFile = fopen($file, 'a');
    fputcsv($csvFile, $entry);
    fclose($csvFile);

    // 完了メッセージを返す
    echo "お問い合わせを受け付けました。ありがとうございます！";
} else {
    echo "無効なリクエストです。";
}
