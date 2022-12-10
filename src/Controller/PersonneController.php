<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
 /**
 * @Route("/personne", name="create_personne")
 */
 public function createPersonne(): Response
 {
 // you can fetch the EntityManager via $this->getDoctrine()
 // or you can add an argument to the action: createPersonne(EntityManagerInterface $entityManager)
 $entityManager = $this->getDoctrine()->getManager();
 $personne = new Personne();
 $personne->setNom('Boudriga');
 $personne->setPrenom('imed');
 //$personne->setAge(100);
 // tell Doctrine you want to (eventually) save the Personne (no queries yet)
 $entityManager->persist($personne);
 // actually executes the queries (i.e. the INSERT query)
 $entityManager->flush();
 return new Response('Saved new personne with id '.$personne->getId());
 }

 /**
* @Route("/personne/{id}", name="personne_affiche")
*/
public function affiche($id)
{
 $personne = $this->getDoctrine()
 ->getRepository(Personne::class)
 ->find($id);
 if (!$personne) {
 throw $this->createNotFoundException(
 'aucune personne avec id = '.$id
 );
 }
 return new Response('Personne : '.$personne->getNom());
}

/**
* @Route("/personnet/{id}", name="personne_afficheT")
*/
public function affichet($id)
{
 $personne = $this->getDoctrine()
 ->getRepository(Personne::class)
 ->find($id);
 if (!$personne) {
 throw $this->createNotFoundException(
 'aucune personne avec id = '.$id
 );
}
return $this->render('personne/affiche.html.twig', ['personne' => $personne]);

}
/**
* @Route("/personne/affiche/tous/", name="personne_afiichett")
*/
public function affichett()
{
 $repository = $this->getDoctrine()->getRepository(Personne::class);
 /*
 $personnes = $repository->findBy(
 ['Nom' => 'Boudriga'],
 ['Age' => 'ASC']
 );
 */
// Recherche de toutes les personnes dans la base
 $personnes = $repository->findAll();
 return $this->render('personne/affichett.html.twig', ['personnes' => $personnes]);
}
/**
* @Route("/personne/edit/{id}")
*/
public function update($id)
{
 $entityManager = $this->getDoctrine()->getManager();
 $personne = $entityManager->getRepository(Personne::class)->find($id);
 if (!$personne) {
 throw $this->createNotFoundException(
 'aucune personne avec id= '.$id
 );
 }
 $personne->setNom('BOUD');
 $entityManager->flush();
 return $this->redirectToRoute('personne_afficheT', [
 'id' => $personne->getId()
 ]);
}

}
