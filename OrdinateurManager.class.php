<?php
include ("./Ordinateur.class.php");

class OrdinateurManager {
    private $connexionDB;
    
    public function __construct($connexionDB) {
        $this->connexionDB = $connexionDB;
    }
    
    public function listerLesOrdinateurs() {
        $requete = "select * from ordinateurs order by ip asc";
        return $this->listerOrdinateursDepuisCetteRequete($requete);
    }
    
    public function listerLesOrdinateursAvecCeDebutIp($debutIp) {
        $requete = "select * from ordinateurs where ip like '" . $debutIp . "%' order by ip asc";
        return $this->listerOrdinateursDepuisCetteRequete($requete);
    }
    
    public function listerNombreDordinateursParSalle() {
        $requete = "select salle, count(distinct id) as nb_ordinateurs from ordinateurs group by salle order by salle";
        $listeNombreOrdinateursParSalle = array();
        
        try {
            $reponse = $this->connexionDB->query($requete);
            
            while (($ligneReponse = $reponse->fetch())) {
                $listeNombreOrdinateursParSalle[$ligneReponse['salle']] = $ligneReponse['nb_ordinateurs'];
            }
            
            $reponse->closeCursor();
        } catch (PDOException $ex) {
            echo '<pre>Erreur : ' . $ex.getMessage() . '</pre>';
        }
        
        return $listeNombreOrdinateursParSalle;
    }

    private function listerOrdinateursDepuisCetteRequete($requete) {
        $listeOrdinateurs = array();
        
        try {
            $reponse = $this->connexionDB->query($requete);

            while (($ligneReponse = $reponse->fetch())) {
                $ordinateur = new Ordinateur($ligneReponse['id'], $ligneReponse['ip'], $ligneReponse['mac'], $ligneReponse['nom'], $ligneReponse['salle']);
                array_push($listeOrdinateurs, $ordinateur);
            }

            $reponse->closeCursor();
        } catch (PDOException $ex) {
            echo '<pre>Erreur : ' . $ex.getMessage() . '</pre>';
        }
        
        return $listeOrdinateurs;
    }
}
