<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204161115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('COMMENT ON COLUMN questionnaire.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE questionnaire_result ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE questionnaire_result ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('COMMENT ON COLUMN questionnaire_result.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE questionnaire_result ALTER created_at TYPE DATE');
        $this->addSql('ALTER TABLE questionnaire_result ALTER created_at DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN questionnaire_result.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE questionnaire DROP created_at');
    }
}
