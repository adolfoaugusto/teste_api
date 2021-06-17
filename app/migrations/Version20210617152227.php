<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617152227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentos ADD tipo_id_id INT DEFAULT NULL, DROP tipo_id');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB8293679F8049F FOREIGN KEY (tipo_id_id) REFERENCES tipo_documento (id)');
        $this->addSql('CREATE INDEX IDX_1EB8293679F8049F ON documentos (tipo_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB8293679F8049F');
        $this->addSql('DROP INDEX IDX_1EB8293679F8049F ON documentos');
        $this->addSql('ALTER TABLE documentos ADD tipo_id INT NOT NULL, DROP tipo_id_id');
    }
}
