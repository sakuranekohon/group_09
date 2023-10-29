<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No level to ADS</title>
    <link rel="stylesheet" href="styles/member.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
    <style>
        .nolevel {
            display: contents;
        }

        .nolevel span {
            font-size: 3rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("./php/navNotSearch.php"); ?>
    <div class="nolevel">
        <span>Error 403</span>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
    <!-- <script>
        function delay(n) {
            return new Promise(function(resolve) {
                setTimeout(resolve, n);
            });
        }

        async function changeColor() {
            var i = 0;
            while (true) {
                await delay(10);
                var color = "#" + i.toString(16);
                console.log(color);
                if (color == "#dddddd") {
                    i = 0;
                }
                document.getElementsByClassName("nolevel")[0].children[0].style.color = color;
                i++;
            }
        }
        changeColor();
    </script> -->
</body>

</html>