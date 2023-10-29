var q=100;
var quanity;
console.log(q);
function minus(){
    q=document.getElementById('quanity').value;
    quanity=parseInt(q);
    //console.log(q);
    if(quanity>1){
        quanity=quanity-1;
    }
    console.log(quanity);
    document.getElementById("quanity").value=quanity.toString();
}

function plus(){

    q=document.getElementById('quanity').value;
    quanity=parseInt(q);
    //console.log(q);
    if(quanity<100)
    {
        quanity=quanity+1;
    }
    console.log(quanity);
    document.getElementById("quanity").value=quanity.toString();
}

function add_cart() {
    var quanity=document.getElementById('quanity');
    console.log(quanity.value);

    var name=document.getElementsByClassName('product_item_item')[0];
    name=name.getElementsByTagName('span')[0].innerHTML;
    console.log(name);

    var data={
        id: document.getElementById("product_id").innerText,
        quanity: quanity.value
    };

    var axiosData = new FormData();
    axiosData.append("id",data.id);
    axiosData.append("quanity",data.quanity);

    const axios_config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
    
    
    axios.post('../backend/cart.php?ac=putcart',axiosData,axios_config)
      .then(function (response) {
        if(!response.data.success){
            location.href="../login.php"
        }
        else{
          alert("加入購物車!");
        }
      })
      .catch(function (error) {
        console.log(error);

      });
}

function load_comment() { 
  var tar=document.querySelector('.product_item_item');
  tar=tar.querySelector('span');
  var html=document.querySelector('.product_comment');
  var axiosData = new FormData();
    axiosData.append("product_name",tar.innerHTML);
    // axiosData.append("quanity",data.quanity);

    const axios_config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };

  axios.post('../backend/history.php?ac=getcomment',axiosData,axios_config)
  .then(function (response) {
    console.log(response.data);
    if(response.data.success){
      var info=response.data.data;
      console.log(info);
        for(var i=0;i<info.length;i++){
          html.innerHTML+='<div class="comment_window">'
          +  '<div class="product_comment_bar">'
          +     '<div class="product_comment_bar_id">'
          +         '<span></span>'
          +     '</div>'
          + '</div>'
          + '<div class="product_comment_comment">'
          +     '<textarea class="comment_message" readonly>'+info[i].comment+'</textarea>'
          + '</div>'
          +'</div>';

          var a=info[i].anonymous;
          if(a==1){
            var t=document.querySelectorAll('.product_comment_bar_id');
            t[i].querySelector('span').innerHTML="Username : Anonymous";
          }
          else{
            var t=document.querySelectorAll('.product_comment_bar_id');
            t[i].querySelector('span').innerHTML="Username : "+info[i].user;
          }
        }
    }
  })
  .catch(function (error) {
    console.log(error);

  });
}

load_comment();

window.onload=function(){
  var tar=document.querySelector('#product_id');
  console.log(tar.innerHTML);
  var postData = new FormData();

  var data = {
    id: tar.innerHTML,
  };

  console.log(data);
  for (const [key, value] of Object.entries(data)) {
    postData.append(key, value);
  }
  
  const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  };

  axios.post('../backend/history.php?ac=postbrowse', postData, config)
    .then((response) => {
      console.log(response.data);
      if(!response.data.success)
        console.log(response.data.message);
    })
    .catch(error => {
      console.error(error);
    });
}