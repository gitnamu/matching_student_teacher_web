<?php
// 데이터베이스 연결

$isbn = $_GET['isbn'];  //현재 도서의 isbn 가져오기

//isbn에 해당하는 도서의 정보 검색
$stmt = $conn -> prepare("SELECT TITLE, PUBLISHER, YEAR FROM EBOOK WHERE ISBN = ? ");
$stmt -> execute(array($isbn));
$bookName = '';
$publisher = '';
$price = '';

//도서 정보 저장
if ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    $bookName = $row['TITLE'];
    $publisher = $row['PUBLISHER'];
    $price = $row['YEAR'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- submit 버튼이 클릭되어도 페이지 이동하지 않도록 함 -->
    <script>
      $(function () {
        $('form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'reserve.php',
            data: $('form').serialize(),
            success: function (result) {
              // 해당 계정의 예약도서가 3권 이상인 경우
              if(result == "reserveFail"){
                alert("이미 최대 예약 권 수인 3권을 예약하였습니다.");
              }
              // 예약 성공시
              else if(result == "reserveSuccess"){
                alert("예약 성공하였습니다!");
              }
              // 해당 계정으로 이미 예약한 도서인경우
              else{
                alert("이미 예약된 도서입니다.");
              }
            }
          });
        });
      });
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <style>
        a {            text-decoration: none;        }
    </style>
    <title>Book VIEW</title>
</head>
<body>
<div class="container">
  <!-- 배너 -->
    <h2 class="display-6">상세 화면</h2>
    <!-- 테이블 -->
    <table class="table table-bordered text-center">
        <tbody>
            <tr>
                <td>제목</td>
                <td><?= $bookName ?></td>
            </tr>
            <tr>
                <td>출판사</td>
                <td><?= $publisher ?></td>
            </tr>
            <tr>
                <td>출판일</td>
                <td><?= $price ?></td>
            </tr>
        </tbody>
    </table>
<?php
}
?>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <!-- 뒤로가기 버튼 -->
    <a href="searchBook.php" class="btn btn-danger">뒤로가기</a>
    <!-- 예약하기 버튼 -->
    <form class="reservationForm" method="post" action="reserve.php">
      <input type="hidden" name="isbn" value="<?= $isbn ?>">
      <button type="submit" id="reserveBtn" class="btn btn-success">예약</button>
    </form>
    <!-- 대출하기 버튼 -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">대출</button>
    <button type="button" class="btn btn-success">연장</button>
    <button type="button" class="btn btn-success">반납</button>
  </div>
</div>
<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteConfirmModal" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="deleteConfirmModalLabel"><?= $bookName ?></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               구현중입니다...
           </div>
           <div class="modal-footer">
               <form action="process.php?mode=rent" method="post" class="row">
                   <input type="hidden" name="bookId" value="<?= $isbn ?>">
                   <button type="submit" class="btn btn-success">대출</button>
               </form>
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
           </div>
       </div>
   </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>
