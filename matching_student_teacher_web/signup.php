<?php
$id = $pw = $type = "";
$career = array();
$count=0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = test_input($_POST['userId']);
  $pw = test_input($_POST['userPw']);
  $type = test_input($_POST['userType']);
  $career = $_POST['userCareer'];
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
    $searchId = json_decode($strTok[$i]);
     if($searchId->{'userId'}===$id){
       $count = 1;

     }
  }
}
if($count === 0){
  $array = array();
  $array['userId']=$id;
  $array['userPw']=$pw;
  $array['userType']=$type;
  $array['userCareer']=$career;
  $json = json_encode($array);
  file_put_contents("person.json", $json."\n", FILE_APPEND | LOCK_EX);
}
 ?>
