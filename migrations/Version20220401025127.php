<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401025127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookmark (url VARCHAR(255) NOT NULL, provider_name VARCHAR(50) NOT NULL, link_title VARCHAR(255) NOT NULL, link_author VARCHAR(100) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', publication_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(url)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_size (id INT AUTO_INCREMENT NOT NULL, width DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_provider (id INT AUTO_INCREMENT NOT NULL, provider_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_5F6E1355BBAB1D7A (provider_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_link (id INT AUTO_INCREMENT NOT NULL, type_link_name VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_E1A35CF95BA2ADBF (type_link_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_size (id INT AUTO_INCREMENT NOT NULL, duration DOUBLE PRECISION NOT NULL, width DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bookmark');
        $this->addSql('DROP TABLE image_size');
        $this->addSql('DROP TABLE link_provider');
        $this->addSql('DROP TABLE type_link');
        $this->addSql('DROP TABLE video_size');
    }
}
