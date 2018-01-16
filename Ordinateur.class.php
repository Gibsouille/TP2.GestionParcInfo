<?php

class Ordinateur {
    private $id;
    private $ip;
    private $adresseMac;
    private $nom;
    private $salle;
    
    public function __construct($id, $ip, $adresseMac, $nom, $salle) {
        $this->id = $id;
        $this->ip = $ip;
        $this->adresseMac = $adresseMac;
        $this->nom = $nom;
        $this->salle = $salle;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getIp() {
        return $this->ip;
    }
    public function getAdresseMac() {
        return $this->adresseMac;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getSalle() {
        return $this->salle;
    }
}
