<?php
    include ("./html/header.html");
    include ("./OrdinateurManager.class.php");

    echo "<h2>Sélection d'une machine dans le domaine</h2>";
    include ("./html/formulaire_recherche.html");
    
    if (isset($_GET['debutIp'])) {
        $debutIp = $_GET['debutIp'];
        $connexionDB = new PDO("mysql:host=localhost;dbname=parc", "root", "");
        $managerOrdinateurs = new OrdinateurManager($connexionDB);
        $listeOrdinateurs = $managerOrdinateurs->listerLesOrdinateursAvecCeDebutIp($debutIp);
        $nombreDOrdinateurs = count($listeOrdinateurs);
        
        if ($nombreDOrdinateurs == 0) {
            echo "<p>Aucun ordinateur trouvé avec le début d'IP : '" . $debutIp . "'.</p>";
        }
        else {
            echo '<p>' . $nombreDOrdinateurs . ' trouvé(s). </p>';
            echo '<table>'
                . '<tr>'
                    . '<th>id</th>'
                    . '<th>ip</th>'
                    . '<th>mac</th>'
                    . '<th>nom</th>'
                    . '<th>salle</th>'
                . '</tr>';
            
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
            
            echo '</table>';
        }
    }
    
    include ("./html/footer.html");