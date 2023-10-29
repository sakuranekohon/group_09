var html = document.getElementsByClassName('member_window_manage_member_list')[0].getElementsByTagName('ul')[0];
var sum;
const level_arr = [];
var sex_arr = [];
function load() {
  var postData = new FormData();
  axios.get('./backend/member.php?ac=all')
    .then( (response) => {
      console.log(response.data);
      //console.log(response.data.data);
      // console.log(response.data);
      // console.log(response.data.total);
      // sum = response.data.total;
      // console.log('sum'+sum);
      console.log(html);
      for (let i = 0; i < response.data.data.length; i++) {
        
        level_arr.push(response.data.data[i].level);
        sex_arr.push(response.data.data[i].sex);
        html.innerHTML += '<li>'
          + '<div class="member_window_manage_member_description">'
          + '<button type="button" onclick="moreinfo(this)">'
          + '<span>' + response.data.data[i].id + '</span>'
          + '<span>' + response.data.data[i].user + '</span>'
          + '<span>' + response.data.data[i].createDate.split('T')[0] + '</span>'
          + '</button>'
          + '<div class="member_window_manage_member_details member_window_item_padding">'
          + '<div class="member_window_item_cutting"></div>'
          + '<form name="form" action=""  method="post">'
          + '<div class="member_window_member_info" style="margin: 7px 0px;">'
          + '<div class="member_window_member_info_level"><span>會員等級：</span>'
          + '<select name="level" id="level'+i+'" disabled>'
          + '<option value="copper">copper</option>'
          + '<option value="silver">silver</option>'
          + '<option value="golden">golden</option>'
          + '</select>'
          + '</div>'
          + ' <div class="member_window_member_info_name"><span>會員名稱：</span><input'
          + ' type="text" value="' + response.data.data[i].user + '" id="username" disabled>'
          + '<span id="nametxt" class="errormsg"></span>'
          + '</div>'
          + '<div class="member_window_member_info_mail"><span>電子信箱：</span><input'
          + ' type="email" value="' + response.data.data[i].mail + '" id="mail" disabled></span>'
          + '<span id="mailtxt" class="errormsg"></span>'
          + '</div>'
          + '<div class="member_window_member_info_phone"><span>電話號碼：</span><input'
          + ' type="text" value="' + response.data.data[i].phone + '" id="phone" disabled>'
          + '<span id="phonetxt" class="errormsg"></span>'
          + '</div>'
          + '<div class="member_window_member_info_sex"><span>性　　別：</span>'
          + '<select name="sex" id="sex" disabled>'
          + '<option value="none">未設定</option>'
          + '<option value="男">男</option>'
          + '<option value="女">女</option>'
          + '</select>'
          + '</div>'
          + '<div class="member_window_member_info_address"><span>通訊地址：</span><input type="text" value="' + response.data.data[i].address + '" id="address" disabled>'
          + '<span id="addresstxt" class="errormsg"></span>'
          + '</div>'
          + '</div>'
          + '<div class="member_window_item_cutting"></div>'
          + '<div class="member_window_member_btn">'
          + '<div class="member_window_member_accept"><button type="button" onclick=" modify(this)">修改內容</button>'
          + '</div>'
          + '<div class="member_window_member_delete"><button type="button" onclick="remove(this)">刪除帳號</button>'
          + '</div>'
          + '</div>'
          + '</form>'
          + '</div>'
          + '</div>'
          + '</li>';

        var level = response.data.data[i].level;
        var tar1 = document.querySelectorAll('.member_window_member_info_level select')[i];
        console.log(tar1);
        
        for (var j = 0; j < tar1.options.length; j++) {
          console.log('in loop = ',j,",",level,',',tar1.options[j].value);
          if (tar1.options[j].value === level) {
            tar1.selectedIndex = j;
            tar1.options[j].selected = true;
            console.log(tar1.options);
            console.log(tar1.selectedIndex);
            break;
          }
        }
      }

    })
    .catch( (error)=> {
      console.log(error);
    });
  // for(i = 0; i < sum; i++){
  //   var level = response.data.data[i].level;
  //   var tar1 = document.querySelectorAll('member_window_member_info_level');
  //   console.log(tar1);
  //   // tar1=tar[i].getElementsByTagName('select')[0];
  //   for (j = 0; j < 3; j++) {
  //     if (tar1[i].getElementsByTagName('select')[0].options[j].value == level) {
  //       tar1[i].selectedIndex = j;
  //       break;
  //     }
  //   }

  //   var sex = response.data.data[i].sex;
  //   var tar = document.querySelectorAll('member_window_member_info_sex');
  //   for (j = 0; j < 3; j++) {
  //     if (tar[i].getElementsByTagName('select')[0].options[j].value == sex) {
  //       tar[i].selectedIndex = j;
  //       break;
  //     }
  //   }
  //   console.log(i);
  // }
}

// load();
var i;
function set() {
  var form=document.getElementsByClassName('member_window_right')[0].querySelectorAll('li');
  // console.log(form);
  for (i = 0; i < form.length; i++) {
    var level=form[i].getElementsByTagName('select')[0].className;
    var sex=form[i].getElementsByTagName('select')[1].className;
    if (level == 1) {
      form[i].getElementsByClassName('member_window_member_info_level')[0].querySelector('select').selectedIndex = 0;
    }
    else if (level == 2) {
      form[i].getElementsByClassName('member_window_member_info_level')[0].querySelector('select').selectedIndex = 1;
    }
    else {
      form[i].getElementsByClassName('member_window_member_info_level')[0].querySelector('select').selectedIndex = 2;
    }

    if(sex=='男')
    form[i].getElementsByClassName('member_window_member_info_sex')[0].querySelector('select').selectedIndex = 1;
    else if(sex=='女')
    form[i].getElementsByClassName('member_window_member_info_sex')[0].querySelector('select').selectedIndex = 2;
    else
    form[i].getElementsByClassName('member_window_member_info_sex')[0].querySelector('select').selectedIndex = 0;
    
  }

}


set();


var expend;
function moreinfo(element) {
  var info1 = element.parentElement;
  var info = info1.querySelector(".member_window_item_padding");
  console.count(info1.className);
  if (info.style.display == "none")
    expend = false;
  else
    expend = true;

  if (expend == false) {
    info.style.display = "block";
    expend = true;
  } else {
    info.style.display = "none";
    expend = false;
  }

};


function validateForm(element) {
  var target = element.closest('form');

  var check = true;

  var user = target.getElementsByClassName('member_window_member_info_name')[0];
  var userval = user.getElementsByTagName('input')[0].value;
  var usertxt = target.getElementsByClassName('errormsg')[0];
  if (userval == "" || userval == null) {
    usertxt.innerHTML = "請輸入使用者名稱";
    check = false;
  }
  else
    usertxt.innerHTML = "";

  var mail = target.getElementsByClassName('member_window_member_info_mail')[0];
  var mailval = mail.getElementsByTagName('input')[0].value;
  var mailtxt = target.getElementsByClassName('errormsg')[1];
  if (mailval == "" || mailval == null) {
    mailtxt.innerHTML = "請輸入電子郵件";
    check = false;
  }
  else
    mailtxt.innerHTML = "";

  var phone = target.getElementsByClassName('member_window_member_info_phone')[0];
  var phoneval = phone.getElementsByTagName('input')[0].value;
  var phonetxt = target.getElementsByClassName('errormsg')[2];
  console.log(phonetxt.closest('div'));
  if (phoneval == "" || phoneval == null) {
    phonetxt.innerHTML = "請輸入電話號碼";
    check = false;
  }
  else if (isNaN(phoneval) || phoneval.length != 10) {
    phonetxt.innerHTML = "請輸入正確的電話號碼";
    check = false;
  }
  else {
    phonetxt.innerHTML = "";
  }

  var addr = target.getElementsByClassName('member_window_member_info_address')[0];
  var addrval = addr.getElementsByTagName('input')[0].value;
  var addrtxt = addr.getElementsByTagName('span')[1];
  if (addrval == "" || addrval == null) {
    addrtxt.innerHTML = "請輸入通訊地址";
    check = false;
  }
  else
    addrtxt.innerHTML = "";

  var level = target.getElementsByTagName('select')[0].value;

  var sex = target.getElementsByTagName('select')[1].value;

  var number = target.closest('.member_window_manage_member_description');
  number = number.getElementsByTagName('button')[0];
  number = number.getElementsByTagName('span')[0].innerHTML

  console.log(number);
  if (check) {
    var temp=element.closest('li');
    temp=temp.querySelector('button').querySelectorAll('span')[1];
    temp.innerHTML=userval;
    var data = {
      id: number,
      level: level,
      user: userval,
      mail: mailval,
      phone: phoneval,
      sex: sex,
      address: addrval
    };
    var postData = new FormData();

    for (const [key, value] of Object.entries(data)) {
      postData.append(key, value);
    }

    console.log(postData);

    axios.put('./backend/member.php?ac=update_account', postData)
      .then(function (response) {
        console.log(response.data);
        console.log("data require");
      })
      .catch(function (error) {
        console.log(error);

      });
  }
  return check;
}


var disable = true;
var submit = false;
var first = true;
var count = 0;
function modify(element) {
  var f = element.closest('form');
  var text = f.getElementsByTagName('input');

  if (!disable && count > 0) {
    submit = validateForm(element);
  }

  if (disable && !submit) {
    f.getElementsByTagName('button')[0].innerHTML = "確認修改";
    disable = false;
    pre = !disable;
    first = false;
  }
  else if (!disable && submit) {
    f.getElementsByTagName('button')[0].innerHTML = "修改內容";
    disable = true;
    pre = !disable;
    submit = false;
  }

  for (i = 0; i < text.length; i++) {
    text[i].disabled = disable;
  }
  f.getElementsByTagName('select')[0].disabled = disable;
  f.getElementsByTagName('select')[1].disabled = disable;

  count++;
}


function remove(element) {
  var target = element.closest('li');

  var number = target.getElementsByClassName('member_window_manage_member_description')[0];
  number = number.getElementsByTagName('button')[0].getElementsByTagName('span')[0].innerHTML;

  var data={
    id:number
  }
  var postData = new FormData();
  for (const [key, value] of Object.entries(data)) {
    postData.append(key, value);
  }

  axios.post('./backend/member.php?ac=delete_account', postData)
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  
    target.remove();
}

function levelcheck() {
  var url = "./backend/loginout.php?ac=checklevel";
  axios.get(url)
    .then((respone) => {
      if (respone.data.success) {
        if (respone.data.level != 3) {
          location.href = "./nolevel.php"
        }
      } else {
        location.href = "./login.php";
      }
    })
    .catch((error) => {
      console.error(error);
    });
}
levelcheck();
