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
