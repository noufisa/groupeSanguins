<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503163420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE donneur (id INT AUTO_INCREMENT NOT NULL, cin VARCHAR(20) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, date_naissance DATETIME NOT NULL, adresse VARCHAR(40) NOT NULL, groupe_sanguin VARCHAR(10) NOT NULL, tel VARCHAR(20) NOT NULL, ville VARCHAR(20) NOT NULL, email VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, tel VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prelevement (id INT AUTO_INCREMENT NOT NULL, donneur_id INT NOT NULL, date DATETIME NOT NULL, qte DOUBLE PRECISION NOT NULL, INDEX IDX_88C8671F9789825B (donneur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technicien (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, user VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, technicien_id INT DEFAULT NULL, prelevement_id INT NOT NULL, date_test DATETIME NOT NULL, groupe VARCHAR(20) NOT NULL, vih VARCHAR(20) DEFAULT NULL, vhc VARCHAR(20) DEFAULT NULL, vhb VARCHAR(20) DEFAULT NULL, INDEX IDX_D87F7E0C13457256 (technicien_id), INDEX IDX_D87F7E0CCE389617 (prelevement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, donneur_id INT NOT NULL, medecin_id INT NOT NULL, age INT NOT NULL, fumeur VARCHAR(20) NOT NULL, poids DOUBLE PRECISION NOT NULL, douleur VARCHAR(20) NOT NULL, alcoole VARCHAR(20) NOT NULL, INDEX IDX_B09C8CBB9789825B (donneur_id), INDEX IDX_B09C8CBB4F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prelevement ADD CONSTRAINT FK_88C8671F9789825B FOREIGN KEY (donneur_id) REFERENCES donneur (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C13457256 FOREIGN KEY (technicien_id) REFERENCES technicien (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CCE389617 FOREIGN KEY (prelevement_id) REFERENCES prelevement (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB9789825B FOREIGN KEY (donneur_id) REFERENCES donneur (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prelevement DROP FOREIGN KEY FK_88C8671F9789825B');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB9789825B');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB4F31A84');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CCE389617');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C13457256');
        $this->addSql('DROP TABLE donneur');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE prelevement');
        $this->addSql('DROP TABLE technicien');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE visite');
    }
}
