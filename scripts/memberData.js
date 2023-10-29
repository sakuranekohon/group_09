var id;
function load() {
  var memberData;

  axios.get('./backend/member.php?ac=get')
    .then(function (response) {
      memberData = response.data.data;
      console.log(memberData);
      var h=document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
      console.log(h);
      if (response.data.data.level == '1')
      {
        document.getElementsByClassName('member_window_member_info_level')[0].getElementsByTagName('span')[1].innerHTML = 'cooper';
        
        
        for(var i=4;i<h.length-1;i++)
        {
          h[i].style.display="none";
        }
      }
      else if (response.data.data.level == '2')
      {
        document.getElementsByClassName('member_window_member_info_level')[0].getElementsByTagName('span')[1].innerHTML = 'silver';
        // var h=document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
        for(var i=4;i<h.length-1;i++)
        {
          h[i].style.display="none";
        }
      }
      else if (response.data.data.level == '3')
      {
        document.getElementsByClassName('member_window_member_info_level')[0].getElementsByTagName('span')[1].innerHTML = 'golden';
        // var h=document.getElementsByClassName("member_window_list")[0].getElementsByTagName('li');
        for(var i=4;i<h.length-1;i++)
        {
          h[i].style.display="flex";
        }
      }

      document.getElementsByClassName('member_window_member_info_name')[0].getElementsByTagName('span')[1].innerHTML = response.data.data.user;
      document.getElementsByClassName('member_window_member_info_mail')[0].getElementsByTagName('span')[1].innerHTML = response.data.data.mail;
      document.getElementsByClassName('member_window_member_info_phone')[0].getElementsByTagName('span')[1].innerHTML = response.data.data.phone;
      document.getElementsByClassName('member_window_member_info_address')[0].getElementsByTagName('span')[1].innerHTML = response.data.data.address;

      id = response.data.data.id;
      if (response.data.data.sex == 'none')
        document.getElementsByClassName('member_window_member_info_sex')[0].getElementsByTagName('span')[1].innerHTML = '未設定';
      else if (response.data.data.sex == '男')
      document.getElementsByClassName('member_window_member_info_sex')[0].getElementsByTagName('span')[1].innerHTML = '男';
      else
      document.getElementsByClassName('member_window_member_info_sex')[0].getElementsByTagName('span')[1].innerHTML = '女';
    
      document.getElementsByClassName('member_window_member_info_joinday')[0].getElementsByTagName('span')[1].innerHTML = response.data.data.createDate.split(' ')[0];
    })
    .catch(function (error) {
      console.log(error);
    });

  // document.forms['form']['username'].value()=memberData.user;
  // document.forms['form']['mail'].value()=response.data.data.mail;
  // document.forms['form']['phone'].value()=response.data.data.phone;
  // document.forms['form']['address'].value()=response.data.data.address;

  // console.log(document.getElementsByClassName('member_window_member_info_name')[0].getElementsByTagName('input')[0]);
  // document.getElementsByClassName('member_window_member_info_name')[0].getElementsByTagName('input')[0].value()=response.data.data.user;
  // console.log(memberData.user);
}
load();
