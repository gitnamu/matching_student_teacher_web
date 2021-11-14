<?php
$fileName = "./data/posts.json";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $postTitle = $_POST['postTitle'];
  $postContent = $_POST['postContent'];
  $studentNum = $_POST['studentNum'];
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $id = "admin";  //$_GET['id'];
  $writtenDate = date("Y-m-d");

  $data = array(
    'title' => $postTitle,
    'id' => $id,
    'writtenDate' => $writtenDate,
    'content' => $postContent,
    'studentNum' => $studentNum,
    'startDate' => $startDate,
    'endDate' => $endDate
  );
  $EncodedData = json_encode($data);
  $putContents = file_put_contents($fileName, $EncodedData."\n", FILE_APPEND | LOCK_EX);

  echo "작성이 완료되었습니다!";
  echo "<br><a href=\"mainPage.html\">홈으로 돌아가기</a>";
}

 ?>
