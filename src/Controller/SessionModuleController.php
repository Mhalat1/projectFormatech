<?php
namespace App\Controller;

use App\Entity\SessionModule;
use App\Form\SessionModuleType;
use App\Repository\SessionModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionModuleController extends AbstractController
{
    #[Route('/sessionmodule', name: 'app_Session_Module')]
    public function index(SessionModuleRepository $registry, Request $request, EntityManagerInterface $em): Response
    {
        // Retrieve all associations of modules and sessions
        $modulesandsessions = $registry->findAll();

        // Create a new SessionModule entity for adding a new association
        $sessionModule = new SessionModule();

        // Create the form using the SessionModuleType
        $form = $this->createForm(SessionModuleType::class, $sessionModule);
        $form->handleRequest($request);

        // Check if the form is submitted and valid, then persist the entity
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sessionModule);
            $em->flush();

            // Redirect to the same page after adding
            return $this->redirectToRoute('app_Session_Module');
        }

        $deleteId = $request->get('delete_id');
        //delete_id prend dans le fichier twig la valeur de institution.id
        
        if ($deleteId) {
            // Delete the session module by its ID
            $sessionModuleToDelete = $registry->find($deleteId);

            if ($sessionModuleToDelete) {
                $em->remove($sessionModuleToDelete);
                $em->flush();

                // Add a flash message to inform the user
                $this->addFlash('success', 'SessionModule deleted successfully!');
            }

            // Redirect to the same page after deletion
            return $this->redirectToRoute('app_Session_Module');
        }

        // Prepare the data for the view
        $results = [];
        foreach ($modulesandsessions as $moduleandsession) {
            $results[] = [
                'moduleId' => $moduleandsession->getId(),
                'moduleNom' => $moduleandsession->getModule()->getNom(),
                'moduleDescription' => $moduleandsession->getModule()->getDescription(),
                'sessionId' => $moduleandsession->getSession()->getId(),
                'sessionNom' => $moduleandsession->getSession()->getNom(),
                'sessionType' => $moduleandsession->getSession()->getType(),
                'sessionDateDebut' => $moduleandsession->getSession()->getDateDebut(),
                'sessionDateFin' => $moduleandsession->getSession()->getDateFin(),
                'sessionDescription' => $moduleandsession->getSession()->getDescription(),
            ];
        }

        // Render the view with the form and the session modules
        return $this->render('sessionmodule.html.twig', [
            'results' => $results,
            'form' => $form->createView(),
        ]);
    }
}
