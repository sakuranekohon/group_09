function generateRandomNumbers(n) {
  var numbers = [];

  while (numbers.length < 5) {
    var randomNumber = Math.floor(Math.random() * n);

    if (!numbers.includes(randomNumber)) {
      numbers.push(randomNumber);
    }
  }

  return numbers;
}
var randomNumbers = generateRandomNumbers(100);
console.log(randomNumbers);

function recommand(){
  var tar=document.getElementsByClassName('recommend_product')[0];
  var pro=document.getElementsByClassName('recommend_product')[1].querySelectorAll('a');
  console.log(pro.length);
  var randomNumbers = generateRandomNumbers(pro.length);
  
  var count=0;
  var n=0;
  var i,t;
  var html="";
  for(i=0;i<5;i++){
    clone=pro[randomNumbers[i]].cloneNode(true);
    tar.appendChild(clone);

  }
  return html;
  // num.forEach(html+=pro[1].cloneNode(true))
}


recommand();
