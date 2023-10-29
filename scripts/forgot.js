function forgot(){
  var mail = document.getElementById('mail').value;
  var user = document.getElementById('username').value;
  var captcha = document.getElementById('cpatchaTextBox').value;
  var check = true;
  if(mail == "" || mail ==undefined || mail == null){
      //console.log("mailerror");
      document.getElementById('mailtxt').innerHTML = "Please enter your mail";
      document.getElementById('mailtxt').style.display = "block";
      check = false;
  }else{
      document.getElementById('mailtxt').style.display = "none";
  }
  if(user == "" || user ==undefined || user == null){
      //console.log("userrerror");
      document.getElementById('usernametxt').innerHTML = "Please enter your usernametxt";
      document.getElementById('usernametxt').style.display = "block";
      check = false;
  }else{
      document.getElementById('usernametxt').style.display = "none";
  }
  if(captcha == "" || captcha ==undefined || captcha == null){
      document.getElementById('captchatxt').innerHTML = "Please enter captcha";
      document.getElementById('captchatxt').style.display = "block";
      createCaptcha();
      check = false;
  }else{
      document.getElementById('captchatxt').style.display = "none";
      if(captcha != code){
          document.getElementById('captchatxt').innerHTML = "captcha no same";
          document.getElementById('captchatxt').style.display = "block";
          createCaptcha();
          check = false;
      }else{
          document.getElementById('captchatxt').style.display = "none";
      }
  }
  if(check){
      var axiosData = new FormData();
      axiosData.append("mail",mail);
      axiosData.append("usermane",user);
      axios.post("./backend/loginout.php?ac=forgot", axiosData, config)
          .then((response) => {
              console.log(response.data);
              if (response.data.success)
                  location.href = "memberSetting.php";
              else {
                  document.getElementById('errortxt').style.display = "block";
                  document.getElementById('errortxt').innerHTML = "Not a this account";
              }
          })
          .catch((error) => {
              console.error(error);
          })
  }
}

var code;
function createCaptcha() {
//clear the contents of captcha div first 
document.getElementById('captcha').innerHTML = "";
var charsArray =
"0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
var lengthOtp = 6;
var captcha = [];
for (var i = 0; i < lengthOtp; i++) {
  //below code will not allow Repetition of Characters
  var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
  if (captcha.indexOf(charsArray[index]) == -1)
    captcha.push(charsArray[index]);
  else i--;
}
var canv = document.createElement("canvas");
canv.id = "captcha";
canv.width = 100;
canv.height = 50;
var ctx = canv.getContext("2d");
ctx.font = "25px Georgia";
ctx.strokeText(captcha.join(""), 0, 30);
//storing captcha so that can validate you can save it somewhere else according to your specific requirements
code = captcha.join("");
document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}

createCaptcha();