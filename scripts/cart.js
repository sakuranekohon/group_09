var html = document.getElementsByClassName('cart_product')[0];
function load() {
  axios.get('./backend/cart.php?ac=all')
    .then(function (response) {
      console.log(response.data.data);
      console.log("data require");
      var info = response.data.data;
      for (let i = 0; i < response.data.data.length; i++) {
        // console.log(info[i]);
        var total_p = parseInt(info[i].price) * parseInt(info[i].quanity);
        html.innerHTML += '<div class="cart_product_item" id="' + info[i].product_id + '">'
          + '<div class="cart_product_item_item" >'
          + '<input type="checkbox">'
          + '<div class="cart_product_item_item_product">'
          + '<a href="' + info[i].name + '.html" target="_self">'
          + '<div>'
          + '<img src="backend/images/' + info[i].image + '" class="cart_product_item_img">'
          + '</div>'
          + '</a>'
          + '<a href="' + info[i].name + '" target="_self">' + info[i].name + '</a>'
          + '</div>'
          + '</div>'

          + '<div class="cart_product_item_price">'
          + ' <span>＄' + info[i].price + '</span>'
          + '</div>'
          + '<div class="cart_product_item_quality">'
          + '<div>'
          + ' <button type="button" onclick="minus(this)"><img src="images/minus.svg"'
          + ' alt="minus"></button>'
          + '<input type="text" value="' + info[i].quanity + '" name="quanity" id="quanity" disabled>'
          + '<button type="button" onclick="plus(this)"><img src="images/plus.svg" alt="plus"></button>'
          + '</div>'
          + '</div>'
          + '<div class="cart_product_item_totalprice">'
          + '<span>＄' + total_p + '</span>'
          + '</div>'
          + '<div class="cart_product_item_delete">'
          + '<button onclick="remove(this)">刪除</button>'
          + '</div>'
          + '</div>'
      }
    })
    .catch(function (error) {
      console.log(error);

    });
}

load();
var q = 1000;
var quanity;
console.log(q);
function minus(element) {
  var target = element.closest('.cart_product_item_quality');
  q = target.getElementsByTagName('input')[0].value;
  quanity = parseInt(q);
  if (quanity > 1) {
    quanity = quanity - 1;
  }
  console.log(quanity);
  target.getElementsByTagName('input')[0].value = quanity.toString();

  var t = element.closest('.cart_product_item');
  var data = {
    id: t.id,
    quanity: quanity
  }
  var axiosData = new FormData();
  axiosData.append("id", data.id);
  axiosData.append("quanity", data.quanity);
  console.log(JSON.stringify(data));
  axios.post('./backend/cart.php?ac=update_cart', axiosData, config)
    .then(function (response) {
      console.log(response.data);
      console.log("data require");
    })
    .catch(function (error) {
      console.log(error);

    });
}

function plus(element) {
  var target = element.closest('.cart_product_item_quality');
  q = target.getElementsByTagName('input')[0].value;
  quanity = parseInt(q);
  //console.log(q);
  if (quanity < 1000) {
    quanity = quanity + 1;
  }
  console.log(quanity);
  target.getElementsByTagName('input')[0].value = quanity.toString();

  var t = element.closest('.cart_product_item');
  var data = {
    id: t.id,
    quanity: quanity
  }
  var axiosData = new FormData();
  axiosData.append("id", data.id);
  axiosData.append("quanity", data.quanity);
  console.log(JSON.stringify(data));
  axios.post('./backend/cart.php?ac=update_cart', axiosData, config)
    .then(function (response) {
      console.log(response.data);
      console.log("data require");
    })
    .catch(function (error) {
      console.log(error);

    });
}

function remove(element) {
  var target = element.closest(".cart_product_item");
  console.log(target.id);
  var axiosData = new FormData();
  axiosData.append("id", target.id);
  axios.post('./backend/cart.php?ac=delete_cart', axiosData, config)
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  target.remove();
}

function sel_all(element) {
  var check = element.checked;
  if (check) {
    var target = element.closest(".cart_div");
    var checkbox = target.getElementsByClassName("cart_product_item");

    for (i = 0; i < checkbox.length; i++) {
      checkbox[i].getElementsByTagName("input")[0].checked = true;
    }
  }
  if (!check) {
    var target = element.closest(".cart_div");
    var checkbox = target.getElementsByClassName("cart_product_item");

    for (i = 0; i < checkbox.length; i++) {
      checkbox[i].getElementsByTagName("input")[0].checked = false;
    }
  }
}
var product;
var productval = '';
var quaval = '';
var total_p;
var sum_price=0;
var empty = true;
function checkout() {
  empty = true;
  document.getElementsByClassName('cart_div')[0].style.display = 'none';
  document.getElementsByClassName('cart_check')[0].style.display = 'block';
  product = document.querySelectorAll(".cart_product_item");
  sum_price = 0;
  var sum_item = 0;
  var checkout_page = document.querySelector(".cart_checkout_page");

  for (i = 0; i < product.length; i++) {
    if (product[i].querySelector("input").checked) {
      empty = false;
      
    }
  }

  if (!empty) {
    document.getElementsByClassName('cart_div')[0].style.display = 'none';
    document.getElementsByClassName('cart_check')[0].style.display = 'block';
  }
  else {
    document.getElementsByClassName('cart_div')[0].style.display = 'block';
    document.getElementsByClassName('cart_check')[0].style.display = 'none';
  }
  for (i = 0; i < product.length; i++) {
    if (product[i].querySelector("input").checked) {
      console.log(product[i]);
      var price = parseInt(product[i].getElementsByClassName('cart_product_item_price')[0].getElementsByTagName('span')[0].innerHTML.substr(1));
      var qua = parseInt(product[i].getElementsByClassName('cart_product_item_quality')[0].querySelector('input').value);
      total_p = price * qua;
      console.log(product[i].closest('div').id);
      checkout_page.innerHTML += '<div class="cart_checkout_page_product" id="c' + product[i].closest('div').id + '">'
        + '<div class="cart_checkout_page_product_item" >'
        + '<div>'
        + product[i].querySelector("img").outerHTML //.setAttribute('class','cart_product_item_img')
        + '</div>'
        + '<div>　' + product[i].getElementsByClassName('cart_product_item_item_product')[0].getElementsByTagName('a')[1].innerHTML + '</div>'
        + '</div>'
        + '<div class="cart_checkout_page_product_price" >'
        + '<span>' + product[i].getElementsByClassName('cart_product_item_price')[0].getElementsByTagName('span')[0].innerHTML + '</span>'
        + '</div>'
        + '<div class="cart_checkout_page_product_quanity" >'
        + '<span>' + qua + '</span>'
        + '</div>'
        + '<div class="cart_checkout_page_product_totalprice">'
        + '<span>$' + total_p + '</span>'
        + '</div>'
        + '</div>';

      productval += product[i].getElementsByClassName('cart_product_item_item_product')[0].getElementsByTagName('a')[1].innerHTML + ",";
      quaval += qua + ",";
      sum_price += total_p;
      sum_item += qua;
      console.log(productval);
    }
  }
  document.getElementsByClassName('cart_checkout_info')[0].getElementsByTagName('span')[1].innerHTML = "$" + sum_price;
  document.getElementsByClassName('cart_checkout_info')[0].getElementsByTagName('span')[2].innerHTML = "　(共" + sum_item + "個商品)　";
}


var succ_order;
function submit() {
  var target = document.getElementsByClassName('cart_checkout_puchaser')[0].getElementsByTagName('input');
  var msg = document.getElementsByClassName('cart_checkout_puchaser')[0].getElementsByClassName('errormsg');
  var name = target[0].value;
  var phone = target[1].value;
  var mail = target[2].value;
  var check = true;
  if (name == null || name == '') {
    msg[0].innerHTML = "必填";
    check = false;
  }
  else
    msg[0].innerHTML = "";

  if (phone == null || phone == '') {
    msg[1].innerHTML = "必填";
    check = false;
  }
  else if (phone.length!=10||isNaN(phone)) {
    msg[1].innerHTML = "輸入正確電話";
    check = false;
  }
  else
    msg[1].innerHTML = "";

  if (mail == null || mail == '') {
    msg[2].innerHTML = "必填";
    check = false;
  }
  else if (!mail.includes("@")) {
    msg[2].innerHTML = "輸入正確mail";
    check = false;
  }
  else
    msg[2].innerHTML = "";

  var paid = document.getElementsByClassName('cart_checkout_method')[0].getElementsByTagName('input');
  console.log(paid);
  var method;
  var i;
  for (i = 0; i < paid.length; i++) {
    if (paid[i].checked) {
      method = paid[i].value;
      console.log(method);
      break;
    }
  }
  if (i == paid.length) {
    document.getElementsByClassName('cart_checkout_method')[0].getElementsByTagName('span')[1].innerHTML = "必填";
    check = false;
  }
  else
    document.getElementsByClassName('cart_checkout_method')[0].getElementsByTagName('span')[1].innerHTML = "";

  var remark = document.getElementsByClassName('cart_checkout_remark')[0].getElementsByTagName('textarea')[0].value;
  console.log(sum_price);
  if (check) {
    var data = {
      product_name: productval,
      purchaser: name,
      quanity: quaval,
      totalprice: sum_price,
      payment: method,
      remark: remark,
      status: "0"
    };
    var axiosData = new FormData();
    // console.log(JSON.stringify(data));
    axiosData.append("product_name",data.product_name);
    axiosData.append("purchaser",data.purchaser);
    axiosData.append("quanity",data.quanity);
    axiosData.append("totalprice",data.totalprice);
    axiosData.append("payment",data.payment);
    axiosData.append("remark",data.remark);
    axiosData.append("status",data.status);

  succ_order=true;

    axios.post('./backend/order.php?ac=buyorder', axiosData, config)
      .then(function (response) {
        console.log(response.data);
        // console.log("data require");
        if(response.data.success){
          location.href="index.php";
          alert("下單成功");
            console.log('success');
        }
        else{
          succ_order=false;
        }
      })
      .catch(function (error) {
        console.log(error);

      });
  }

  product = document.querySelectorAll(".cart_product_item");
  if(succ_order&&check){
  console.log('into')
    for(var i=0;i<product.length;i++){
      if(product[i].querySelector(".cart_product_item_item").querySelector("input").checked){
        console.log(i+" "+product[i].id);
        var axiosData = new FormData();
      axiosData.append("id", product[i].id);
      axios.post('./backend/cart.php?ac=delete_cart', axiosData, config)
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    }
    
  }
  
}
