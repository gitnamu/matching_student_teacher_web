<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myFile = "./data/posts.json";        // 회원 목록 json 파일 경로
    $postList = array();

    $file = fopen($myFile, "r")or die("error");
    while (!feof($file)) {                // 파일 마지막까지
      $line = fgets($file);               // 한줄씩 읽기
      if($line == "") continue;
      array_push($postList, $line);
    }
    if(count($postList) == 0) echo false;                        // 비어있으면 종료
    echo json_encode($postList);                                    // following 리스트 반환
  }
?>
