document.getElementById('careerAddButton').addEventListener('click', careerAdd);
document.getElementById('careerSubButton').addEventListener('click', careerSub);

function careerAdd() {
  var careerDiv = document.getElementById('careerDiv');

  var newCareer = document.createElement('input');
  newCareer.setAttribute('type', 'text');
  newCareer.setAttribute('class', 'userCareer');
  newCareer.setAttribute('name', 'userCareer[]');
  careerDiv.appendChild(newCareer);
}

function careerSub() {
  var careerDiv = document.getElementById('careerDiv');
  var lastCareer = careerDiv.lastChild;

  careerDiv.removeChild(lastCareer);
}
