var user = document.forms['form']['username'].value;
var mail = document.forms['form']['mail'].value;
var phone = document.getElementById('phone').value;
var addr = document.forms['form']['address'].value;
var sex = document.getElementById('sex').value;

var id;
function load() {
  var memberData;

  axios.get('./backend/member.php?ac=get')
    .then(function (response) {
      memberData = response.data.data;
      console.log(memberData);
      if (response.data.data.level == '1') {
        document.forms['form']['level'].value = 'cooper';
        var h = document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
        for (var i = 4; i < h.length - 1; i++) {
          h[i].style.display = "none";
        }
      }
      else if (response.data.data.level == '2') {
        document.forms['form']['level'].value = 'silver';
        var h = document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
        for (var i = 4; i < h.length - 1; i++) {
          h[i].style.display = "none";
        }
      }
      else {
        document.forms['form']['level'].value = 'golden';
        var h = document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
        for (var i = 4; i < h.length - 1; i++) {
          h[i].style.display = "flex";
        }
      }

      document.getElementById('username').value = response.data.data.user;
      document.forms['form']['mail'].value = response.data.data.mail;
      document.forms['form']['phone'].value = response.data.data.phone;
      document.forms['form']['address'].value = response.data.data.address;

      id = response.data.data.id;
      var r_sex = response.data.data.sex;
      var tar = document.querySelector('.member_window_member_info_sex').getElementsByTagName('select')[0];
      for (j = 0; j < tar.options.length; j++) {
        if (tar.options[j].value == r_sex) {
          tar.selectedIndex = j;
          return;
        }
      }
    })
    .catch(function (error) {
      console.log(error);
    });

  // document.forms['form']['username'].value()=memberData.user;
  // document.forms['form']['mail'].value()=response.data.data.mail;
  // document.forms['form']['phone'].value()=response.data.data.phone;
  // document.forms['form']['address'].value()=response.data.data.address;

  // console.log(document.getElementsByClassName('member_window_member_info_name')[0].getElementsByTagName('input')[0]);
  // document.getElementsByClassName('member_window_member_info_name')[0].getElementsByTagName('input')[0].value()=response.data.data.user;
  // console.log(memberData.user);
}
load();

function validateForm() {
  user = document.forms['form']['username'].value;
  var check = true;
  if (user == "" || user == null) {
    document.getElementById("nametxt").innerHTML = "請輸入使用者名稱";
    check = false;
  }
  else
    document.getElementById("nametxt").innerHTML = "";

  mail = document.forms['form']['mail'].value;
  if (mail == "" || mail == null) {
    document.getElementById('mailtxt').innerHTML = "請輸入電子郵件";
    check = false;
  }
  else if (!mail.includes("@")) {
    document.getElementById('mailtxt').innerHTML = "請輸入正確的電子郵件";
    check = false;
  }
  else
    document.getElementById('mailtxt').innerHTML = "";

  phone = document.getElementById('phone').value;
  if (phone == "" || phone == null) {
    document.getElementById('phonetxt').innerHTML = "請輸入電話號碼";
    check = false;
  }
  else if (isNaN(phone) || phone.length != 10) {
    document.getElementById('phonetxt').innerHTML = "請輸入正確的電話號碼";
    check = false;
  }
  else {
    document.getElementById('phonetxt').innerHTML = "";
  }

  addr = document.forms['form']['address'].value;
  if (addr == "" || addr == null) {
    document.getElementById('addresstxt').innerHTML = "請輸入通訊地址";
    check = false;
  }
  else
    document.getElementById('addresstxt').innerHTML = "";
  console.log(check);

  sex = document.getElementById('sex').value;
  console.log(sex);

  var password = document.forms['form']['password'].value;
  var repassword = document.forms['form']['repassword'].value;
  if (password != null || password != '') {
    if (password != repassword) {
      document.getElementById('repasswordtxt').innerHTML = "密碼輸入錯誤";
      check = false;
    }
    else {
      document.getElementById('repasswordtxt').innerHTML = "";
    }
  }
  else {
    repassword = '';
  }

  if (check) {
    // document.forms['form']['username'].value = user;
    // document.forms['form']['mail'].value = mail;
    // document.forms['form']['phone'].value = phone;
    // document.forms['form']['address'].value = addr;
    // document.forms['form']['sex'].value = sex;
    var data = {
      user: document.forms['form']['username'].value,
      mail: document.forms['form']['mail'].value,
      phone: document.getElementById('phone').value,
      sex: sex,
      address: document.forms['form']['address'].value,
      password: repassword,
      level: document.forms['form']['level'].value,
      id: id
    };
    console.log(data);

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

    axios.post('./backend/member.php?ac=update_account', postData, config)
      .then(function (response) {
        console.log(response.data);
        console.log("data require");
        if (!response.data.success)
          alert('修改失敗');
        else
          location.href = "index.php";
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  return check;
}

function remove() {
  var postData = new FormData();
  var data = {
    user: document.forms['form']['username'].value,
    mail: document.forms['form']['mail'].value,
    phone: document.getElementById('phone').value,
    sex: sex,
    address: document.forms['form']['address'].value
  };

  for (const [key, value] of Object.entries(data)) {
    postData.append(key, value);
  }
  console.log(postData);

  const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  };

  axios.get('./backend/member.php?ac=delete_account', postData, config)
    .then(function (response) {
      console.log(response.data);
      if (response.data.success)
        alert('刪除帳號成功');
      else
        alert('刪除帳號失敗');
    })
    .catch(function (error) {
      console.log(error);
    });
}