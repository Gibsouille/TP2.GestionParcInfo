<?php
    include ("./html/header.html");
    include ("./OrdinateurManager.class.php");

    echo '<h2>Affichage des machines</h2>';
    
    $connexionDB = new PDO("mysql:host=localhost;dbname=parc", "root", "");
    $managerOrdinateurs = new OrdinateurManager($connexionDB);
    $listeOrdinateurs = $managerOrdinateurs->listerLesOrdinateurs();
    $nombreDOrdinateurs = count($listeOrdinateurs);
    
    echo '<p>Total : ' . $nombreDOrdinateurs . '</p>';
    echo '<table>'
            . '<tr>'
                . '<th>id</th>'
                . '<th>ip</th>'
                . '<th>mac</th>'
                . '<th>nom</th>'
                . '<th>salle</th>'
            . '</tr>';

    if ($nombreDOrdinateurs > 0) {
        foreach ($listeOrdinateurs as $ordinateur) {
            echo '
            <tr>
                <td>' . $ordinateur->getId() . '</td>
                <td>' . $ordinateur->getIp() . '</td>
                <td>' . $ordinateur->getAdresseMac() . '</td>
                <td>' . $ordinateur->getNom() . '</td>
                <td>' . $ordinateur->getSalle() . '</td>
            </tr>';
        }
    }
    
    echo '</table>';
    
    include ("./html/footer.html");