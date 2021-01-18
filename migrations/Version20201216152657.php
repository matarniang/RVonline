<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216152657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin CHANGE password Password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament CHANGE Nom Nom VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410AFAC32A');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664108A7FB791');
        $this->addSql('ALTER TABLE horaire DROP FOREIGN KEY FK_BBC83DB6AFAC32A');
        $this->addSql('ALTER TABLE medecin CHANGE Password password VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE medicament CHANGE Nom Nom VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CBFA4707');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C8FBFEDF0');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8BFA4707');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8AFAC32A');
    }
}
