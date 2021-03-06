<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171007203728 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dance_category ADD dance_style_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dance_category ADD CONSTRAINT FK_66B1B23ADA30CB8F FOREIGN KEY (dance_style_id) REFERENCES dance_style (id)');
        $this->addSql('CREATE INDEX IDX_66B1B23ADA30CB8F ON dance_category (dance_style_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dance_category DROP FOREIGN KEY FK_66B1B23ADA30CB8F');
        $this->addSql('DROP INDEX IDX_66B1B23ADA30CB8F ON dance_category');
        $this->addSql('ALTER TABLE dance_category DROP dance_style_id');
    }
}
