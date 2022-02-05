<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201114532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vendor ADD full_name VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD ice VARCHAR(255) NOT NULL, ADD rc VARCHAR(255) NOT NULL, ADD simulate_username VARCHAR(255) NOT NULL, ADD simulate_password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vendor DROP full_name, DROP tel, DROP address, DROP city, DROP ice, DROP rc, DROP simulate_username, DROP simulate_password');
    }
}
