<?php

namespace App\Repository;

use App\Entity\SessionModule;
use App\Entity\Session;
use App\Entity\Institution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SessionModule>
 */
class SessionModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionModule::class);
    }
    
    
// Méthode pour récupérer les détails des modules et des sessions
public function getSessionAndModulesDetails() // Changement de nom pour mieux décrire l'action
{
    // Création d'une requête avec le QueryBuilder pour récupérer les données
    return $this->createQueryBuilder('sessionModule') // 'sessionModule' est l'alias pour la table/entité principale 'SessionModule'
        
        // Jointure interne avec la table des modules, en utilisant l'alias 'module'
        ->innerJoin('sessionModule.module', 'module') // Joindre la table 'module' via la relation définie dans 'SessionModule'
        
        // Jointure interne avec la table des sessions, en utilisant l'alias 'session'
        ->innerJoin('sessionModule.session', 'session') // Joindre la table 'session' via la relation définie dans 'SessionModule'
        
        // Sélectionner des colonnes spécifiques de la table 'module' et les renommer pour une meilleure clarté
        ->addSelect('module.id AS moduleId, module.nom AS moduleNom, module.description AS moduledescription') // Sélectionner les champs id, nom et description du module
        
        // Sélectionner des colonnes spécifiques de la table 'session' et les renommer pour une meilleure clarté
        ->addSelect('session.id AS sessionId, session.nom AS sessionNom, session.type AS sessionType, session.date_debut AS sessionDateDebut, session.date_fin AS sessionDateFin, session.description AS sessionDescription') // Sélectionner les champs de la session
        
        // Exécution de la requête et récupération des résultats sous forme de tableau d'objets
        ->getQuery()
        
        // Retourner le résultat sous forme de tableau d'entités, où chaque élément représente un 'sessionModule' avec les informations des modules et sessions
        ->getResult(); 
}

}

