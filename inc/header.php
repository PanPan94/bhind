<?php
    require_once 'functions.php';
    logged_only();
    if($_SESSION['language'] == "fr") {
        include('lang/fr-lang.php');
    }elseif($_SESSION['language'] == "en") {
        include('lang/en-lang.php');
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
    <meta property="twitter:card" content="img/bhind.png">
    <meta property="twitter:url" content="https://myorbis.fr/bhind">

    <link rel="icon" type="image/png" href="bhind.png" />
    <title>Bhind</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="nav-container">
    <div class="container">
        <div class="nav-logo"><a class="nav-logo-link" href="index.php"></a></div>
        <div class="nav-nav" id="nav-nav">
            <div class="nav-toggler" id="nav-toggler"></div>
            <nav>
                <a class="nav-items" href="index.php"><?= _HOME_ ?></a>
                <a class="nav-items" href="visit.php"><?= _VISIT_ ?></a>
                <a class="nav-items" href="activities.php"><?= _ACTIVITIES_ ?></a>
                <a class="nav-items" href="chooselanguage.php"><?= _LANGUAGE_ ?></a>    
                <a class="nav-items" href="about.php"><?= _ABOUT_ ?></a>    
            </nav>
        </div>
    </div>
</div>