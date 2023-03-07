<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306113222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Companies (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, INDEX IDX_B5289967B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Modules (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Subscriptions (id INT AUTO_INCREMENT NOT NULL, date_begin DATE DEFAULT NULL, date_end DATE DEFAULT NULL, paid_amount DOUBLE PRECISION DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Users (id INT AUTO_INCREMENT NOT NULL, subscriptions_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D5428AEDE7927C74 (email), INDEX IDX_D5428AED688E3B5D (subscriptions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_module (user_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_69763D15A76ED395 (user_id), INDEX IDX_69763D15AFC2B591 (module_id), PRIMARY KEY(user_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B5289967B3B43D FOREIGN KEY (users_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED688E3B5D FOREIGN KEY (subscriptions_id) REFERENCES Subscriptions (id)');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15AFC2B591 FOREIGN KEY (module_id) REFERENCES Modules (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289967B3B43D');
        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY FK_D5428AED688E3B5D');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15A76ED395');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15AFC2B591');
        $this->addSql('DROP TABLE Companies');
        $this->addSql('DROP TABLE Modules');
        $this->addSql('DROP TABLE Subscriptions');
        $this->addSql('DROP TABLE Users');
        $this->addSql('DROP TABLE user_module');
    }
}
