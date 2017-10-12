<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171007204659 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE style_category (id INT AUTO_INCREMENT NOT NULL, dance_style_id INT DEFAULT NULL, dance_category_id INT DEFAULT NULL, potential_trainers_id INT DEFAULT NULL, INDEX IDX_279EC1EADA30CB8F (dance_style_id), INDEX IDX_279EC1EA2528EA30 (dance_category_id), INDEX IDX_279EC1EAB6B8A311 (potential_trainers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EADA30CB8F FOREIGN KEY (dance_style_id) REFERENCES dance_style (id)');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EA2528EA30 FOREIGN KEY (dance_category_id) REFERENCES dance_category (id)');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EAB6B8A311 FOREIGN KEY (potential_trainers_id) REFERENCES fos_user (id)');
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

        $this->addSql('DROP TABLE style_category');
        $this->addSql('ALTER TABLE dance_category DROP FOREIGN KEY FK_66B1B23ADA30CB8F');
        $this->addSql('DROP INDEX IDX_66B1B23ADA30CB8F ON dance_category');
        $this->addSql('ALTER TABLE dance_category DROP dance_style_id');
    }
}
