var listopen = [false, false, false];

var mobile_menuInfo = document.getElementsByClassName('mobile_menuInfo')[0];
var mobile_menuInfo_tag_list = document.getElementsByClassName('mobile_menuInfo_tag_list')[0];
var mobile_menuInfo_member_list = document.getElementsByClassName('mobile_menuInfo_member_list')[0];


function openlist(element) {
    console.log(element);
    if (element.getAttribute("id") == 'menubtn') {
        listopen[0] = !listopen[0];
        if (listopen[0])
            mobile_menuInfo.style.display = "block";
        else
            mobile_menuInfo.style.display = "none";
    } else if (element.innerText == '商品分類') {
        listopen[1] = !listopen[1];
        if (listopen[1])
            mobile_menuInfo_tag_list.style.display = "block";
        else
            mobile_menuInfo_tag_list.style.display = "none";
    } else if (element.innerText == '會員') {
        var url = "./backend/loginout.php?ac=checklevel";
        var loginUrl = "./login.php";
        var s = location.pathname.split('/');
        if (s[s.length - 2] == 'product_page') {
            url = "../backend/loginout.php?ac=checklevel"
            loginUrl = "../login.php";
        }
        axios.get(url)
            .then((respone) => {
                console.log(respone.data);
                if (respone.data.success) {
                    listopen[2] = !listopen[2];
                    if (listopen[2])
                        mobile_menuInfo_member_list.style.display = "block";
                    else
                        mobile_menuInfo_member_list.style.display = "none";
                } else
                    location.href = loginUrl;
            })
            .catch((error) => {
                console.error(error);
            });
    }
}

function mobile_cart() {
    var url = "./backend/loginout.php?ac=checklogin";
    var cartUrl = "./cart.php";
    var loginUrl = "./login.php";
    var s = location.pathname.split('/');
    if (s[s.length - 2] == 'product_page') {
        url = "../backend/loginout.php?ac=checklogin"
        cartUrl = "../cart.php";
        loginUrl = "../login.php";
    }
    axios.get(url)
        .then((respone) => {
            console.log(respone.data);
            if (respone.data.success) {
                location.href = cartUrl
            } else
                location.href = loginUrl;
        })
        .catch((error) => {
            console.error(error);
        });
}

function levelcheck() {
    var url = "./backend/loginout.php?ac=checklevel";
    var s = location.pathname.split('/');
    var member = document.getElementsByClassName("mobile_menuInfo_member_list")[0].children;
    if (s[s.length - 2] == 'product_page') {
        url = "../backend/loginout.php?ac=checklevel"
        loginUrl = "../login.php";
    }
    axios.get(url)
        .then((respone) => {
            if (respone.data.success) {
                if (respone.data.level != 3) {
                    for (let i = 4; i < member.length; i++) {
                        member[i].style.display = "none"
                    }
                }
            } else {
                for (let i = 0; i < member.length; i++) {
                    member[i].style.display = "none"
                }
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
levelcheck();