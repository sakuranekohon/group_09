function checklogin() {
    var url = "./backend/loginout.php?ac=checklogin";
    axios.get(url)
      .then((respone) => {
        if (!respone.data.success) {
          location.href = "./login.php";
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  checklogin();