<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Services\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class ClientController extends AbstractController {

    public function __construct(){}

    /**
     * @Route("/Client", name="client_error")
     */
    public function index(){
        return $this->redirectToRoute('controller_show_vehicule');
    }

    /**
     * @Route("/Client/inscription", name="client_inscription")
     */
    public function inscriptionClient(SessionInterface $session){
        if ($session != null)
            $session->clear();

        return $this->render('Client/inscriptionClient.html.twig');
    }

    /**
     * @Route("/Client/connexion", name="client_connexion")
     */
    public function connexionClient(SessionInterface $session){
        if ($session != null)
            $session->clear();
        return $this->render('Client/connexionClient.html.twig');
    }

    /**
     * @Route("/Client/edit", name="client_edit")
     */
    public function editClient(ClientRepository $client, SessionInterface $session){
        if ($session->get('id' ) == null)
            return $this->redirectToRoute('client_connexion');
        $donnees = $client->find($session->get('id'));
        return $this->render('Client/editClient.html.twig', ['donnees' => $donnees]);
    }

    /**
     * @Route("Client/suppression", name="client_suppression")
     */
    public function suppressionClient(ClientRepository $client, SessionInterface $session){
        $entityManager = $this->getDoctrine()->getManager();
        $id = $session->get('id');
        if ($id == null)
            return $this->redirectToRoute('controller_show_vehicule', ['message' => 'Erreur lors de la suppression']);
        $client = $client->find($id);
        if ($client != null){
            $entityManager->remove($client);
            $entityManager->flush();
            $session->clear();
            $message = "Votre compte a bien été supprimé";
        } else
            $message = "Erreur lors de la suppression";
        return $this->redirectToRoute('controller_show_vehicule', ['message' => $message]);
    }

    /**
     * @Route("/Client/deconnection", name="client_logout")
     */
    public function logout(SessionInterface $session) {
        if ($session != null)
            $session->clear();
        return $this->redirectToRoute('controller_show_vehicule');
    }

    /**
     * @Route("Client/valideConnexion", name="client_valide_connexion")
     */
    public function valideConnexionClient(SessionInterface $session) {
        $donnees['email'] = htmlentities($_POST['email']);
        $donnees['password'] = htmlentities($_POST['password']);
        $errors = Services::valideFormConnexion($donnees);
        if (empty($errors['errors'])) {
            $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['email' => $donnees['email']]);
            if ($client != null) {
                if ($client->getPassword() == $donnees['password']) {
                    Services::setSession($session, $client);
                    return $this->redirectToRoute('controller_show_vehicule');
                } else
                    $errors['connexion'] = "Mot de passe incorrect";
            } else
                $errors['connexion'] = "Email incorrect";
        }
        return $this->render('Client/connexionClient.html.twig', ['donnees' => $donnees, 'errors' => $errors]);
    }

    /**
     * @Route("Client/valideFormClient", name="client_valide_form_client")
     */
    public function validateInscriptionClient(SessionInterface $session) {
        $donnees['nom'] = htmlentities($_POST['nom']);
        $donnees['prenom'] = htmlentities($_POST['prenom']);
        $donnees['pseudo'] = htmlentities($_POST['pseudo']);
        $donnees['email'] = htmlentities($_POST['email']);
        $donnees['adresse'] = htmlentities($_POST['adresse']);
        $donnees['password'] = htmlentities($_POST['password']);
        $donnees['passwordVerify'] = htmlentities($_POST['passwordVerify']);
        $errors = Services::valideFormClient($donnees, $this->getDoctrine()->getRepository(Client::class)->findOneBy(['pseudo' => $donnees['pseudo']]));
        if (empty($errors['errors'])) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($entityManager->getRepository(Client::class)->findOneBy(['email' => $donnees['email']]) == null)
                $new_client = new Client();
            else
                $new_client = $entityManager->getRepository(Client::class)->findOneBy(['email' => $donnees['email']]);
            $new_client->setNom($donnees['nom']);
            $new_client->setPrenom($donnees['prenom']);
            if (!empty($donnees['pseudo']))
                $new_client->setPseudo($donnees['pseudo']);
            $new_client->setEmail($donnees['email']);
            $new_client->setAdresse($donnees['adresse']);
            $new_client->setPassword($donnees['password']);
            $entityManager->persist($new_client);
            $entityManager->flush();
            Services::setSession($session, $new_client);
            return $this->redirectToRoute('controller_show_vehicule');
        }
        return $this->render('Client/inscriptionClient.html.twig', ['donnees' => $donnees, 'errors' => $errors]);
    }
}