<?php

namespace App\Controller;

use App\Repository\InstitutionRepository;
use App\Repository\UtilisateurRepository;
use App\Entity\Utilisateur;  // Ensure that the entity is correctly imported
use App\Entity\Institution;  // Ensure that the entity is correctly imported 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UtilisateurType;
use App\Form\InstitutionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InstitutionController extends AbstractController
{
    // Route to display institutions and add a user on the same route
    #[Route('/institution', name: 'institution_index_ajouter')]
    public function indexEtAjouter(
        Request $request,
        InstitutionRepository $institutionRepository,
        UtilisateurRepository $utilisateurRepository, 
        EntityManagerInterface $em): Response
    {
        // Retrieve all institutions
        $institutions = $institutionRepository->findAll();
        $utilisateurs_liste = $utilisateurRepository->findAll();

        // Create a new Utilisateur object
        $utilisateur = new Utilisateur();
        // Create the form based on the Utilisateur entity
        $form_utilisateur = $this->createForm(UtilisateurType::class, $utilisateur);
        // Handle form submission
        $form_utilisateur->handleRequest($request);
        // If the form is submitted and valid
        if ($form_utilisateur->isSubmitted() && $form_utilisateur->isValid()) {
            // Save the user in the database
            $em->persist($utilisateur);
            $em->flush();
            // Add a success flash message
            $this->addFlash('success', 'Utilisateur ajouté avec succès!');
            // Redirect to the same page to display changes
            return $this->redirectToRoute('institution_index_ajouter');
        }

        // Handle the deletion of a user
        $deleteId = $request->get('delete_id');
        if ($deleteId) {
            $utilisateurToDelete = $utilisateurRepository->find($deleteId);

            if ($utilisateurToDelete) {
                // Remove the user
                $em->remove($utilisateurToDelete);
                $em->flush();
                // Add a success flash message
                $this->addFlash('success', 'Utilisateur supprimé avec succès!');
            } else {
                // If the user doesn't exist
                $this->addFlash('error', 'Utilisateur non trouvé!');
            }
            // Redirect to the same page
            return $this->redirectToRoute('institution_index_ajouter');
        }

        // Create a new Institution object
        $institution = new Institution();
        $form_institution = $this->createForm(InstitutionType::class, $institution);
        $form_institution->handleRequest($request);
        // If the institution form is submitted and valid
        if ($form_institution->isSubmitted() && $form_institution->isValid()) {
            // Save the institution in the database
            $em->persist($institution);
            $em->flush();
            // Add a success flash message
            $this->addFlash('success', 'Institution ajoutée avec succès!');
            // Redirect to the same page to display changes
            return $this->redirectToRoute('institution_index_ajouter');
        }

        // Handle the deletion of an institution
        $deleteInstitutionId = $request->get('delete_Institution_id');
        if ($deleteInstitutionId) {
            $institutionToDelete = $institutionRepository->find($deleteInstitutionId);

            if ($institutionToDelete) {
                // Remove the institution
                $em->remove($institutionToDelete);
                $em->flush();
                // Add a success flash message
                $this->addFlash('success', 'Institution supprimée avec succès!');
            } else {
                // If the institution doesn't exist
                $this->addFlash('error', 'Institution non trouvée!');
            }
            // Redirect to the same page
            return $this->redirectToRoute('institution_index_ajouter');
        }

        // Render the view with the list of institutions and the add forms
        return $this->render('welcome.html.twig', [
            'utilisateurs_liste' => $utilisateurs_liste,
            'institutions' => $institutions,
            'form_utilisateur' => $form_utilisateur->createView(),
            'form_institution' => $form_institution->createView()
        ]);
    }
}
