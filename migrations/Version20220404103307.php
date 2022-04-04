<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404103307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookmark (id INT AUTO_INCREMENT NOT NULL, type_link_id INT DEFAULT NULL, link_provider_id INT DEFAULT NULL, image_size_id INT DEFAULT NULL, video_size_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, link_title VARCHAR(255) NOT NULL, link_author VARCHAR(100) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', publication_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_DA62921D85856D84 (type_link_id), INDEX IDX_DA62921DC7D324F9 (link_provider_id), INDEX IDX_DA62921DDC9DFFFB (image_size_id), INDEX IDX_DA62921DAC60418A (video_size_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_size (id INT AUTO_INCREMENT NOT NULL, width DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_provider (id INT AUTO_INCREMENT NOT NULL, provider_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_5F6E1355BBAB1D7A (provider_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_link (id INT AUTO_INCREMENT NOT NULL, type_link_name VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_E1A35CF95BA2ADBF (type_link_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_link_link_provider (type_link_id INT NOT NULL, link_provider_id INT NOT NULL, INDEX IDX_4D97649985856D84 (type_link_id), INDEX IDX_4D976499C7D324F9 (link_provider_id), PRIMARY KEY(type_link_id, link_provider_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_link_image_size (type_link_id INT NOT NULL, image_size_id INT NOT NULL, INDEX IDX_A5449A7585856D84 (type_link_id), INDEX IDX_A5449A75DC9DFFFB (image_size_id), PRIMARY KEY(type_link_id, image_size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_link_video_size (type_link_id INT NOT NULL, video_size_id INT NOT NULL, INDEX IDX_50E92D3785856D84 (type_link_id), INDEX IDX_50E92D37AC60418A (video_size_id), PRIMARY KEY(type_link_id, video_size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_size (id INT AUTO_INCREMENT NOT NULL, duration VARCHAR(255) NOT NULL, width DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D85856D84 FOREIGN KEY (type_link_id) REFERENCES type_link (id)');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DC7D324F9 FOREIGN KEY (link_provider_id) REFERENCES link_provider (id)');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DDC9DFFFB FOREIGN KEY (image_size_id) REFERENCES image_size (id)');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DAC60418A FOREIGN KEY (video_size_id) REFERENCES video_size (id)');
        $this->addSql('ALTER TABLE type_link_link_provider ADD CONSTRAINT FK_4D97649985856D84 FOREIGN KEY (type_link_id) REFERENCES type_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_link_link_provider ADD CONSTRAINT FK_4D976499C7D324F9 FOREIGN KEY (link_provider_id) REFERENCES link_provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_link_image_size ADD CONSTRAINT FK_A5449A7585856D84 FOREIGN KEY (type_link_id) REFERENCES type_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_link_image_size ADD CONSTRAINT FK_A5449A75DC9DFFFB FOREIGN KEY (image_size_id) REFERENCES image_size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_link_video_size ADD CONSTRAINT FK_50E92D3785856D84 FOREIGN KEY (type_link_id) REFERENCES type_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_link_video_size ADD CONSTRAINT FK_50E92D37AC60418A FOREIGN KEY (video_size_id) REFERENCES video_size (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DDC9DFFFB');
        $this->addSql('ALTER TABLE type_link_image_size DROP FOREIGN KEY FK_A5449A75DC9DFFFB');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DC7D324F9');
        $this->addSql('ALTER TABLE type_link_link_provider DROP FOREIGN KEY FK_4D976499C7D324F9');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D85856D84');
        $this->addSql('ALTER TABLE type_link_link_provider DROP FOREIGN KEY FK_4D97649985856D84');
        $this->addSql('ALTER TABLE type_link_image_size DROP FOREIGN KEY FK_A5449A7585856D84');
        $this->addSql('ALTER TABLE type_link_video_size DROP FOREIGN KEY FK_50E92D3785856D84');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DAC60418A');
        $this->addSql('ALTER TABLE type_link_video_size DROP FOREIGN KEY FK_50E92D37AC60418A');
        $this->addSql('DROP TABLE bookmark');
        $this->addSql('DROP TABLE image_size');
        $this->addSql('DROP TABLE link_provider');
        $this->addSql('DROP TABLE type_link');
        $this->addSql('DROP TABLE type_link_link_provider');
        $this->addSql('DROP TABLE type_link_image_size');
        $this->addSql('DROP TABLE type_link_video_size');
        $this->addSql('DROP TABLE video_size');
    }
}
