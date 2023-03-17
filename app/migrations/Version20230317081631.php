<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230317081631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, unicorn_id INT DEFAULT NULL, unicorn_enthusiast_id INT NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5A8A6C8D2AF80346 (unicorn_id), INDEX IDX_5A8A6C8D81D186E6 (unicorn_enthusiast_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, unicorn_name VARCHAR(255) NOT NULL, unicorn_id INT NOT NULL, unicorn_enthusiast_name VARCHAR(255) NOT NULL, unicorn_enthusiast_id INT NOT NULL, no_of_post INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unicorn (id INT AUTO_INCREMENT NOT NULL, mother_id INT DEFAULT NULL, father_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, birth_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(200) NOT NULL, average_height DOUBLE PRECISION DEFAULT NULL, average_width DOUBLE PRECISION DEFAULT NULL, avarage_weight DOUBLE PRECISION DEFAULT NULL, hair_color VARCHAR(20) DEFAULT NULL, eye_color VARCHAR(20) DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_58FBD83FB78A354D (mother_id), INDEX IDX_58FBD83F2055B9A2 (father_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unicorn_enthusiast (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6F05D554E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D2AF80346 FOREIGN KEY (unicorn_id) REFERENCES unicorn (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D81D186E6 FOREIGN KEY (unicorn_enthusiast_id) REFERENCES unicorn_enthusiast (id)');
        $this->addSql('ALTER TABLE unicorn ADD CONSTRAINT FK_58FBD83FB78A354D FOREIGN KEY (mother_id) REFERENCES unicorn (id)');
        $this->addSql('ALTER TABLE unicorn ADD CONSTRAINT FK_58FBD83F2055B9A2 FOREIGN KEY (father_id) REFERENCES unicorn (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D2AF80346');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D81D186E6');
        $this->addSql('ALTER TABLE unicorn DROP FOREIGN KEY FK_58FBD83FB78A354D');
        $this->addSql('ALTER TABLE unicorn DROP FOREIGN KEY FK_58FBD83F2055B9A2');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE unicorn');
        $this->addSql('DROP TABLE unicorn_enthusiast');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
