<?php

// src/yo/PlatformBundle/Controller/AdvertController.php

namespace yo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use yo\PlatformBundle\Entity\Advert;

class AdvertController extends Controller
{
    public function indexAction($page) {
        
        // ...
        // Notre liste d'annonce en dur
        $listAdverts = array(array('title' => 'Recherche développpeur Symfony2', 'id' => 1, 'author' => 'Alexandre', 'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…', 'date' => new \Datetime()), array('title' => 'Mission de webmaster', 'id' => 2, 'author' => 'Hugo', 'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…', 'date' => new \Datetime()), array('title' => 'Offre de stage webdesigner', 'id' => 3, 'author' => 'Mathieu', 'content' => 'Nous proposons un poste pour webdesigner. Blabla…', 'date' => new \Datetime()));
        
        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('yoPlatformBundle:Advert:index.html.twig', array('listAdverts' => $listAdverts));
    }
    
    public function viewAction($id) {
        
        // On récupère le repository
        $repository = $this->getDoctrine()->getManager()->getRepository('yoPlatformBundle:Advert');
        
        // On récupère l'entité correspondante à l'id $id
        $advert = $repository->find($id);
        
        // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }
        
        // Le render ne change pas, on passait avant un tableau, maintenant un objet
        return $this->render('yoPlatformBundle:Advert:view.html.twig', array('advert' => $advert));
    }
    
    public function addAction(Request $request) {
        
        // Création de l'entité
        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony2.');
        $advert->setAuthor('Alexandre');
        $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");
        
        // On peut ne pas définir ni la date ni la publication,
        // car ces attributs sont définis automatiquement dans le constructeur
        
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        
        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);
        
        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();
        
        // Reste de la méthode qu'on avait déjà écrit
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirect($this->generateUrl('yo_platform_view', array('id' => $advert->getId())));
        }
        
        return $this->render('yoPlatformBundle:Advert:add.html.twig');
    }
    
    public function editAction($id, Request $request) {
        
        // ...
        
        $advert = array('title' => 'Recherche développpeur Symfony2', 'id' => $id, 'author' => 'Alexandre', 'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…', 'date' => new \Datetime());
        
        return $this->render('yoPlatformBundle:Advert:edit.html.twig', array('advert' => $advert));
    }
    
    public function deleteAction($id) {
        
        // Ici, on récupérera l'annonce correspondant à $id
        
        // Ici, on gérera la suppression de l'annonce en question
        
        return $this->render('yoPlatformBundle:Advert:delete.html.twig');
    }
    
    public function menuAction($limit) {
        
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(array('id' => 2, 'title' => 'Recherche développeur Symfony2'), array('id' => 5, 'title' => 'Mission de webmaster'), array('id' => 9, 'title' => 'Offre de stage webdesigner'));
        
        return $this->render('yoPlatformBundle:Advert:menu.html.twig', array(
        
        // Tout l'intérêt est ici : le contrôleur passe
        // les variables nécessaires au template !
        'listAdverts' => $listAdverts));
    }
}
