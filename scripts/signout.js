function signout(){
    axios.get('/backend/member.php?ac=logout', postData)
      .then(function (response) {
        console.log(response.data);
        console.log("data require");
        if(response.data.success)
          location.href='index.html';
        else{
          alert(response.data.message);
        }
      })
      .catch(function (error) {
        console.log(error);
      });
}