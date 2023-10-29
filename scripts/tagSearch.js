const axios_config = {
  headers: {
    'Content-Type': 'multipart/form-data'
  }
};
function tag_sel() {
  var url = "./backend/adselect.php?ac=getSel";
  var s = location.pathname.split('/');
  if (s[s.length - 2] == 'product_page') {
    url = "../backend/adselect.php?ac=getSel"
  }
  console.log("index.js -> tag_sel");
  var tag_list = document.getElementsByClassName("home_sp_sel")[0];
  var tag_list2 = document.getElementById("tag_list");

  axios.get(url)
    .then((response) => {
      var tag = response.data.data;
      console.log(tag);
      tag.forEach(data => {
        var list = document.createElement("li");
        list.innerText = data.name;
        list.setAttribute('onclick', 'searchTag(this)');
        var list2 = document.createElement("li");
        list2.innerText = data.name;
        list2.setAttribute('onclick', 'searchTag(this)');
        tag_list.appendChild(list);
        tag_list2.appendChild(list2);
      });
    })
    .catch((error) => {
      console.error(error);
    });
}
tag_sel();

function searchTag(element) {
  var url = "./backend/product.php?ac=searchTag";
  var s = location.pathname.split('/');
  if (s[s.length - 2] == 'product_page') {
    url = "../backend/product.php?ac=searchTag"
  }
  var axiosData = new FormData();
  var data = element.innerText
  axiosData.append('search', data);
  console.log(data);
  console.log(axiosData);
  axios.post(url, axiosData, axios_config)
    .then((response) => {
      console.log(response.data);
      if (response.data.success) {
        console.log("A");
        location.href = "search.php";
      } else {
        console.log("B");
      }
    })
    .catch((error) => {
      console.error(error);
    })
}