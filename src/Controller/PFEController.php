<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry ;
use App\Form\PFEType ;
use App\Entity\PFE ;
use App\Entity\Entreprise ;


#[Route('/PFE')]
class PFEController extends AbstractController
{
    #[Route('/', name: 'app_p_f_e')]
    public function index(): Response
    {
        return $this->render('pfe/index.html.twig', [
            'controller_name' => 'PFEController',
        ]);
    }
    
    #[Route('/add', name: 'pfe.add.form')]
    public function addPersonneForm(ManagerRegistry $doctrine,Request $request): Response
    {        

        $pfe = new PFE() ;
        $form = $this->createForm(PFEType::class,$pfe) ;
        $form->remove('createdAt') ;
        $form->remove('updatedAt') ;

        $form->handleRequest($request) ;
        
        if($form->isSubmitted() && $form->isValid()){

            $manager = $doctrine->getManager() ;
            $manager->persist($pfe) ;

            $manager->flush() ;
            $this->addFlash("info", $pfe->getEtudiant()."a ete ajoute avec succes");
            return $this->redirectToRoute('pfe.list'); 

        }else{
            return $this->render('pfe/add-pfe.html.twig', [
                'form' => $form->createView()
            ]);
        }
        
    }
    #[Route('/PFE',name:"pfe.list")]
    public function indexAlls(ManagerRegistry $doctrine):Response
    {

        $repository = $doctrine->getRepository(Entreprises::class) ;
        $ents = $repository->findAll() ;

        for(ent in ents){
            $repository = $doctrine->getRepository(Entreprise::class) ;
            $entreprise = $repository->findBy(['nom' => 'Victoire']) ;
        }

        
        return $this->render('pfe/index.html.twig',['pfes' => $pfes]);
    }

}
