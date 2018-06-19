<?php
require_once '../inc/db.php';
require_once '../inc/functions.php';
logged_only();
if($_SESSION['language'] == "fr") {
    include('../lang/fr-lang.php');
}elseif($_SESSION['language'] == "en") {
    include('../lang/en-lang.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.3/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.3/css/plugins/image.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/nav.js" async defer></script>

    <title>Département <?= $_GET['q'] ?></title>
</head>
<body>
<div class="nav-container">
<div class="container">
    <div class="nav-logo"><a class="nav-logo-link" href="../index.php"></a></div>
    <div class="nav-nav" id="nav-nav">
        <div class="nav-toggler" id="nav-toggler"></div>
        <nav>
            <a class="nav-items" href="../index.php"><?= _HOME_ ?></a>
            <a class="nav-items" href="../visit.php"><?= _VISIT_ ?></a>
            <a class="nav-items" href="../activities.php"><?= _ACTIVITIES_ ?></a>
            <a class="nav-items" href="../chooselanguage.php"><?= _LANGUAGE_ ?></a>    
            <a class="nav-items" href="../about.php"><?= _ABOUT_ ?></a>      
        </nav>
    </div>
</div>
</div>
    <div class="page">
        <div class="p--container">
        <div class="container section-container">
            <?php 
                if(isset($_GET['q'])) { 
                $req = $pdo->prepare('SELECT * FROM cities WHERE city_dpt = ?');
                $req->execute([$_GET['q']]);
            ?>
            <div class="latest-articles">
                <div class="section-title">
                    <h2>Les villes du département <?= $_GET['q'] ?></h2>
                    <?php
                        while($ligne = $req->fetch()) {
                            echo '<li><a href="city.php?id=' . $ligne->city_id . '">' . $ligne->city_name . '</a></li>';
                        }

                        switch($_GET['q']) {
                            case '77':
                                $nomdpt = "la Seine et Marne";
                            break;
                            case '78':
                                $nomdpt = "les Yvelines";
                            break;
                            case '91':
                            $nomdpt = "l'Essone";
                            break;
                            case '92':
                                $nomdpt = "les Hauts de Seine";
                            break;                            
                            case '93':
                                $nomdpt = "la Seine-Saint-Denis";
                            break;                            
                            case '94':
                                $nomdpt = "le Val de Marne";
                            break;                            
                            case '95':
                                $nomdpt = "le Val d'Oise";
                            break;    
                            default:
                                $nomdpt == 8;
                            break;
                        }
                        if($nomdpt == 8) {
                            $nomdpt = $_GET['q'];
                        }
                    ?>
                
                </div>
            </div>
            <div class="latest-articles">
                <div class="section-title">
                    <h2>Lieux dans <?= $nomdpt ?></h2>
                </div>
            <?php
                $req = $pdo->prepare('SELECT * FROM articles WHERE article_dpt = ? AND article_lang = ?');
                $req->execute([$_GET['q'], $_SESSION['language']]);
                while($ligne = $req->fetch()) {
                    $text = getPtpText($ligne->article_content, 1500);
                        $text = strip_tags($text, '<p><br><img>');
                        echo '<div class="p--container" style="width: 100%;">';
                        echo '<h3 class="article_title"style="text-align: left; color: #C72727; margin-top: 20px;">' . $ligne->article_title . '</h3>';
                        echo $text . '<a href="../view.php?id=' . $ligne->article_id . '">' . 'Lire la suite' . '</a></div>';
                    
                }
            ?>
            </div>
            <?php } ?>
        </div>
        
        </div>
    </div>

<?php
require_once '../inc/footer.php';
?>