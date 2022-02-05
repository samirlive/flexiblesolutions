<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201100223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD company_name VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD department VARCHAR(255) DEFAULT NULL, ADD postcode VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL, ADD comment LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP first_name, DROP last_name, DROP company_name, DROP address, DROP city, DROP country, DROP department, DROP postcode, DROP email, DROP tel, DROP comment');
    }
}
