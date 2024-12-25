<?php
namespace App\Controller;

use App\Entity\InstitutionSession;
use App\Form\InstitutionSessionType;
use App\Repository\InstitutionSessionRepository;
use App\Repository\SessionRepository;
use App\Repository\InstitutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstitutionSessionController extends AbstractController
{
    #[Route('/institutionsessions', name: 'app_institution_sessions')]
    public function index(
        InstitutionSessionRepository $institutionSessionRepository,
        InstitutionRepository $institutionRepository,
        SessionRepository $sessionRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // Récupère toutes les institutions et sessions
        $institutions = $institutionRepository->findAll();
        $sessions = $sessionRepository->findAll();

        // Récupérer les sessions d'institution existantes (ou utiliser findAll() si nécessaire)
        $institutionSessions = $institutionSessionRepository->findAll(); 

        // Crée une nouvelle instance d'InstitutionSession pour le formulaire
        $newInstitutionSession = new InstitutionSession();
        $formInstitutionSession = $this->createForm(InstitutionSessionType::class, $newInstitutionSession);

        // Gère la soumission du formulaire
        $formInstitutionSession->handleRequest($request);

        if ($formInstitutionSession->isSubmitted() && $formInstitutionSession->isValid()) {
            // Sauvegarde l'institution session dans la base de données
            $em->persist($newInstitutionSession);
            $em->flush();

            // Ajoute un message flash de succès
            $this->addFlash('success', 'Institution session ajoutée avec succès!');

            // Redirige vers la page de liste des institution sessions
            return $this->redirectToRoute('app_institution_sessions');
        }

        // Gestion de la suppression d'une session
        $deleteId = $request->get('delete_id');
        if ($deleteId) {
            $institutionSessionToDelete = $institutionSessionRepository->find($deleteId);

            if ($institutionSessionToDelete) {
                // Supprimer l'InstitutionSession
                $em->remove($institutionSessionToDelete);
                $em->flush();

                // Ajoute un message flash de succès
                $this->addFlash('success', 'Institution session supprimée avec succès!');
            } else {
                // Si l'InstitutionSession n'existe pas
                $this->addFlash('error', 'Institution session non trouvée!');
            }

            // Rediriger vers la même page
            return $this->redirectToRoute('app_institution_sessions');
        }

        // Passe les données au template
        return $this->render('sessionsinstitution.html.twig', [
            'institution_sessions' => $institutionSessions,  // Ensure this matches the variable in the template
            'formInstitutionSession' => $formInstitutionSession->createView(),
        ]);
    }
}
