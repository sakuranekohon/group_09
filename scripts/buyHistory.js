function load_level() {
  var memberData;

  axios.get('./backend/member.php?ac=get')
    .then(function (response) {
      memberData = response.data.data;
      console.log(memberData);

    })
    .catch(function (error) {
      console.log(error);
    });
}
load_level();

var expend;

function moreinfo(element) {
  var info1 = element.parentElement;
  var info2 = info1.parentElement;
  var info = info2.querySelector(".member_window_item_padding");
  //console.count(info.className);
  if (info.style.display == "none") expend = false;
  else expend = true;

  if (expend == false) {
    info.style.display = "block";
    expend = true;
  } else {
    info.style.display = "none";
    expend = false;
  }
}

var anonymous = false;
function c(element) {
  anonymous = element.checked;
  //console.log(anonymous);
}

function submit_comment(element) {
  var check=false;
  var el_content = element.closest(
    ".member_window_buyhistory_product_details_progress"
  );
  var id = element.closest('li').querySelector('.member_window_buyhistory_product_number').querySelector('span').innerHTML;
  var content = el_content.getElementsByTagName("textarea")[0].value;
  if (content == null)
    content = "";
  console.log(content);
  console.log(anonymous);

  if (content == "" || content == null) {
    el_content.getElementsByClassName("errormsg")[0].innerHTML = "必填";
    check = false;
  }
  else  
    check=true;

  console.log(check);
  var product = element.closest('.member_window_status_product_details_right').querySelector('.member_window_buyhistory_product_details_price_name');
  product = product.getElementsByTagName('span')[1].innerHTML;
  if (check) {
    var data = {
      id :id,
      product: product,
      anonymous: anonymous,
      comment: content
    };

    console.log(JSON.stringify(data));

    var axiosData = new FormData();
    axiosData.append("product", data.product);
    axiosData.append("anonymous", data.anonymous);
    axiosData.append("comment", data.comment);
    axiosData.append("id", data.id);

    axios.post('./backend/history.php?ac=updata_buy',axiosData,config)
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

function load(){
  var anony=document.querySelectorAll('.member_window_buyhistory_product_details_progress_top');
  var textarea=document.querySelectorAll('textarea');
  var detail=document.querySelectorAll('.member_window_buyhistory_product_details_progress');
  for(var i=0;i<textarea.length;i++){
    var a=anony[i].querySelector('div').querySelector('div').querySelector('span').className;
    if(a=="1")
      anony[i].querySelector('div').querySelector('div').querySelector('input').checked=true;
    else
      anony[i].querySelector('div').querySelector('div').querySelector('input').checked=false;

    if(textarea[i].innerHTML!=""){
      detail[i].querySelector("input").disabled=true;
      detail[i].querySelectorAll("input")[1].disabled=true;
      detail[i].querySelector("textarea").disabled=true;
    }
  }
  console.log(textarea[0].innerHTML);
}

load();