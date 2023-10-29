function load() {
  var form = document.getElementsByClassName('member_window_manage_order_list')[0].querySelectorAll('form');
  // console.log(form);
  for (var i = 0; i < form.length; i++) {
    var sel = form[i].querySelector('select');
    // if(form[i]!=null){
    //     var status=form[i].className;
    //     console.log(status);
    //     sel.selectedIndex=status;
    // }
    var status = form[i].className;
    sel.selectedIndex = status;
  }

}
load();

function statusChange(event) {
  // 取得目前選擇的值
  const selectedValue = event.value;

  // 執行適當的操作，根據選擇的值
  // console.log('選擇的值為：', selectedValue);

  var tar = event.closest('li');
  // tar=tar.closest('li');
  var id = tar.querySelector('button').querySelector('span').innerHTML;
  var name=event.closest('.member_window_manage_order_product').getElementsByTagName('span')[0].getElementsByTagName('span')[0].innerHTML;
console.log(name);

  var axiosData = new FormData();
  axiosData.append("id",id);
  axiosData.append("product_name",name);
  axiosData.append("state",selectedValue);

  const config = {
    headers: {
        'Content-Type': 'multipart/form-data'
    }
};

  axios.post("./backend/order.php?ac=updata_order", axiosData,config)
    .then((respone) => {
      if (respone.data.success)
        console.log(respone.data.message);
    })
    .catch((error) => {
      console.error(error);
    });

}

// var s=document.querySelectorAll('select');
// for(var i=0;i<s.length;i++){
// s[i].addEventListener('change', statusChange);
// }

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