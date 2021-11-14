<?php
$index = $_GET['index'];

$myFile = "./data/posts.json";
$line = "";
$file = fopen($myFile, "r")or die("error");


for ($i = 0;$i <= $index; $i=$i+1) {
  $line = fgets($file);               // 한줄씩 읽기
}

$decoded = json_decode($line);
 ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title></title>
</head>
<body>
  <div>
    <h2>
      <?= $decoded->title ?>
    </h2>
  </div>
  <div>
      <div class="row">
        <p>모집 인원 : <?= $decoded->studentNum ?></p>
        <p>과외 기간 : <?= $decoded->startDate ?> ~ <?= $decoded->endDate ?></p>
      </div>
      <p>상세 설명</p>
      <p><?= $decoded->content ?></p>
      <input type="button" id="application" value="신청하기">
  </div>
</body></html>
