<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171005204242 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE style_category (id INT AUTO_INCREMENT NOT NULL, dance_style_id INT DEFAULT NULL, dance_category_id INT DEFAULT NULL, potential_trainers_id INT DEFAULT NULL, INDEX IDX_279EC1EADA30CB8F (dance_style_id), INDEX IDX_279EC1EA2528EA30 (dance_category_id), INDEX IDX_279EC1EAB6B8A311 (potential_trainers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dance_style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_497D309D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, lesson_id INT DEFAULT NULL, post LONGTEXT NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526CCDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, classroom_id INT DEFAULT NULL, level_id INT DEFAULT NULL, referent INT DEFAULT NULL, event_id INT DEFAULT NULL, day DATE NOT NULL, begingAt TIME NOT NULL, endAt TIME NOT NULL, numberOfDancersMax INT DEFAULT NULL, danceCategory_id INT DEFAULT NULL, INDEX IDX_F87474F341DDC0A6 (danceCategory_id), INDEX IDX_F87474F36278D5A8 (classroom_id), INDEX IDX_F87474F35FB14BA7 (level_id), INDEX IDX_F87474F3FE9AAC6C (referent), INDEX IDX_F87474F371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dancer (lesson_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B11CC8A9CDF80196 (lesson_id), INDEX IDX_B11CC8A9A76ED395 (user_id), PRIMARY KEY(lesson_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainer (lesson_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C5150820CDF80196 (lesson_id), INDEX IDX_C5150820A76ED395 (user_id), PRIMARY KEY(lesson_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dance_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, begingAt DATETIME NOT NULL, endAt DATE NOT NULL, place VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_dance_category (user_id INT NOT NULL, dance_category_id INT NOT NULL, INDEX IDX_D346D63A76ED395 (user_id), INDEX IDX_D346D632528EA30 (dance_category_id), PRIMARY KEY(user_id, dance_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EADA30CB8F FOREIGN KEY (dance_style_id) REFERENCES dance_style (id)');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EA2528EA30 FOREIGN KEY (dance_category_id) REFERENCES dance_category (id)');
        $this->addSql('ALTER TABLE style_category ADD CONSTRAINT FK_279EC1EAB6B8A311 FOREIGN KEY (potential_trainers_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F341DDC0A6 FOREIGN KEY (danceCategory_id) REFERENCES dance_category (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F36278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F35FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3FE9AAC6C FOREIGN KEY (referent) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE dancer ADD CONSTRAINT FK_B11CC8A9CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dancer ADD CONSTRAINT FK_B11CC8A9A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C5150820A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_dance_category ADD CONSTRAINT FK_D346D63A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_dance_category ADD CONSTRAINT FK_D346D632528EA30 FOREIGN KEY (dance_category_id) REFERENCES dance_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user ADD adherent TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE style_category DROP FOREIGN KEY FK_279EC1EADA30CB8F');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F36278D5A8');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCDF80196');
        $this->addSql('ALTER TABLE dancer DROP FOREIGN KEY FK_B11CC8A9CDF80196');
        $this->addSql('ALTER TABLE trainer DROP FOREIGN KEY FK_C5150820CDF80196');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F35FB14BA7');
        $this->addSql('ALTER TABLE style_category DROP FOREIGN KEY FK_279EC1EA2528EA30');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F341DDC0A6');
        $this->addSql('ALTER TABLE user_dance_category DROP FOREIGN KEY FK_D346D632528EA30');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F371F7E88B');
        $this->addSql('DROP TABLE style_category');
        $this->addSql('DROP TABLE dance_style');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE dancer');
        $this->addSql('DROP TABLE trainer');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE dance_category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE user_dance_category');
        $this->addSql('ALTER TABLE fos_user DROP adherent');
    }
}
