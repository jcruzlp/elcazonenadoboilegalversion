<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250924161228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_skill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee_skill (id INT NOT NULL, employee_id INT NOT NULL, skill_id INT NOT NULL, level VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B630E90E8C03F15C ON employee_skill (employee_id)');
        $this->addSql('CREATE INDEX IDX_B630E90E5585C142 ON employee_skill (skill_id)');
        $this->addSql('ALTER TABLE employee_skill ADD CONSTRAINT FK_B630E90E8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_skill ADD CONSTRAINT FK_B630E90E5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_skill_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_skill DROP CONSTRAINT FK_B630E90E8C03F15C');
        $this->addSql('ALTER TABLE employee_skill DROP CONSTRAINT FK_B630E90E5585C142');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_skill');
    }
}
