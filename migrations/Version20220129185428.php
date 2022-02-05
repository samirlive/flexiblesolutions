<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129185428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_category_product (product_id INT NOT NULL, category_product_id INT NOT NULL, INDEX IDX_9A1E202F4584665A (product_id), INDEX IDX_9A1E202F639A3624 (category_product_id), PRIMARY KEY(product_id, category_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_category_product ADD CONSTRAINT FK_9A1E202F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category_product ADD CONSTRAINT FK_9A1E202F639A3624 FOREIGN KEY (category_product_id) REFERENCES flexy_categoryproduct (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE category_product_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_product_product (category_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_5A1A434F4584665A (product_id), INDEX IDX_5A1A434F639A3624 (category_product_id), PRIMARY KEY(category_product_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_product_product ADD CONSTRAINT FK_5A1A434F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product_product ADD CONSTRAINT FK_5A1A434F639A3624 FOREIGN KEY (category_product_id) REFERENCES flexy_categoryproduct (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_category_product');
    }
}
