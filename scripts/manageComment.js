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

function load(){
  var form=document.querySelectorAll('.member_window_manage_comment_size');
  for(var i=0;i<form.length;i++){
    var anony=form[i].querySelector('input').className;
    if(anony=="1"){
      form[i].querySelector('input').checked=true;
    }
    else{
      form[i].querySelector('input').checked=false;
    }
  }
}
load();

function remove(element) {
  var target1 = element.closest('.member_window_manage_comment_size');
  var target2 = target1.parentElement;
  var list = target2.closest('li');
  var id = list.getElementsByClassName('member_window_manage_comment_description')[0].getElementsByTagName('span')[0].innerHTML;
  var product = list.getElementsByClassName('member_window_manage_comment_description')[0].getElementsByTagName('span')[1].innerHTML;
  var purchaser=element.closest('.member_window_manage_comment_size').querySelector('.member_window_manage_comment_poname').querySelector('span').querySelector('span').innerHTML;
  var cid=element.closest('.member_window_manage_comment_size').querySelector('.member_window_manage_comment_comment').querySelector('p').className;
  console.log(product);
  console.log(purchaser);
  var data = {
      product: product, //done
      purchaser:purchaser,
      anonymous:false,
      id: cid,
      comment:""
  };
  console.log(data);

  var postData = new FormData();
    for (const [key, value] of Object.entries(data)) {
      postData.append(key, value);
    }

    console.log(postData);

    axios.post('./backend/history.php?ac=updata_buy2', postData)
      .then(function (response) {
        console.log(response.data);
        console.log("data require");
      })
      .catch(function (error) {
        console.log(error);

      });

  target2.remove();
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
