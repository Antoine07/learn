<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225074337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD user_bill_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E342810CFF FOREIGN KEY (user_bill_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A2119E342810CFF ON bill (user_bill_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bill DROP CONSTRAINT FK_7A2119E342810CFF');
        $this->addSql('DROP INDEX IDX_7A2119E342810CFF');
        $this->addSql('ALTER TABLE bill DROP user_bill_id');
    }
}
