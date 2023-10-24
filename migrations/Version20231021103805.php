<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021103805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE assureur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE consultation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE domaine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE horaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medecin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mode_reg_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nationalite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rdv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reglement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE specialite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE assureur (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE consultation (id INT NOT NULL, patient_id INT NOT NULL, numero INT NOT NULL, annee INT NOT NULL, date_cons DATE NOT NULL, observation VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_964685A66B899279 ON consultation (patient_id)');
        $this->addSql('CREATE TABLE domaine (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE horaire (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, specialite_id INT NOT NULL, categorie_id INT NOT NULL, nationalite_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) NOT NULL, gsm VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1BDA53C62195E0F0 ON medecin (specialite_id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C6BCF5E72D ON medecin (categorie_id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C61B063272 ON medecin (nationalite_id)');
        $this->addSql('CREATE TABLE mode_reg (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nationalite (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rdv (id INT NOT NULL, horaire_id INT NOT NULL, patient_id INT NOT NULL, numero INT NOT NULL, annee INT NOT NULL, date_rdv DATE NOT NULL, observation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_10C31F8658C54515 ON rdv (horaire_id)');
        $this->addSql('CREATE INDEX IDX_10C31F866B899279 ON rdv (patient_id)');
        $this->addSql('CREATE TABLE reglement (id INT NOT NULL, patient_id INT NOT NULL, modereg_id INT NOT NULL, numero INT NOT NULL, annee INT NOT NULL, date_reglement DATE NOT NULL, num_piece VARCHAR(255) DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, observation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EBE4C14C6B899279 ON reglement (patient_id)');
        $this->addSql('CREATE INDEX IDX_EBE4C14CE1AFE3AF ON reglement (modereg_id)');
        $this->addSql('CREATE TABLE specialite (id INT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C62195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C61B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8658C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F866B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14CE1AFE3AF FOREIGN KEY (modereg_id) REFERENCES mode_reg (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD nationalite_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient ADD domaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD assureur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient DROP assureur');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB80F7E20A FOREIGN KEY (assureur_id) REFERENCES assureur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB1B063272 ON patient (nationalite_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB4272FC9F ON patient (domaine_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB80F7E20A ON patient (assureur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB80F7E20A');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB4272FC9F');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB1B063272');
        $this->addSql('DROP SEQUENCE assureur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE consultation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE domaine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE horaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medecin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mode_reg_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nationalite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rdv_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reglement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE specialite_id_seq CASCADE');
        $this->addSql('ALTER TABLE consultation DROP CONSTRAINT FK_964685A66B899279');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C62195E0F0');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C6BCF5E72D');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C61B063272');
        $this->addSql('ALTER TABLE rdv DROP CONSTRAINT FK_10C31F8658C54515');
        $this->addSql('ALTER TABLE rdv DROP CONSTRAINT FK_10C31F866B899279');
        $this->addSql('ALTER TABLE reglement DROP CONSTRAINT FK_EBE4C14C6B899279');
        $this->addSql('ALTER TABLE reglement DROP CONSTRAINT FK_EBE4C14CE1AFE3AF');
        $this->addSql('DROP TABLE assureur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE mode_reg');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP INDEX IDX_1ADAD7EB1B063272');
        $this->addSql('DROP INDEX IDX_1ADAD7EB4272FC9F');
        $this->addSql('DROP INDEX IDX_1ADAD7EB80F7E20A');
        $this->addSql('ALTER TABLE patient ADD assureur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient DROP nationalite_id');
        $this->addSql('ALTER TABLE patient DROP domaine_id');
        $this->addSql('ALTER TABLE patient DROP assureur_id');
    }
}
