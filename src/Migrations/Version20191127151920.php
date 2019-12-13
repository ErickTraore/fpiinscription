<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127151920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE count (id INT AUTO_INCREMENT NOT NULL, adhesion_id INT NOT NULL, ref VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, p_un_ht NUMERIC(10, 0) DEFAULT NULL, qte INT DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, p_un_ht_rem NUMERIC(10, 0) DEFAULT NULL, prix_tot_ht NUMERIC(10, 0) DEFAULT NULL, tva NUMERIC(10, 0) DEFAULT NULL, date_bill DATETIME DEFAULT NULL, total_ttc NUMERIC(10, 0) DEFAULT NULL, tot_cumul NUMERIC(10, 0) DEFAULT NULL, date_cumul DATETIME DEFAULT NULL, date_echeance DATETIME DEFAULT NULL, INDEX IDX_85D94462F68139D7 (adhesion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fpilyon (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, selection TINYINT(1) DEFAULT NULL, remarque VARCHAR(255) DEFAULT NULL, selectiontest TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adhesion (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, gender TINYINT(1) NOT NULL, statut TINYINT(1) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, lieu_naissance VARCHAR(255) DEFAULT NULL, nationnalite VARCHAR(255) DEFAULT NULL, nature_identite VARCHAR(255) DEFAULT NULL, number_identity VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, codepostale VARCHAR(5) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, birthday DATE DEFAULT NULL, dateadhesion DATETIME DEFAULT NULL, dateecheancebis DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C50CA65A3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, adhesion_id INT DEFAULT NULL, username VARCHAR(191) NOT NULL, password VARCHAR(70) NOT NULL, date_crea DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649F68139D7 (adhesion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE count ADD CONSTRAINT FK_85D94462F68139D7 FOREIGN KEY (adhesion_id) REFERENCES adhesion (id)');
        $this->addSql('ALTER TABLE adhesion ADD CONSTRAINT FK_C50CA65A3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F68139D7 FOREIGN KEY (adhesion_id) REFERENCES adhesion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adhesion DROP FOREIGN KEY FK_C50CA65A3DA5256D');
        $this->addSql('ALTER TABLE count DROP FOREIGN KEY FK_85D94462F68139D7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F68139D7');
        $this->addSql('DROP TABLE count');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE fpilyon');
        $this->addSql('DROP TABLE adhesion');
        $this->addSql('DROP TABLE user');
    }
}
