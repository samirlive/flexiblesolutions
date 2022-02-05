<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129120822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
        $this->addSql('ALTER TABLE order_item ADD product_id INT DEFAULT NULL, ADD parent_order_id INT DEFAULT NULL, ADD quantity INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F091252C1E9 FOREIGN KEY (parent_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F091252C1E9 ON order_item (parent_order_id)');
        $this->addSql('ALTER TABLE payment ADD payment_method_id INT NOT NULL, ADD amount DOUBLE PRECISION NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D5AA1164F ON payment (payment_method_id)');
        $this->addSql('ALTER TABLE payment_method ADD code VARCHAR(255) NOT NULL, ADD is_enabled TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion ADD code VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD priority INT DEFAULT NULL, ADD usage_limit INT DEFAULT NULL, ADD start_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE promotion_action ADD promotion_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE promotion_action ADD CONSTRAINT FK_5276A7AF139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_5276A7AF139DF194 ON promotion_action (promotion_id)');
        $this->addSql('ALTER TABLE promotion_rule ADD promotion_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion_rule ADD CONSTRAINT FK_F0222453139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_F0222453139DF194 ON promotion_rule (promotion_id)');
        $this->addSql('ALTER TABLE shipping_method ADD code VARCHAR(255) NOT NULL, ADD is_enabled TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE shippment ADD method_id INT NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD tracking_code VARCHAR(255) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE shippment ADD CONSTRAINT FK_EBB1619119883967 FOREIGN KEY (method_id) REFERENCES shipping_method (id)');
        $this->addSql('CREATE INDEX IDX_EBB1619119883967 ON shippment (method_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F091252C1E9');
        $this->addSql('DROP INDEX IDX_52EA1F094584665A ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F091252C1E9 ON order_item');
        $this->addSql('ALTER TABLE order_item DROP product_id, DROP parent_order_id, DROP quantity, DROP price');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D5AA1164F');
        $this->addSql('DROP INDEX IDX_6D28840D5AA1164F ON payment');
        $this->addSql('ALTER TABLE payment DROP payment_method_id, DROP amount, DROP state, DROP description');
        $this->addSql('ALTER TABLE payment_method DROP code, DROP is_enabled, DROP created_at, DROP position');
        $this->addSql('ALTER TABLE promotion DROP code, DROP name, DROP priority, DROP usage_limit, DROP start_at, DROP end_at');
        $this->addSql('ALTER TABLE promotion_action DROP FOREIGN KEY FK_5276A7AF139DF194');
        $this->addSql('DROP INDEX IDX_5276A7AF139DF194 ON promotion_action');
        $this->addSql('ALTER TABLE promotion_action DROP promotion_id, DROP name, DROP type');
        $this->addSql('ALTER TABLE promotion_rule DROP FOREIGN KEY FK_F0222453139DF194');
        $this->addSql('DROP INDEX IDX_F0222453139DF194 ON promotion_rule');
        $this->addSql('ALTER TABLE promotion_rule DROP promotion_id, DROP name, DROP type');
        $this->addSql('ALTER TABLE shipping_method DROP code, DROP is_enabled, DROP created_at');
        $this->addSql('ALTER TABLE shippment DROP FOREIGN KEY FK_EBB1619119883967');
        $this->addSql('DROP INDEX IDX_EBB1619119883967 ON shippment');
        $this->addSql('ALTER TABLE shippment DROP method_id, DROP state, DROP tracking_code, DROP description');
    }
}
