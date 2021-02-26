<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225072558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT fk_f87474f31e27f6bf');
        $this->addSql('DROP INDEX uniq_f87474f31e27f6bf');
        $this->addSql('ALTER TABLE lesson DROP question_id');
        $this->addSql('ALTER TABLE question ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494ECDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F7494ECDF80196 ON question (lesson_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lesson ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT fk_f87474f31e27f6bf FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_f87474f31e27f6bf ON lesson (question_id)');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494ECDF80196');
        $this->addSql('DROP INDEX IDX_B6F7494ECDF80196');
        $this->addSql('ALTER TABLE question DROP lesson_id');
    }
}
