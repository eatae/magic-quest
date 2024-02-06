<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204130634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE answer_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE questionnaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE questionnaire_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_id INT NOT NULL, template VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE answer_result (id INT NOT NULL, question_result_id INT NOT NULL, answer_id INT NOT NULL, selected BOOLEAN NOT NULL, success BOOLEAN NOT NULL, order_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E193FBB4E72F2D8 ON answer_result (question_result_id)');
        $this->addSql('CREATE INDEX IDX_E193FBB4AA334807 ON answer_result (answer_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, questionnaire_id INT NOT NULL, template VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494ECE07E8FF ON question (questionnaire_id)');
        $this->addSql('CREATE TABLE question_result (id INT NOT NULL, questionnaire_result_id INT NOT NULL, question_id INT NOT NULL, success BOOLEAN NOT NULL, order_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1437EE1B943072D7 ON question_result (questionnaire_result_id)');
        $this->addSql('CREATE INDEX IDX_1437EE1B1E27F6BF ON question_result (question_id)');
        $this->addSql('CREATE TABLE questionnaire (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE questionnaire_result (id INT NOT NULL, questionnaire_id INT NOT NULL, user_name VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8ACCCE2ACE07E8FF ON questionnaire_result (questionnaire_id)');
        $this->addSql('COMMENT ON COLUMN questionnaire_result.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_result ADD CONSTRAINT FK_E193FBB4E72F2D8 FOREIGN KEY (question_result_id) REFERENCES question_result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_result ADD CONSTRAINT FK_E193FBB4AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494ECE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_result ADD CONSTRAINT FK_1437EE1B943072D7 FOREIGN KEY (questionnaire_result_id) REFERENCES questionnaire_result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_result ADD CONSTRAINT FK_1437EE1B1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questionnaire_result ADD CONSTRAINT FK_8ACCCE2ACE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE answer_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE questionnaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE questionnaire_result_id_seq CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer_result DROP CONSTRAINT FK_E193FBB4E72F2D8');
        $this->addSql('ALTER TABLE answer_result DROP CONSTRAINT FK_E193FBB4AA334807');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494ECE07E8FF');
        $this->addSql('ALTER TABLE question_result DROP CONSTRAINT FK_1437EE1B943072D7');
        $this->addSql('ALTER TABLE question_result DROP CONSTRAINT FK_1437EE1B1E27F6BF');
        $this->addSql('ALTER TABLE questionnaire_result DROP CONSTRAINT FK_8ACCCE2ACE07E8FF');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_result');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_result');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE questionnaire_result');
    }
}
