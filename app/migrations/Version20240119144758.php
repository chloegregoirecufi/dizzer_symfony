<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119144758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, image_path VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, age DATE NOT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_album (artiste_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_4DB174BD21D25844 (artiste_id), INDEX IDX_4DB174BD1137ABCF (album_id), PRIMARY KEY(artiste_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_music (categories_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_C9513707A21214B7 (categories_id), INDEX IDX_C9513707399BBB13 (music_id), PRIMARY KEY(categories_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, song VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_album (music_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_5E11158B399BBB13 (music_id), INDEX IDX_5E11158B1137ABCF (album_id), PRIMARY KEY(music_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_artiste (music_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_58F3A734399BBB13 (music_id), INDEX IDX_58F3A73421D25844 (artiste_id), PRIMARY KEY(music_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, fistname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, age DATE NOT NULL, city VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_music (user_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_2F90D912A76ED395 (user_id), INDEX IDX_2F90D912399BBB13 (music_id), PRIMARY KEY(user_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_music ADD CONSTRAINT FK_C9513707A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_music ADD CONSTRAINT FK_C9513707399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_album ADD CONSTRAINT FK_5E11158B399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_album ADD CONSTRAINT FK_5E11158B1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_artiste ADD CONSTRAINT FK_58F3A734399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_artiste ADD CONSTRAINT FK_58F3A73421D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_music ADD CONSTRAINT FK_2F90D912A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_music ADD CONSTRAINT FK_2F90D912399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD21D25844');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD1137ABCF');
        $this->addSql('ALTER TABLE categories_music DROP FOREIGN KEY FK_C9513707A21214B7');
        $this->addSql('ALTER TABLE categories_music DROP FOREIGN KEY FK_C9513707399BBB13');
        $this->addSql('ALTER TABLE music_album DROP FOREIGN KEY FK_5E11158B399BBB13');
        $this->addSql('ALTER TABLE music_album DROP FOREIGN KEY FK_5E11158B1137ABCF');
        $this->addSql('ALTER TABLE music_artiste DROP FOREIGN KEY FK_58F3A734399BBB13');
        $this->addSql('ALTER TABLE music_artiste DROP FOREIGN KEY FK_58F3A73421D25844');
        $this->addSql('ALTER TABLE user_music DROP FOREIGN KEY FK_2F90D912A76ED395');
        $this->addSql('ALTER TABLE user_music DROP FOREIGN KEY FK_2F90D912399BBB13');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE artiste_album');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_music');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_album');
        $this->addSql('DROP TABLE music_artiste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_music');
    }
}
