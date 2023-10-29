function validateAdForm() {
    const ad = document.forms['form_ad']['uploadimg'].value;
}

function validateSelForm() {
    const sel = document.forms['form_sel']['sel'].value;
    var check = true;
    if (sel == "" || sel == null) {
        document.getElementById('seltxt').innerHTML = "必填";
        check = false;
    } else {
        document.getElementById('seltxt').innerHTML = "";
    }
    return check
}

var expend;

function moreinfo_ad() {
  var info = document.getElementsByClassName('member_window_ad')[0];
  console.log(info);
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

function moreinfo_sel() {
    var info = document.getElementsByClassName('member_window_select')[0];
    console.log(info);
    //var info = info2.querySelector(".member_window_item_padding");
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

  //undone
  function remove(element){
    var target=element.closest('li');
    if(target.closest('div').className=='member_window_ad_list'){
      var name=target.querySelector('img').id;
      var data = {
        name: name
      };

      var postData = new FormData();

      for (const [key, value] of Object.entries(data)) {
        postData.append(key, value);
      }
  
      console.log(data);
      console.log(postData);
  
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
  
      axios.post('./backend/adselect.php?ac=deleteAD', postData, config)
        .then((response) => {
          console.log(response.data);
          if (response.data.success)
            console.log(response.data.message);
        })
        .catch(error => {
          console.error(error);
        });
    }
    else{
      var name=target.querySelector('span').innerHTML;
      var data = {
        name: name
      };

      var postData = new FormData();

      // for (const [key, value] of Object.entries(data)) {
      //   postData.append(key, value);
      // }
      postData.append("name",data.name);
      console.log(data);
      console.log(postData);
  
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
  
      axios.post('./backend/adselect.php?ac=deleteSel', postData, config)
        .then((response) => {
          console.log(response.data);
          if (response.data.success)
            console.log(response.data.message);
        })
        .catch(error => {
          console.error(error);
        });
    }
    target.remove();
    
  }

  var upload=document.getElementsByName('form_ad')[0];
  upload=upload.getElementsByTagName('input')[0];
  function ad_showname(){
    var name=document.getElementById('img_name');
    name.innerHTML=upload.files[0]['name'];
  }
  
  var fileInput=document.getElementById('uploadimg');
  function img_submit(fileInput) {
    // fileInput.preventDefault();
  
    if(fileInput.files.length>0){
      var file = fileInput.files[0];
      console.log(file);
      return file;
    }
  }
  
  var success=false;
  function add_ad()
  {
    success=false;
    if(upload.files.length==0)
    {
      document.getElementById('ad_error').innerHTML="必填";
    }
    else
    {
      document.getElementById('ad_error').innerHTML="　　";
      success=true;
    }
   
    if(success){
      var postData = new FormData();
      postData.append('image', img_submit(fileInput));
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
  
      axios.post('./backend/adselect.php?ac=createAD', postData, config)
        .then((response) => {
          console.log(response.data);
          if (response.data.success)
          {
            var tar=document.getElementsByTagName('ul')[1];
            tar.innerHTML+='<li><div>'
            +'<form action="">'
            +    '<img src="./backend/ADimages/'+response.data.img+'" alt="">'
            +    '<button type="button" onclick="remove(this)">移除</button>'
            +'</form>'
            +'</div></li>';
          }
        })
        .catch(error => {
          console.error(error);
        });

      
    }
    return success;
  }

  function add_sel(){
    var check=true;
    var key=document.getElementById('sel').value;
    if(key==''||key==null){
      document.getElementById('seltxt').innerHTML="必填";
      check=false;
    }
    else{
      document.getElementById('seltxt').innerHTML="　　";
    }
    if (check) {
      var data = {
        name: key
      };

      var postData = new FormData();

      for (const [key, value] of Object.entries(data)) {
        postData.append(key, value);
      }
  
      console.log(data);
      console.log(postData);
  
      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
  
      axios.post('./backend/adselect.php?ac=createSel', postData, config)
        .then((response) => {
          console.log(response.data);
          if (response.data.success)
            var tar=document.getElementsByTagName('ul')[2];
            tar.innerHTML+='<li>'
            +'<div>'
            +    '<form action="" method=""><span>'+response.data.tag+'</span><button type="button" onclick="remove(this)">移除</button></form>'
            +'</div>'
            +'</li>';
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