<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224170154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE taxonomy_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE term_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, address TEXT DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bill (id INT NOT NULL, number VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bill_lesson (bill_id INT NOT NULL, lesson_id INT NOT NULL, PRIMARY KEY(bill_id, lesson_id))');
        $this->addSql('CREATE INDEX IDX_EFF53AE51A8C12F5 ON bill_lesson (bill_id)');
        $this->addSql('CREATE INDEX IDX_EFF53AE5CDF80196 ON bill_lesson (lesson_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, lesson_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CCDF80196 ON comment (lesson_id)');
        $this->addSql('CREATE TABLE lesson (id INT NOT NULL, resource_id INT DEFAULT NULL, question_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, status VARCHAR(100) NOT NULL, slug VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F87474F389329D25 ON lesson (resource_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F87474F31E27F6BF ON lesson (question_id)');
        $this->addSql('CREATE TABLE lesson_author (lesson_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(lesson_id, author_id))');
        $this->addSql('CREATE INDEX IDX_CE39289FCDF80196 ON lesson_author (lesson_id)');
        $this->addSql('CREATE INDEX IDX_CE39289FF675F31B ON lesson_author (author_id)');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, template_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F5DA0FB8 ON profile (template_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, name VARCHAR(100) NOT NULL, choices JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resource (id INT NOT NULL, name VARCHAR(100) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscription (id INT NOT NULL, name VARCHAR(100) NOT NULL, status VARCHAR(100) DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE taxonomy (id INT NOT NULL, term_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, parent INT DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD12B83DE2C35FC ON taxonomy (term_id)');
        $this->addSql('CREATE TABLE template (id INT NOT NULL, name VARCHAR(100) NOT NULL, description JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE term (id INT NOT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, sluf VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, profile_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(100) DEFAULT NULL, login VARCHAR(100) DEFAULT NULL, active_key VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, content JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CCFA12B8 ON "user" (profile_id)');
        $this->addSql('ALTER TABLE bill_lesson ADD CONSTRAINT FK_EFF53AE51A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bill_lesson ADD CONSTRAINT FK_EFF53AE5CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F389329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F31E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_author ADD CONSTRAINT FK_CE39289FCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_author ADD CONSTRAINT FK_CE39289FF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxonomy ADD CONSTRAINT FK_FD12B83DE2C35FC FOREIGN KEY (term_id) REFERENCES term (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lesson_author DROP CONSTRAINT FK_CE39289FF675F31B');
        $this->addSql('ALTER TABLE bill_lesson DROP CONSTRAINT FK_EFF53AE51A8C12F5');
        $this->addSql('ALTER TABLE bill_lesson DROP CONSTRAINT FK_EFF53AE5CDF80196');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CCDF80196');
        $this->addSql('ALTER TABLE lesson_author DROP CONSTRAINT FK_CE39289FCDF80196');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT FK_F87474F31E27F6BF');
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT FK_F87474F389329D25');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0F5DA0FB8');
        $this->addSql('ALTER TABLE taxonomy DROP CONSTRAINT FK_FD12B83DE2C35FC');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bill_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscription_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE taxonomy_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE template_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE term_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE bill_lesson');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE lesson_author');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE taxonomy');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE term');
        $this->addSql('DROP TABLE "user"');
    }
}
