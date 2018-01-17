<?php
    include("./OrdinateurManager.class.php");
    
    $connexionDB = new PDO("mysql:host=localhost;dbname=parc", "root", "");
    $managerOrdinateurs = new OrdinateurManager($connexionDB);
    $nombreDordinateursParSalle = $managerOrdinateurs->listerNombreDordinateursParSalle();
    
    // histogramme
    $largeur = 400;
    $hauteur = 300;
    $tailleBloc = 30;
    $maxOrdonnee = $hauteur - 20;
    $maxAbcisse = $largeur - 20;

    // grille
    $image = imagecreatetruecolor($largeur, $hauteur);
    imagesavealpha($image, true);
    // set background to white
    $couleurBlanche = imagecolorallocate($image, 0xFF, 0xFF, 0xFF) ;
    imagefill($image, 0, 0, $couleurBlanche);

    // Axes on laisse un margin de 10px = $szBlock / 2
    imageline($image, 0, 0, 0, $maxOrdonnee, 0x000000);
    imageline($image, 0, $maxOrdonnee, $maxAbcisse, $maxOrdonnee, 0x000000);

    $maxValue = max($nombreDordinateursParSalle);
    $count = count($nombreDordinateursParSalle);

    $unit = (($maxOrdonnee - $tailleBloc) / $maxValue);

    $x1 = $tailleBloc / 4; // on part à 20px de margin

    foreach($nombreDordinateursParSalle as $key => $value) { 
        $x1 += $tailleBloc;
        $x2 = $x1 + $tailleBloc;
        $y2 = $maxOrdonnee - 1 - $value * $unit;
        $y1 = $maxOrdonnee - 1;
        imagefilledrectangle($image, $x1, $y1, $x2, $y2, 0xff0000); //histogrammme
        imagestring($image, 3, ($x1 + $x2)/2, $y2, $value, 0x000000);
        imagestring($image, 3, ($x1 + $x2)/2, $maxOrdonnee, $key, 0x000000);
        imagestring($image, 3, 5, 0, "Nombre de PCs", 0x000000);
        imagestring($image, 3, $maxAbcisse - 60, $maxOrdonnee, "No de salle", 0x000000);
        $x1 += $tailleBloc;
    }

    header("Content-type: image/png");
    //draw
    imagepng($image);
    imagedestroy($image);
?>