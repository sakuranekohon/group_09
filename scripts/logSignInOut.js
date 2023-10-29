function logout() {
    axios.get("./backend/loginout.php?ac=logout")
        .then((response) => {
            if (response.data.success) {
                location.href = "index.php";
            }
        });
}

const config = {
    headers: {
        'Content-Type': 'multipart/form-data'
    }
};

function login() {
    var data = {
        account: document.getElementById('account').value,
        password: document.getElementById('password').value
    }
    console.log(data);
    if (data.account == null || data.account == undefined || data.account == "" || data.password == null || data.password == undefined || data.password == ""){
        document.getElementById('errortxt').style.display = "block";
        document.getElementById('errortxt').innerText = "The username or password you specified are not correct.";
    }
        
    else {
        var axiosData = new FormData();
        // for (const [key, value] of Object.entries(data)) {
        //     axiosData.append[key, value];
        // };
        axiosData.append("account",data.account);
        axiosData.append("password",data.password);
        axios.post("./backend/loginout.php?ac=login", axiosData, config)
            .then((response) => {
                console.log(response.data);
                if (response.data.success)
                    location.href = "index.php";
                else {
                    document.getElementById('errortxt').style.display = "block";
                    document.getElementById('errortxt').innerHTML = "Not a this account";
                }
            })
            .catch((error) => {
                console.error(error);
            })
    }
}

function signup() {
    var data = {
        mail: document.getElementById('mail').value,
        username: document.getElementById('username').value,
        password: document.getElementById('password').value,
        repassword: document.getElementById('repassword').value,
    }
    console.log(data);
    var check = true
    if (data.mail == null || data.mail == undefined || data.mail == "") {
        document.getElementById('mailtxt').innerHTML = "Please enter your mail";
        document.getElementById('mailtxt').style.display = "block";
        check = false;
    } else {
        document.getElementById('mailtxt').style.display = "none";
    }

    if (data.username == null || data.username == undefined || data.username == "") {
        document.getElementById('usernametxt').innerHTML = "Please enter your username";
        document.getElementById('usernametxt').style.display = "block";
        check = false;
    } else {
        document.getElementById('usernametxt').style.display = "none";
    }
    if (data.password == null || data.password == undefined || data.password == "") {
        document.getElementById('passwordtxt').innerHTML = "Please enter your password";
        document.getElementById('passwordtxt').style.display = "block";
        check = false;
    } else {
        document.getElementById('passwordtxt').style.display = "none";
    }
    if (data.repassword == null || data.repassword == undefined || data.repassword == "") {
        document.getElementById('repasswordtxt').innerHTML = "Please enter your repassword";
        document.getElementById('repasswordtxt').style.display = "block";
        check = false;
    } else {
        document.getElementById('repasswordtxt').style.display = "none";
    }
    if (data.password != data.repassword) {
        document.getElementById('repassword').innerHTML = "The password and the confirmed password do not match."
        document.getElementById('repasswordtxt').style.display = "block";
        check = false;
    } else {
        document.getElementById('repasswordtxt').style.display = "none";
    }
    if (check) {
        var axiosData = new FormData();
        // for (const [key, value] of Object.entries(data)) {
        //     axiosData.append[key, value];
        //     console.log(key, " ", value);
        // };
        axiosData.append("mail",data.mail);
        axiosData.append("username",data.username);
        axiosData.append("password",data.password);

        axios.post("./backend/loginout.php?ac=signup", axiosData, config)
            .then((response) => {
                console.log(response.data);
                if (response.data.success)
                    location.href = "memberSetting.php";
                else {
                    document.getElementById('repasswordtxt').style.display = "block";
                    document.getElementById('repasswordtxt').innerHTML = "mail or username is exist";
                }
            })
            .catch((error) => {
                console.error(error);
            })
    }
}


function intoMemberInfo() {
    var backendurl = "",goweb1 = "",goweb2 = "";
    if(document.getElementById("product_id") === null){
        backendurl = "./backend/loginout.php?ac=checklogin";
        goweb1 = "memberData.php";
        goweb2 = "login.php";
    }else{
        backendurl = "../backend/loginout.php?ac=checklogin";
        goweb1 = "../memberData.php";
        goweb2 = "../login.php";
    }
    axios.post(backendurl)
        .then((response) => {
            if (response.data.success) {
                location.href = goweb1;
            } else {
                location.href = goweb2;
            }
        })
        .catch((error) => {
            console.error(error);
        })
}
