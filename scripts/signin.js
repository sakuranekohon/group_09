function validateForm() {
    var check = true;

    var account = document.forms['form']['account'].value;
    if (account == "" || account == null) {
      document.getElementById('errortxt').innerHTML = "The username or password you specified are not correct.";
      check = false;
    }
    else
    document.getElementById('errortxt').innerHTML = "";
  
    var password = document.forms['form']['password'].value;
    if (password == "" || password == null) {
      document.getElementById('errortxt').innerHTML= "The username or password you specified are not correct.";
      check = false;
    }
    else
    document.getElementById('errortxt').innerHTML = "";

    console.log(check);
    
    if(check){
      var data={
        account: account,
        password: password
      };

      var postData = new FormData();

      for (const [key, value] of Object.entries(data)) {
            postData.append(key, value);
          }
      console.log(postData);
      
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };

      axios.post('./backend/member.php?ac=login', postData,config)
      .then(function (response) {
        console.log(response.data);
        console.log("data require");
        if(response.data.success)
          location.href='index.php';
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
  
  
  
  