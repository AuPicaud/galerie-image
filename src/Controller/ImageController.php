<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
//    #[Route('/image', name: 'app_image')]
//    public function index(): Response
//    {
//        return $this->render('image/index.html.twig', [
//            'controller_name' => 'ImageController',
//        ]);
//    }

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/image', name: 'app_image')]
    public function upload(Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez le téléchargement du fichier ici (par exemple, enregistrez le fichier sur le serveur)

            // Persistez l'entité dans la base de données en utilisant l'EntityManager
            $this->entityManager->persist($image);
            $this->entityManager->flush();

            // Redirigez l'utilisateur vers une autre page après la soumission du formulaire
            return $this->redirectToRoute('app_public');
        }

        return $this->render('image/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
