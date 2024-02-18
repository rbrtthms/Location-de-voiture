<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Repository\ClientRepository;
use App\Repository\FactureRepository;
use App\Repository\VehiculeRepository;
use App\Services\Services;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("Facture/", name="vendeur_show_all_facture")
     */
    public function index(){
        return $this->redirectToRoute('controller_show_vehicule');
    }

    /**
     * @Route("Facture/client", name="client_facture")
     */
    public function factureClient(ClientRepository $client, FactureRepository $factureRepository, SessionInterface $session, VehiculeRepository $vehiculeRepository){
        $id = $session->get('id');
        if ($id != null) {
            $client = $client->findOneBy(['id' => $id]);
            $factures = $factureRepository->findBy(['idC' => $id]);
            $data['nbFacture'] = count($factures);
            $data['vehiculeDisponible'] = count($vehiculeRepository->findByEtat(1));
            $data['totalFacture'] = 0;
            foreach ($factures as $facture)
                $data['totalFacture'] += $facture->getValeur();
            return $this->render('Facture/factureClient.html.twig', ['factures' => $factures, 'client' => $client, 'data' => $data]);
        } else
            return $this->redirectToRoute('client_connexion');
    }

    /**
     * @Route("Facture/Vendeur/DernierMois", name="factures_vendeur_dernier_mois")
    */
    public function facturesDernierMois(FactureRepository $factureRepository){
        $dateMoisDernier = new \DateTime('-1 month');
        $factures = $factureRepository->findFactureLast($dateMoisDernier);
        $data['nbFacture'] = count($factures);
        $data['totalFacture'] = 0;
        foreach ($factures as $facture)
            $data['totalFacture'] += $facture->getValeur();
        return $this->render('Facture/factureMoisDernier.html.twig', ['factures' => $factures, 'data' => $data]);
    }

    /**
     * @Route("/reservation/{idV<\d+>}", name="client_facture_reservation")
     */
    public function factureReservation(ClientRepository $client, VehiculeRepository $vehiculeRepository, SessionInterface $session, $idV){
        $id = $session->get('id');
        if ($id != null) {
            $client = $client->findOneBy(['id' => $id]);
            $vehicule = $vehiculeRepository->findOneBy(['id' => $idV]);
            $donnees = null;
            if ($vehicule)
                $donnees = Services::getDonneesVehicule($vehicule);
            return $this->render('Facture/reservationClientVehicule.html.twig', ['vehicule' => $donnees]);
        } else
            return $this->redirectToRoute('client_connexion');
    }

    /**
     * @Route("/reservation/{idV}/valide", name="facture_valide_reservation")
     */
    public function valideFormReservation($idV, SessionInterface $session, VehiculeRepository $vehiculeRepository, ClientRepository $client, VehiculeRepository $vehicule) {
        $id = $session->get('id');
        if ($id != null) {
            $session->set('idV', $idV);
            if ($vehiculeRepository->findOneBy(['id' => $idV])->getEtat() == 1) {
                $donnees['dateD'] = htmlentities($_POST['dateD']);
                $donnees['dateF'] = htmlentities($_POST['dateF']);
                $donnees['dateDebut'] = \DateTime::createFromFormat('Y-m-d', $donnees["dateD"]);
                $donnees['dateFin'] = \DateTime::createFromFormat('Y-m-d', $donnees["dateF"]);
                if ($donnees['dateDebut'] < $donnees['dateFin']) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $facture = new Facture();
                    $facture->setIdC($client->findOneBy(['id' => $id]));
                    $facture->setIdV($vehicule->findOneBy(['id' => $idV]));
                    $facture->setEtatR(true);
                    $facture->setDateD($donnees['dateDebut']);
                    $facture->setDateF($donnees['dateFin']);
                    $facture->setValeur(1000);
                    $vehicule = $vehiculeRepository->findOneBy(['id' => $idV]);
                    $vehicule->setEtat(0);
                    $entityManager->persist($facture);
                    $entityManager->flush();
                    return $this->redirectToRoute('client_facture');
                }else
                    return $this->redirectToRoute('client_facture_reservation', ['idV' => $idV]);
            } else
                return $this->redirectToRoute('vehicule_disponible_reservation');
        } else
            return $this->redirectToRoute('client_connexion');
    }

    /**
     * @Route("/Client/reservation/encours", name="client_facture_reservation_encours")
     */
    public function factureReservationEncours(ClientRepository $client, FactureRepository $factureRepository, SessionInterface $session) {
        $id = $session->get('id');
        if ($id != null) {
            $client = $client->findOneBy(['id' => $id])->getId();
            $dateMoisDernier = new \DateTime('now');
            $factures = $factureRepository->findFactureClientLast($dateMoisDernier, $client);
            $data['nbFacture'] = count($factures);
            $data['totalFacture'] = 0;
            foreach ($factures as $facture)
                $data['totalFacture'] += $facture->getValeur();
            return $this->render('Facture/factureClientMoisDernier.html.twig', ['factures' => $factures, 'data' => $data]);
        } else
            return $this->redirectToRoute('client_connexion');
    }
}