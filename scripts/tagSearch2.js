const axios_config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  };
function tag_sel() {
    console.log("index.js -> tag_sel");
    var tag_list = document.getElementById("tag_list");
    axios.get("../backend/adselect.php?ac=getSel")
      .then((response) => {
        var tag = response.data.data;
        console.log(tag);
        tag.forEach(data => {
          var list = document.createElement("li");
          list.innerText = data.name;
          list.setAttribute('onclick', 'searchTag(this)');
          tag_list.appendChild(list);
        });
      })
      .catch((error) => {
        console.error(error);
      });
  }
  tag_sel();
  
  function searchTag(element) {
    var axiosData = new FormData();
    var data = element.innerText
    axiosData.append('search',data);
    console.log(data);
    console.log(axiosData);
    axios.post("../backend/product.php?ac=searchTag", axiosData, axios_config)
      .then((response) => {
        console.log(response.data);
        if (response.data.success) {
          console.log("A");
          location.href = "../search.php";
        } else {
          console.log("B");
        }
      })
      .catch((error) => {
        console.error(error);
      })
  }