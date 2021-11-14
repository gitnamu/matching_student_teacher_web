<?php
//변수 초기화
$id = $pw = "";
//세션시작
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = test_input($_POST['loginId']);
  $pw = test_input($_POST['loginPw']);
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(file_exists("person.json")){
  $existJson = file_get_contents("person.json");
  $strTok = explode("\n", $existJson);
  for($i = 0; $i < count($strTok)-1; $i++){
    $search= json_decode($strTok[$i]);
     if($search->{'userId'}===$id && $search->{'userPw'}===$pw){
      $_SESSION['loginId'] = $id;
      echo "로그인!";
       break;
     }
  }
}


 ?>
