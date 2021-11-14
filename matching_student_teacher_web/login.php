<?php
//변수 초기화
$id = $pw = "";
$count = 0;
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

if(file_exists("data/person.json")){
  $existJson = file_get_contents("data/person.json");
  $strTok = explode("\n", $existJson);
  for($i = 0; $i < count($strTok)-1; $i++){
    $search= json_decode($strTok[$i]);
     if($search->{'userId'}===$id && $search->{'userPw'}===$pw){
      $_SESSION['loginId'] = $id;
      $count = 1;
       break;
     }
  }
}
if($count == 0){
  echo("<script>alert('로그인 실패했습니다.');</script>");
  echo("<script>location.replace('mainPage.html');</script>");
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width-device-width" initial-scale="1.0">
     <title>  </title>
     <link rel="stylesheet" href="css/style.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@500;600&family=Noto+Sans+KR&display=swap" rel="stylesheet">
     <script defer src="js/background.js"></script>
 </head>
 <body>
   <h1>Matching Student & Teacher</h1>
     <section>
       <button type="button" id="writePostButton"><a href="./writingPost.html">글쓰기</a></button>
       <table id="postTable">
         <th>번호</th>
         <th>제목</th>
         <th>작성자</th>
         <th>등록일</th>
       </table>
     </section>
     <!-- Bootstrap core JS-->
     <script src="js/scripts.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 </body>
 </html>
