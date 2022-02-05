<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130191503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE master_slider (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, grand_titre VARCHAR(255) DEFAULT NULL, petit_titre VARCHAR(255) DEFAULT NULL, texte_prix VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, titre_btn VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pub_banner (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, emplacement VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE master_slider');
        $this->addSql('DROP TABLE pub_banner');
    }
}
