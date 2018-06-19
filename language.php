<?php
    session_start();
    if(isset($_POST['language'])) {
        $_SESSION['language'] = $_POST['language'];
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:title" content="Bhind">
    <meta property="og:description" content="Découvrez le Grand Paris.">
    <meta property="og:image" content="img/bhind.png">
    <meta property="og:url" content="https://myorbis.fr/bhind">
    <meta property="twitter:title" content="Bhind">
    <meta property="twitter:description" content="Découvrez le Grand Paris.">
    <meta property="twitter:image" content="img/bhind.png">
    <meta property="twitter:url" content="https://myorbis.fr/bhind">

    <title>Bhind</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
<div class="home">
    <div class="home-container">
        <div class="home-logo">
            <img src="./img/bhind.svg" alt="logo">
        </div>

        <div class="header-hello">
            <h2 id="hello">Select your language</h2>
        </div>
        <form action="" id="form-language" class="form-language"  method="POST">
            <div class="language-selector">
                    <a class="btn language french unselected" data-hello="Selectionnez votre langue">
                        <input class="language-input" type="radio" name="language" value="fr">
                    </a>
                    <a id="english" class="btn language english selected" data-hello="Select your language">
                        <input class="language-input" type="radio" name="language" value="en" checked>
                    </a>
            </div>
            <a class="btn" id="discover" href="#"><b>Discover</b></a>
        </form>
    </div>
</div>

<script>
    let languages = document.querySelectorAll('.language');
    languages.forEach(l => {
        l.addEventListener('click', e => {
            languages.forEach(s => {
                if(s.classList.contains('selected')){
                    s.classList.remove('selected');
                    s.classList.add('unselected');
                }
            })
            l.classList.remove('unselected');
            l.classList.add('selected');

            let hello = l.getAttribute("data-hello");
            document.querySelector('#hello').innerText = hello;
            if(document.querySelector('#english').classList.contains('selected')){
                document.querySelector('#discover b').innerText = "Discover";
            }else {
                document.querySelector('#discover b').innerText = "Découvrir";
            }
        });
    });

    document.querySelector('#discover').addEventListener('click', () => {
        document.querySelector('#form-language').submit();
    })
</script>
</body>
</html>