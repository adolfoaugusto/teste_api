<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617163527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documentos (id INT AUTO_INCREMENT NOT NULL, tipo_id_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, nome_arquivo VARCHAR(255) NOT NULL, INDEX IDX_1EB8293679F8049F (tipo_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_documento (id INT AUTO_INCREMENT NOT NULL, nome_tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB8293679F8049F FOREIGN KEY (tipo_id_id) REFERENCES tipo_documento (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB8293679F8049F');
        $this->addSql('DROP TABLE documentos');
        $this->addSql('DROP TABLE tipo_documento');
    }
}
