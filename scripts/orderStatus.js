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

function updateProgressBar(element) {
  //var progressBar = document.querySelector(".progress");
  var progress;
  var target=element.querySelector('input').value;
  //console.log(target);
  if(target==0)
    progress='0%';
  else if(target==1)
    progress='25%';
  else if(target==2)
    progress='50%';
  else if(target==3)
    progress='75%';
  else
    progress="100%";
  
    element.style.width = progress ;
  //console.log(progressBar);
}

// 使用範例，將進度更新為 50%
var state=document.querySelectorAll('.progress');
for(i=0;i<state.length;i++)
{
  updateProgressBar(state[i]);
}
//updateProgressBar(50);


function remove(element) {
  var target = element.closest('li');
  target.remove();

  var number = target.querySelector('.member_window_status_product_description').querySelector('span');
  var n=number.innerHTML

  var postData = new FormData();

  var data = {
    id: n,
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

  axios.post('./backend/order.php?ac=deldect_order', postData, config)
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
}