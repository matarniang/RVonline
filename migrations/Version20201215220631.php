<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215220631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (idAdministrateur INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(20) DEFAULT NULL, Email VARCHAR(30) DEFAULT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(idAdministrateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (idEmploye INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(20) DEFAULT NULL, Contact VARCHAR(20) DEFAULT NULL, Email VARCHAR(20) DEFAULT NULL, Designation VARCHAR(20) DEFAULT NULL, PRIMARY KEY(idEmploye)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (idtraitement INT AUTO_INCREMENT NOT NULL, Frais INT DEFAULT NULL, Traitement VARCHAR(20) DEFAULT NULL, Date_ DATE DEFAULT NULL, Heure VARCHAR(10) DEFAULT NULL, id_Medecin INT DEFAULT NULL, id_RendezVous INT DEFAULT NULL, INDEX IDX_FE866410AFAC32A (id_Medecin), INDEX IDX_FE8664108A7FB791 (id_RendezVous), PRIMARY KEY(idtraitement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaire (idTimings INT AUTO_INCREMENT NOT NULL, Time VARCHAR(255) NOT NULL, id_Medecin INT DEFAULT NULL, INDEX IDX_BBC83DB6AFAC32A (id_Medecin), PRIMARY KEY(idTimings)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (idMedecin INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(255) DEFAULT NULL, Specialite VARCHAR(255) DEFAULT NULL, Email VARCHAR(255) DEFAULT NULL, Contact VARCHAR(255) DEFAULT NULL, Password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idMedecin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (Nom VARCHAR(20) NOT NULL, Description VARCHAR(20) DEFAULT NULL, PRIMARY KEY(Nom)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id_traitement INT DEFAULT NULL, idOrdonnance INT AUTO_INCREMENT NOT NULL, Medicament VARCHAR(20) DEFAULT NULL, id_Patient INT DEFAULT NULL, INDEX IDX_924B326CBFA4707 (id_Patient), INDEX IDX_924B326C8FBFEDF0 (id_traitement), PRIMARY KEY(idOrdonnance)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (idPatient INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(20) DEFAULT NULL, Date_Naissance DATE DEFAULT NULL, Email VARCHAR(255) DEFAULT NULL, Numero_Telephone VARCHAR(255) DEFAULT NULL, Adresse VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(idPatient)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (idRendezVous INT AUTO_INCREMENT NOT NULL, Date_Reservation DATE DEFAULT NULL, Date_rdv DATE DEFAULT NULL, id_Patient INT DEFAULT NULL, id_Medecin INT DEFAULT NULL, INDEX IDX_C09A9BA8BFA4707 (id_Patient), INDEX IDX_C09A9BA8AFAC32A (id_Medecin), PRIMARY KEY(idRendezVous)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410AFAC32A FOREIGN KEY (id_Medecin) REFERENCES medecin (idMedecin)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664108A7FB791 FOREIGN KEY (id_RendezVous) REFERENCES rendezvous (idRendezVous)');
        $this->addSql('ALTER TABLE horaire ADD CONSTRAINT FK_BBC83DB6AFAC32A FOREIGN KEY (id_Medecin) REFERENCES medecin (idMedecin)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CBFA4707 FOREIGN KEY (id_Patient) REFERENCES patient (idPatient)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C8FBFEDF0 FOREIGN KEY (id_traitement) REFERENCES facture (idtraitement)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8BFA4707 FOREIGN KEY (id_Patient) REFERENCES patient (idPatient)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8AFAC32A FOREIGN KEY (id_Medecin) REFERENCES medecin (idMedecin)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C8FBFEDF0');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410AFAC32A');
        $this->addSql('ALTER TABLE horaire DROP FOREIGN KEY FK_BBC83DB6AFAC32A');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8AFAC32A');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CBFA4707');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8BFA4707');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664108A7FB791');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE rendezvous');
    }
}
