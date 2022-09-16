<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905181838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE processes ADD work_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE processes ADD CONSTRAINT FK_A4289E4CBB3453DB FOREIGN KEY (work_id) REFERENCES works (id)');
        $this->addSql('CREATE INDEX IDX_A4289E4CBB3453DB ON processes (work_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE processes DROP FOREIGN KEY FK_A4289E4CBB3453DB');
        $this->addSql('DROP INDEX IDX_A4289E4CBB3453DB ON processes');
        $this->addSql('ALTER TABLE processes DROP work_id');
    }
}
