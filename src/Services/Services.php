<?php

namespace App\Services;

use App\Entity\Client;
use App\Entity\Vendeur;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Services
{
    public function __construct()
    {
        //
    }

    public static function getDonneesVehicule($vehicule): array
    {
        $donnees['id'] = $vehicule->getId();
        $donnees['name'] = $vehicule->getName();
        $donnees['photo'] = $vehicule->getPhoto();
        $donnees['etat'] = $vehicule->getEtat();
        $eee = json_decode($vehicule->getCaracteres());
        $donnees['caracteres'] = $eee[0];
        return $donnees;
    }

    public static function getDonneesVehicules(array $vehicules): array
    {
        $i = 0;
        foreach ($vehicules as $vehicule) {
            $donnees[$i]['id'] = $vehicule->getId();
            $donnees[$i]['name'] = $vehicule->getName();
            $donnees[$i]['photo'] = $vehicule->getPhoto();
            $donnees[$i]['etat'] = $vehicule->getEtat();
            $eee = json_decode($vehicule->getCaracteres());
            $donnees[$i]['caracteres'] = $eee[0];
            $i++;
        }
        return $donnees;
    }

    public static function setSessions(SessionInterface $session, Vendeur $vendeur) {
        $session->clear();
        $session->set('id', $vendeur->getId());
        $session->set('nom', $vendeur->getNom());
        $session->set('identifiant', $vendeur->getIdentifiant());
        $session->set('password', $vendeur->getPassword());
    }

    public static function setSession(SessionInterface $session, Client $client) {
        $session->clear();
        $session->set('id', $client->getId());
        $session->set('nom', $client->getNom());
        $session->set('prenom', $client->getPrenom());
        $session->set('pseudo', $client->getPseudo());
        $session->set('email', $client->getEmail());
        $session->set('adresse', $client->getAdresse());
        $session->set('password', $client->getPassword());
    }

    public static function valideFormConnexion(array $donnees): array
    {
        $errors = array();
        $good = "Correct !!";
        if (!preg_match("%@%", $donnees["email"])) {
            $errors['errors'] = 1;
            $errors['email'] = "Le format de l'email est incorrect";
        } else
            $errors['email'] = $good;

        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $donnees['password'])) {
            $errors['password'] = "Mot de passe non sécurité, il doit contenir 8 caractères minimum et avoir un caractère spécial parmi ! @ # $%";
        } else
            $errors['password'] = $good;

        return $errors;
    }

    public static function valideFormClient(array $donnees, $pseudo): array
    {
        $errors = array();
        $good = "Correct !!";
        if (!preg_match('/^[A-Za-z ]{2,}$/', $donnees['nom'])) {
            $errors['errors'] = 1;
            $errors['nom'] = "Le nom doit comporter 2 caractères uniquement avec des lettres";
        } else
            $errors['nom'] = $good;

        if (!preg_match('/^[A-Za-z ]{2,}$/', $donnees['prenom'])) {
            $errors['errors'] = 1;
            $errors['prenom'] = "Le nom doit comporter 2 caractères uniquement avec des lettres";
        } else
            $errors['prenom'] = $good;

        if (!preg_match('/^[A-Za-z ]{2,}$/', $donnees['adresse'])) {
            $errors['errors'] = 1;
            $errors['adresse'] = "Adresse incorrect";
        } else
            $errors['adresse'] = $good;

        if (!empty($donnees["pseudo"]) and $donnees['pseudo'] != '') {
            if (!empty($pseudo)) {
                $errors['errors'] = 1;
                $errors['pseudo'] = "Ce pseudo à déjà été utilisé";
            } else
                $errors['pseudo'] = $good;
        }

        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $donnees['password'])) {
            $errors['errors'] = 1;
            $errors['password'] = "Mot de passe non sécurité, il doit contenir 8 caractères minimum et avoir un caractère spécial parmi ! @ # $%";
        } else
            $errors['password'] = $good;

        if (!preg_match("%@%", $donnees["email"])) {
            $errors['errors'] = 1;
            $errors['email'] = "Le format de l'email est incorrect";
        } else
            $errors['email'] = $good;

        if ($donnees['password'] != $donnees['passwordVerify']) {
            $errors['errors'] = 1;
            $errors['passwordVerify'] = "Les mots de passe ne sont pas identiques";
        } else
            $errors['passwordVerify'] = $good;
        return $errors;
    }

}