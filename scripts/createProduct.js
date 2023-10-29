//圖片名稱載入
// function img_load(){
//   var target=document.getElementById('img_name');
//   var img=document.getElementById('product_image');
//   target.innerHTML=img.files[0]['name'];
// }

//var accept = document.getElementById('accept');
//var clear = document.getElementById('clear');
//accept.addEventListener('click',validateForm);
//clear.addEventListener('click',remove);

var fileInput = document.getElementById("product_image");
var previewImage = document.getElementById("img");
//var uploadForm = document.getElementById("upload-form");

fileInput.addEventListener("change", function (event) {
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onload = function (e) {
    previewImage.src = e.target.result;
  };

  reader.readAsDataURL(file);
});


function img_submit() {
  //element.preventDefault();

  var file = fileInput.files[0];
  console.log(file);
  return file;
}

function validateForm(element) {
  var check = true;

  var img = document.getElementById('product_image');
  if (img.files.length == 0) {
    document.getElementById('imgtxt').innerHTML = "必填";
    check = false;
  }
  else {
    document.getElementById('imgtxt').innerHTML = "";
  }

  var name = document.forms['form']['name'].value;
  if (name == "" || name == null) {
    document.getElementById("nametxt").innerHTML = "必填";
    check = false;
  }else if(name.length > 32){
    document.getElementById("nametxt").innerHTML = "名稱請小於32個字";
    check = false;
  }
  else
    document.getElementById("nametxt").innerHTML = "";

  var price = document.forms['form']['price'].value;
  if (price == "" || price == null) {
    document.getElementById('pricetxt').innerHTML = "必填";
    check = false;
  }
  else
    document.getElementById('pricetxt').innerHTML = "";

  var quanity = document.forms['form']['quanity'].value;
  if (quanity == "" || quanity == null) {
    document.getElementById('quanitytxt').innerHTML = "必填";
    check = false;
  }
  else if (isNaN(quanity) || quanity <= 0) {
    document.getElementById('quanitytxt').innerHTML = "請輸入正確的數量";
    check = false;
  }
  else {
    document.getElementById('quanitytxt').innerHTML = "";
  }

  var tag = document.forms['form']['tag'].value;
  if (tag == "" || tag == null) {
    document.getElementById('tagtxt').innerHTML = "必填";
    check = false;
  }
  else
    document.getElementById('tagtxt').innerHTML = "";

  var content = document.forms['form']['content'].value;
  if (content == "" || content == null) {
    document.getElementById('contenttxt').innerHTML = "必填";
    check = false;
  }
  else
    document.getElementById('contenttxt').innerHTML = "";
  console.log(check);

  var postData = new FormData();
  postData.append('image',img_submit(fileInput));
  if (check) {
    var data = {
      name: name,
      price: price,
      quanity: quanity,
      content: content,
      tag: tag,
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

    axios.post('./backend/product.php?ac=create', postData, config)
      .then((response) => {
        console.log(response.data);
        if(response.data.success){
          location.href = "manageProduct.php"
        }
        if(!response.data.success)
          alert(response.data.message);
      })
      .catch(error => {
        console.error(error);
      });
  }
  return check;
}


function remove() { //clear ettortxt
  var f = document.getElementsByClassName('member_window_manage_product_product_attr')[0];
  var text = f.getElementsByTagName('input');
  console.log(text);
  for (i = 0; i < text.length; i++) {
    text[i].value = "";
  }
  f.getElementsByTagName('textarea')[0].value = "";

  var error = document.getElementsByClassName('errormsg');
  for (i = 0; i < error.length; i++) {
    error[i].innerHTML = '';
  }
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