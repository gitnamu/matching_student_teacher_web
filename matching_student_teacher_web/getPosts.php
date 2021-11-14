<?php

  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myFile = "./data/joinedList.json";        // 회원 목록 json 파일 경로
    $id = test_input($_POST["id"]);        // 입력받은 id
    $pwd = test_input($_POST["pwd"]);      // 입력받은 password
    $type = test_input($_POST["type"]);       // 0이면 회원가입, 1이면 로그인

    if($type === "0") {  // 0이면 회원가입
      if(file_exists($myFile) && checkSameId($myFile, $id, $type)) {
          echo "-1";      // 파일이 존재하는데 입력된 아이디와 동일한 것이 존재하면 -1 반환
      }
      else{
        if(!isset($myObj)) $myObj = new stdClass(); // 객체 생성
        $myObj->id=$id;                          // 입력된 id값 객체에 저장
        $myObj->pw=$pwd;                         // 입력된 password값 객체에 저장
        $myJSON = json_encode($myObj);              // json파일로 encode
        file_put_contents($myFile, $myJSON . "\n",FILE_APPEND); // joinedList.json에 추가

        $userFolder = "./data/" . $id . "/";   // 현재 회원가입한 이용자의 폴더 경로
        if(!is_dir($userFolder))  mkdir($userFolder); // 폴더가 비어있다면 새로 만들기
        echo "1";                       // 정상 처리되었다면 1 반환
      }
    } else if($type === "1"){   // 1이면 로그인
      if(!checkSameId($myFile, $id, $type, $pwd)){
        echo "-1";                              // 일치하는 id가 없으면 -1 반환
      }
      else{
        $_SESSION['enteredId'] = $id;    // session에 저장
        echo "1";                               // 1 반환
      }
    }else{
      echo "-2";    // 오류
    }
  }

  //입력된 값을 test하는 함수
  function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // 입력된 것과 동일한 id 및 pwd가 존재하는지 확인하는 함수
  function checkSameId($myFile, $id, $type, $pwd=0){
    $file = fopen($myFile, "r")or die("error");          // joinedList.json 열기
    while (!feof($file)) {                // 파일 마지막까지
      $line = fgets($file);               // 한줄씩 읽기
      $jsonArr = json_decode($line,true); // 읽은 line decode
      if($jsonArr["id"] == $id){
        if($type == 0) {
          return true; // 동일한 id 값을 찾으면 true 반환
        } else {
          if($jsonArr["pwd"] === $pwd){
            return true;                        // id와 password가 동일한 것이 있다면 true 반환
          }
        }
      }
    }
    fclose($file);
    return false;                               // 찾지 못하면 false 반환
  }
?>
