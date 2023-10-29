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