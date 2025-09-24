<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250924144512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE skill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE profile_skill (profile_id INT NOT NULL, skill_id INT NOT NULL, PRIMARY KEY(profile_id, skill_id))');
        $this->addSql('CREATE INDEX IDX_A9E97BA5CCFA12B8 ON profile_skill (profile_id)');
        $this->addSql('CREATE INDEX IDX_A9E97BA55585C142 ON profile_skill (skill_id)');
        $this->addSql('CREATE TABLE skill (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE profile_skill ADD CONSTRAINT FK_A9E97BA5CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile_skill ADD CONSTRAINT FK_A9E97BA55585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE skill_id_seq CASCADE');
        $this->addSql('ALTER TABLE profile_skill DROP CONSTRAINT FK_A9E97BA5CCFA12B8');
        $this->addSql('ALTER TABLE profile_skill DROP CONSTRAINT FK_A9E97BA55585C142');
        $this->addSql('DROP TABLE profile_skill');
        $this->addSql('DROP TABLE skill');
    }
}
