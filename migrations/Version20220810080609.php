<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810080609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_buy_id_id INT NOT NULL, user_sell_id_id INT NOT NULL, annonce_id_id INT NOT NULL, message LONGTEXT NOT NULL, create_at DATE NOT NULL, INDEX IDX_B6BD307F4D82E90C (user_buy_id_id), INDEX IDX_B6BD307FC08B14E7 (user_sell_id_id), INDEX IDX_B6BD307F68C955C8 (annonce_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4D82E90C FOREIGN KEY (user_buy_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FC08B14E7 FOREIGN KEY (user_sell_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F68C955C8 FOREIGN KEY (annonce_id_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE annonce CHANGE slug slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4D82E90C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC08B14E7');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F68C955C8');
        $this->addSql('DROP TABLE message');
        $this->addSql('ALTER TABLE annonce CHANGE slug slug VARCHAR(255) DEFAULT NULL');
    }
}
