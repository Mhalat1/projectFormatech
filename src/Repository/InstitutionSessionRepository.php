<?php
namespace App\Repository;

use App\Entity\InstitutionSession;
use App\Entity\Session;  // Assurez-vous que l'entité Session est bien importée
use App\Entity\Institution;  // Assurez-vous que l'entité Session est bien importée
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InstitutionSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstitutionSession::class);
    }

    // Méthode pour récupérer les détails d'institution et de session
    public function getInstitutionAndSessionDetails() // Changement de nom
    {
        return $this->createQueryBuilder('institutionSession')
            ->innerJoin('institutionSession.institution', 'institution')
            ->innerJoin('institutionSession.session', 'session')
            ->addSelect('institution.nom AS institutionNom, institution.adresse AS institutionAdresse, institution.telephone AS institutionTelephone, institution.courriel AS institutionCourriel')
            ->addSelect('session.id AS sessionId, session.nom AS sessionNom, session.type AS sessionType, session.date_debut AS sessionDateDebut, session.date_fin AS sessionDateFin, session.description AS sessionDescription')
            ->distinct() // Ajoutez cette ligne pour obtenir des résultats distincts
            ->getQuery()
            ->getResult();
    }
}
