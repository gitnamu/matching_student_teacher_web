/*!
* Start Bootstrap - Landing Page v6.0.4 (https://startbootstrap.com/theme/landing-page)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-landing-page/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
document.addEventListener("DOMContentLoaded", getPosts);

// 테이블 내용 json 파일에서 가져오기
function getPosts(){
  var type = 0;
  json_data = {"type": type};
  $.post("./getPosts.php",json_data, function(result){
    if(result){
      var postListArr = JSON.parse(result);
      var table = document.getElementById("postTable");
      for (var i = 0; i < postListArr.length; i++) {
        var postListJSON = postListArr[i];
        var postList = JSON.parse(postListJSON);

        var trElement = document.createElement('tr');
        var tdElement = document.createElement('td');
        var txtNode = document.createTextNode(i);
        tdElement.appendChild(txtNode);
        trElement.appendChild(tdElement);

        tdElement = document.createElement('td');
        aElement = document.createElement('a');
        aElement.setAttribute("href", "./postPage.php"+"?index="+i);
        txtNode = document.createTextNode(postList["title"]);
        aElement.appendChild(txtNode);
        tdElement.appendChild(aElement);
        trElement.appendChild(tdElement);

        tdElement = document.createElement('td');
        txtNode = document.createTextNode(postList["id"]);
        tdElement.appendChild(txtNode);
        trElement.appendChild(tdElement);
        table.appendChild(trElement);

        tdElement = document.createElement('td');
        txtNode = document.createTextNode(postList["writtenDate"]);
        tdElement.appendChild(txtNode);
        trElement.appendChild(tdElement);
        table.appendChild(trElement);
      }
    }
  });
}
