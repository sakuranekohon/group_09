var expend;
function moreinfo(element) {
  var info1 = element.parentElement;
  var info2 = info1.parentElement;
  var info = info2.querySelector(".member_window_item_padding");
  //console.count(info.className);
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

document.addEventListener('change', function (event) {
  // 檢查觸發事件的元素是否為 fileInput
  if (event.target.classList.contains('fileInput')) {
    console.log('into');
    var fileInput = event.target;
    var file = fileInput.files[0];

    var reader = new FileReader();
    reader.onload = function (e) {
      var previewImage = fileInput.closest('.member_window_manage_product_product_image').querySelector('img');
      previewImage.src = e.target.result;
      console.log(previewImage);
    };
    reader.readAsDataURL(file);
  }
});


function img_submit(fileInput) {
  // fileInput.preventDefault();

  if(fileInput.files.length>0){
    var file = fileInput.files[0];
    console.log(file);
    return file;
  }
}

var postData = new FormData();

var disable = true;
var submit = false;

var count = 0;
function modify(element) {
  var f = element.closest('form');
  var text = f.getElementsByTagName('input');
  var first = true;
  console.log(f);
  if (!disable && count > 0) {
    submit = validateForm(f);
  }

  if (disable && !submit) {
    f.getElementsByTagName('button')[0].innerHTML = "確認修改";
    disable = false;
    pre = !disable;
    first = false;
    f.getElementsByClassName('member_window_create_image_upload')[0].style.display = "block";
  }
  else if (!disable && submit) {
    f.getElementsByTagName('button')[0].innerHTML = "修改內容";
    disable = true;
    pre = !disable;
    submit = false;
    f.getElementsByClassName('member_window_create_image_upload')[0].style.display = "none";
    count = 0;
  }

  for (i = 1; i < text.length; i++) {
    text[i].disabled = disable;
  }
  f.getElementsByTagName('textarea')[0].disabled = disable;
  count++;
}

function remove(element) {
  var target = element.closest('li');
  target.remove();

  var number = target.getElementsByClassName('member_window_manage_order_description')[0];
  number = number.getElementsByTagName('button')[0].getElementsByTagName('span')[0].innerHTML;
  var postData = new FormData();

  var data = {
    id: number,
  };

  console.log(data);
  for (const [key, value] of Object.entries(data)) {
    postData.append(key, value);
  }

  console.log(postData);

  const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }; 

  axios.post('./backend/product.php?ac=delete_product', postData, config)
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
}

//表單驗證不知道放在哪
var nameval, priceval, quanityval, contentval;
function validateForm(element) {
  var check = true;

  var img = element.getElementsByClassName('member_window_manage_product_product_image')[0];
  var imgval = img.getElementsByTagName('input')[0];
  var imgtxt = img.getElementsByClassName('errormsg')[0];
  if (imgval.files.length == 0 &&img.querySelector('img').src=="") {
    imgtxt.innerHTML = "必填";
    check = false;
  }
  else {
    imgtxt.innerHTML = "";
  }

  var name = element.getElementsByClassName('member_window_manage_product_product_attr_name')[0].getElementsByTagName('input')[0];
  nameval = name.value;
  var nametxt = element.getElementsByClassName('errormsg')[1];
  if (nameval == "" || nameval == null) {
    nametxt.innerHTML = "請輸入商品名稱";
    check = false;
  }
  else
    nametxt.innerHTML = "";

  var price = element.getElementsByClassName('member_window_manage_product_product_attr_price')[0].getElementsByTagName('input')[0];
  priceval = price.value;
  var pricetxt = element.getElementsByClassName('errormsg')[2];
  if (priceval == "" || priceval == null) {
    pricetxt.innerHTML = "請輸入售價";
    check = false;
  }
  else
    pricetxt.innerHTML = "";

  var quanity = element.getElementsByClassName('member_window_manage_product_product_attr_total')[0].getElementsByTagName('input')[0];
  quanityval = quanity.value;
  var quanitytxt = element.getElementsByClassName('errormsg')[3];
  if (quanityval == "" || quanityval == null) {
    quanitytxt.innerHTML = "請輸入數量";
    check = false;
  }
  else if (isNaN(quanityval) || quanityval <= 0) {
    quanitytxt.innerHTML = "請輸入正確的數量";
    check = false;
  }
  else {
    quanitytxt.innerHTML = "";
  }

  var tag = element.getElementsByClassName('member_window_manage_product_product_attr_tag')[0].getElementsByTagName('input')[0];
  var tagval = tag.value;
  var tagtxt = element.getElementsByClassName('errormsg')[4];
  if (tagval == "" || tagval == null) {
    tagtxt.innerHTML = "請輸入商品標籤";
    check = false;
  }
  else
    tagtxt.innerHTML = "";

  var content = element.getElementsByClassName('member_window_manage_product_product_attr_summary')[0].getElementsByTagName('textarea')[0];
  contentval = content.value;
  var contenttxt = element.getElementsByClassName('errormsg')[5];
  if (contentval == "" || contentval == null) {
    contenttxt.innerHTML = "請輸入商品簡介";
    check = false;
  }
  else
    contenttxt.innerHTML = "";
  console.log(check);
  console.log(img_submit(imgval));
  var postData = new FormData();
  // if(img_submit(imgval)!=undefined){
  //   postData.append('image', img_submit(imgval));
  // }
  postData.append('image', img_submit(imgval));

  var id = element.parentNode.parentNode.getElementsByTagName("span")[0].innerHTML;
  if (check) {
    var temp=element.closest('li');
    temp=temp.querySelector('button').querySelectorAll('span')[1];
    temp.innerHTML=nameval;
    var data = {
      id:id,
      name: nameval,
      price: priceval,
      quanity: quanityval,
      content: contentval,
      tag: tagval
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

    axios.post('./backend/product.php?ac=updata_prodcut', postData, config)
      .then((response) => {
        console.log(response.data);
        if (!response.data.success)
          alert(response.data.message);
      })
      .catch(error => {
        console.error(error);
      });
  }
  return check;
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