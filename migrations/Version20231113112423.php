<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113112423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recap_details DROP FOREIGN KEY FK_1D1FD69F65E9B0F');
        $this->addSql('DROP TABLE recap_details');
        $this->addSql('ALTER TABLE `order` DROP stripe_session_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF65E9B0F');
        $this->addSql('DROP INDEX IDX_D34A04ADF65E9B0F ON product');
        $this->addSql('ALTER TABLE product DROP order_product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recap_details (id INT AUTO_INCREMENT NOT NULL, order_product_id INT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total_recap DOUBLE PRECISION NOT NULL, product VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1D1FD69F65E9B0F (order_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recap_details ADD CONSTRAINT FK_1D1FD69F65E9B0F FOREIGN KEY (order_product_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` ADD stripe_session_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD order_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF65E9B0F FOREIGN KEY (order_product_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF65E9B0F ON product (order_product_id)');
    }
}
