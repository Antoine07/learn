<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224204504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesson_taxonomy (lesson_id INT NOT NULL, taxonomy_id INT NOT NULL, PRIMARY KEY(lesson_id, taxonomy_id))');
        $this->addSql('CREATE INDEX IDX_B555F224CDF80196 ON lesson_taxonomy (lesson_id)');
        $this->addSql('CREATE INDEX IDX_B555F2249557E6F6 ON lesson_taxonomy (taxonomy_id)');
        $this->addSql('ALTER TABLE lesson_taxonomy ADD CONSTRAINT FK_B555F224CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_taxonomy ADD CONSTRAINT FK_B555F2249557E6F6 FOREIGN KEY (taxonomy_id) REFERENCES taxonomy (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE lesson_taxonomy');
    }
}
