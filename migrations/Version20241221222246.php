<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241221222246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX titre ON etudiant');
        $this->addSql('DROP INDEX date_naissance ON etudiant');
        $this->addSql('DROP INDEX commentaire ON etudiant');
        $this->addSql('DROP INDEX note ON etudiant');
        $this->addSql('ALTER TABLE institution_session DROP INDEX institution.id, ADD INDEX IDX_B4BA234610405986 (institution_id)');
        $this->addSql('ALTER TABLE institution_session DROP FOREIGN KEY session');
        $this->addSql('DROP INDEX institution ON institution_session');
        $this->addSql('DROP INDEX institution_id ON institution_session');
        $this->addSql('ALTER TABLE institution_session CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE institution_session ADD CONSTRAINT FK_B4BA234610405986 FOREIGN KEY (institution_id) REFERENCES institution (id)');
        $this->addSql('ALTER TABLE institution_session ADD CONSTRAINT FK_B4BA2346613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE institution_session RENAME INDEX session.id TO IDX_B4BA2346613FECDF');
        $this->addSql('DROP INDEX IDX_C2426282FE28053 ON module');
        $this->addSql('DROP INDEX nom ON module');
        $this->addSql('DROP INDEX nom_2 ON module');
        $this->addSql('DROP INDEX description_idx ON module');
        $this->addSql('ALTER TABLE module DROP session_de_formation_id');
        $this->addSql('ALTER TABLE module_etudiant DROP FOREIGN KEY etudiant');
        $this->addSql('ALTER TABLE module_etudiant ADD CONSTRAINT FK_15BEF11DDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY role');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY utilisateur');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT FK_2F4B3B3AD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT FK_2F4B3B3AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('DROP INDEX nom ON session');
        $this->addSql('DROP INDEX type ON session');
        $this->addSql('DROP INDEX date_debut ON session');
        $this->addSql('DROP INDEX date_fin ON session');
        $this->addSql('DROP INDEX description ON session');
        $this->addSql('ALTER TABLE session CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY module--');
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY session_');
        $this->addSql('DROP INDEX description_idx ON session_module');
        $this->addSql('DROP INDEX description ON session_module');
        $this->addSql('ALTER TABLE session_module DROP description');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT FK_634F2C71613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT FK_634F2C71AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE motdepasse motdepasse INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur_etudiant DROP FOREIGN KEY etudiant_');
        $this->addSql('ALTER TABLE utilisateur_etudiant DROP FOREIGN KEY utilisateur___');
        $this->addSql('ALTER TABLE utilisateur_etudiant ADD CONSTRAINT FK_6F05DB7CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_etudiant ADD CONSTRAINT FK_6F05DB7CDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE utilisateur_institution DROP FOREIGN KEY institution____');
        $this->addSql('ALTER TABLE utilisateur_institution DROP FOREIGN KEY utilisateur____');
        $this->addSql('ALTER TABLE utilisateur_institution ADD CONSTRAINT FK_CE799576FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_institution ADD CONSTRAINT FK_CE79957610405986 FOREIGN KEY (institution_id) REFERENCES institution (id)');
        $this->addSql('ALTER TABLE utilisateur_module DROP FOREIGN KEY module_____');
        $this->addSql('ALTER TABLE utilisateur_module DROP FOREIGN KEY utilisateur_____');
        $this->addSql('ALTER TABLE utilisateur_module ADD CONSTRAINT FK_6D891CA3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur_module ADD CONSTRAINT FK_6D891CA3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module_etudiant DROP FOREIGN KEY FK_15BEF11DDDEAB1A3');
        $this->addSql('ALTER TABLE module_etudiant ADD CONSTRAINT etudiant FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_module DROP FOREIGN KEY FK_6D891CA3FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_module DROP FOREIGN KEY FK_6D891CA3AFC2B591');
        $this->addSql('ALTER TABLE utilisateur_module ADD CONSTRAINT module_____ FOREIGN KEY (module_id) REFERENCES module (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_module ADD CONSTRAINT utilisateur_____ FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_institution DROP FOREIGN KEY FK_CE799576FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_institution DROP FOREIGN KEY FK_CE79957610405986');
        $this->addSql('ALTER TABLE utilisateur_institution ADD CONSTRAINT institution____ FOREIGN KEY (institution_id) REFERENCES institution (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_institution ADD CONSTRAINT utilisateur____ FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX titre ON etudiant (titre)');
        $this->addSql('CREATE INDEX date_naissance ON etudiant (date_naissance)');
        $this->addSql('CREATE INDEX commentaire ON etudiant (commentaire)');
        $this->addSql('CREATE INDEX note ON etudiant (note)');
        $this->addSql('ALTER TABLE utilisateur CHANGE motdepasse motdepasse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur_etudiant DROP FOREIGN KEY FK_6F05DB7CFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_etudiant DROP FOREIGN KEY FK_6F05DB7CDDEAB1A3');
        $this->addSql('ALTER TABLE utilisateur_etudiant ADD CONSTRAINT etudiant_ FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_etudiant ADD CONSTRAINT utilisateur___ FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY FK_634F2C71613FECDF');
        $this->addSql('ALTER TABLE session_module DROP FOREIGN KEY FK_634F2C71AFC2B591');
        $this->addSql('ALTER TABLE session_module ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT module-- FOREIGN KEY (module_id) REFERENCES module (session_de_formation_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_module ADD CONSTRAINT session_ FOREIGN KEY (session_id) REFERENCES session (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX description_idx ON session_module (description)');
        $this->addSql('CREATE INDEX description ON session_module (description)');
        $this->addSql('ALTER TABLE session CHANGE nom nom VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`, CHANGE type type VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`');
        $this->addSql('CREATE INDEX nom ON session (nom)');
        $this->addSql('CREATE INDEX type ON session (type)');
        $this->addSql('CREATE INDEX date_debut ON session (date_debut)');
        $this->addSql('CREATE INDEX date_fin ON session (date_fin)');
        $this->addSql('CREATE INDEX description ON session (description)');
        $this->addSql('ALTER TABLE module ADD session_de_formation_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_C2426282FE28053 ON module (session_de_formation_id)');
        $this->addSql('CREATE INDEX nom ON module (nom, description)');
        $this->addSql('CREATE INDEX nom_2 ON module (nom)');
        $this->addSql('CREATE INDEX description_idx ON module (description)');
        $this->addSql('ALTER TABLE institution_session DROP FOREIGN KEY FK_B4BA234610405986');
        $this->addSql('ALTER TABLE institution_session DROP FOREIGN KEY FK_B4BA2346613FECDF');
        $this->addSql('ALTER TABLE institution_session CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE institution_session ADD CONSTRAINT session FOREIGN KEY (session_id) REFERENCES session (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX institution ON institution_session (institution_id)');
        $this->addSql('CREATE INDEX institution_id ON institution_session (institution_id)');
        $this->addSql('ALTER TABLE institution_session RENAME INDEX idx_b4ba2346613fecdf TO session.id');
        $this->addSql('ALTER TABLE institution_session RENAME INDEX idx_b4ba234610405986 TO institution.id');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY FK_2F4B3B3AD60322AC');
        $this->addSql('ALTER TABLE role_utilisateur DROP FOREIGN KEY FK_2F4B3B3AFB88E14F');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT role FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_utilisateur ADD CONSTRAINT utilisateur FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
