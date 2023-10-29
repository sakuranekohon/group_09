function validateForm() {
    var check = true;

    var username = document.forms['form']['username'].value;
    if (username == "" || username == null) {
      document.getElementById('usernametxt').innerHTML = "必填";
      check = false;
    }
    else
    document.getElementById('usernametxt').innerHTML = "";

    var mail = document.forms['form']['mail'].value;
    if (mail == "" || mail == null) {
      document.getElementById('mailtxt').innerHTML = "必填";
      check = false;
    }
    else
    document.getElementById('mailtxt').innerHTML = "";

    var password = document.forms['form']['password'].value;
    if (password == "" || password == null) {
        document.getElementById('password').innerHTML = "必填";
      check = false;
    }
    else
    document.getElementById('inconsistent').innerHTML = "";

    var repassword = document.forms['form']['repassword'].value;
    if (repassword == "" || repassword == null || repassword!=password) {
      document.getElementById('inconsistent').innerHTML= "The passwords you entered do not match.";
      check = false;
    }
    else
    document.getElementById('inconsistent').innerHTML = "";

    console.log(check);
    if (check) {
      var data = {
        user: document.forms['form']['username'].value,
        mail: document.forms['form']['mail'].value,
        password: document.forms['form']['password'].value,
      };
      
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };

      axios.post('./backend/member.php?ac=signup', data,config)
        .then(function (response) {
          console.log(response.data);
          console.log("data require");
          if(response.data.success)
            location.href="memberSetting.html";
          else{
            alert(response.data.message);
          }
          
        })
        .catch(function (error) {
          console.log(error);
        });
    }
    return check;
  }
  
  
  
  