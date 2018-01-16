<?php
include ("./Ordinateur.class.php");

class OrdinateurManager {
    private $connexionDB;
    
    public function __construct($connexionDB) {
        $this->connexionDB = $connexionDB;
    }
    
    public function listerLesOrdinateurs() {
        $listeOrdinateurs = array();
        
        try {
            $selectOrdinateurs = "select * from ordinateurs order by ip asc";
            $reponse = $this->connexionDB->query($selectOrdinateurs);

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
    
    public function listerLesOrdinateursAvecCeDebutIp($debutIp) {
        $listeOrdinateurs = array();
        
        try {
            $selectOrdinateurs = "select * from ordinateurs where ip like '" . $debutIp . "%' order by ip asc";
            $reponse = $this->connexionDB->query($selectOrdinateurs);

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
