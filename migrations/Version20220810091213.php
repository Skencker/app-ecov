<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810091213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message_chat (id INT AUTO_INCREMENT NOT NULL, user_buy_id_id INT NOT NULL, user_sell_id_id INT NOT NULL, annonce_id_id INT NOT NULL, message LONGTEXT NOT NULL, create_at DATE NOT NULL, INDEX IDX_CC0869734D82E90C (user_buy_id_id), INDEX IDX_CC086973C08B14E7 (user_sell_id_id), INDEX IDX_CC08697368C955C8 (annonce_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message_chat ADD CONSTRAINT FK_CC0869734D82E90C FOREIGN KEY (user_buy_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message_chat ADD CONSTRAINT FK_CC086973C08B14E7 FOREIGN KEY (user_sell_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message_chat ADD CONSTRAINT FK_CC08697368C955C8 FOREIGN KEY (annonce_id_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message_chat DROP FOREIGN KEY FK_CC0869734D82E90C');
        $this->addSql('ALTER TABLE message_chat DROP FOREIGN KEY FK_CC086973C08B14E7');
        $this->addSql('ALTER TABLE message_chat DROP FOREIGN KEY FK_CC08697368C955C8');
        $this->addSql('DROP TABLE message_chat');
    }
}
