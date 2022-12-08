<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207223050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE id_demande id_demande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande CHANGE id_service id_service INT DEFAULT NULL, CHANGE id_Prestataire id_Prestataire INT DEFAULT NULL, CHANGE Id_Client Id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion CHANGE id_service id_service INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate CHANGE id_Prestataire id_Prestataire INT DEFAULT NULL, CHANGE Id_Client Id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE id_Prestataire id_Prestataire INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categorie CHANGE id_demande id_demande INT NOT NULL');
        $this->addSql('ALTER TABLE demande CHANGE id_service id_service INT NOT NULL, CHANGE id_Prestataire id_Prestataire INT NOT NULL, CHANGE Id_Client Id_Client INT NOT NULL');
        $this->addSql('ALTER TABLE promotion CHANGE id_service id_service INT NOT NULL');
        $this->addSql('ALTER TABLE rate CHANGE Id_Client Id_Client INT NOT NULL, CHANGE id_Prestataire id_Prestataire INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE id_Prestataire id_Prestataire INT NOT NULL');
    }
}
