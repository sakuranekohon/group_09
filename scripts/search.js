function search_k(e){
    // var value=document.getElementsByClassName('bar_middle')[0].querySelector('input').value;
    console.log(e.code);
    var postData = new FormData();
    var body =  document.getElementsByTagName('body')[0].clientWidth;
    if(body >600){
      var value=document.getElementsByClassName('bar_middle')[0].querySelector('input').value;
      document.getElementById('innSearch').value = value;
    }else{
      var value=document.getElementById('innSearch').value;
      console.log(value);
      document.getElementsByClassName('bar_middle')[0].querySelector('input').value = value;
    }
      
      var data = {
        search:value,
      };

      for (const [key, value] of Object.entries(data)) {
        postData.append(key, value);
      }

      console.log(data);

      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };
    var html=document.querySelector('.recommend_product');
    
    axios.post('./backend/product.php?ac=search', postData, config)
      .then((response) => {
        console.log(response.data);
        html.innerHTML="";
        for(var i=0;i<response.data.data.length;i++){
          html.innerHTML+='<a href="./product_page/' +response.data.data[i].name+ '.html" target="_self" class="product_size">'
          +'<div>'
          +    '<img src="backend/images/' + response.data.data[i].image +'"  alt="product">'
          +'</div>'
          +'<div class = "product_name_money"><span>' +response.data.data[i].name+ '</span></div>'
          +'</a>';
        }
        if (!response.data.success)
          alert(response.data.message);
      })
      .catch(error => {
        console.error(error);
      });
}