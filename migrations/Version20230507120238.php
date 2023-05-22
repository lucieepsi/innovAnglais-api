<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230507120238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Attempts (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, test_id INT NOT NULL, date_attempt DATETIME NOT NULL, score DOUBLE PRECISION NOT NULL, num_question INT NOT NULL, INDEX IDX_46B18532A76ED395 (user_id), INDEX IDX_46B185321E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Categories (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Companies (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, INDEX IDX_B5289967B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ListsWords (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_561C631659027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_words_word (list_words_id INT NOT NULL, word_id INT NOT NULL, INDEX IDX_EA24BF5DAF6269B (list_words_id), INDEX IDX_EA24BF5DE357438D (word_id), PRIMARY KEY(list_words_id, word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Modules (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Subscriptions (id INT AUTO_INCREMENT NOT NULL, date_begin DATE DEFAULT NULL, date_end DATE DEFAULT NULL, paid_amount DOUBLE PRECISION DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Tests (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, label VARCHAR(255) NOT NULL, level DOUBLE PRECISION NOT NULL, INDEX IDX_D3A1D35AAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_list_words (test_id INT NOT NULL, list_words_id INT NOT NULL, INDEX IDX_D3DD3CB61E5D0459 (test_id), INDEX IDX_D3DD3CB6AF6269B (list_words_id), PRIMARY KEY(test_id, list_words_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Themes (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Users (id INT AUTO_INCREMENT NOT NULL, subscriptions_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D5428AEDE7927C74 (email), INDEX IDX_D5428AED688E3B5D (subscriptions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_module (user_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_69763D15A76ED395 (user_id), INDEX IDX_69763D15AFC2B591 (module_id), PRIMARY KEY(user_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Words (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, translation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_category (word_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_22F2C810E357438D (word_id), INDEX IDX_22F2C81012469DE2 (category_id), PRIMARY KEY(word_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Attempts ADD CONSTRAINT FK_46B18532A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE Attempts ADD CONSTRAINT FK_46B185321E5D0459 FOREIGN KEY (test_id) REFERENCES Tests (id)');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B5289967B3B43D FOREIGN KEY (users_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE ListsWords ADD CONSTRAINT FK_561C631659027487 FOREIGN KEY (theme_id) REFERENCES Themes (id)');
        $this->addSql('ALTER TABLE list_words_word ADD CONSTRAINT FK_EA24BF5DAF6269B FOREIGN KEY (list_words_id) REFERENCES ListsWords (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_words_word ADD CONSTRAINT FK_EA24BF5DE357438D FOREIGN KEY (word_id) REFERENCES Words (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Tests ADD CONSTRAINT FK_D3A1D35AAFC2B591 FOREIGN KEY (module_id) REFERENCES Modules (id)');
        $this->addSql('ALTER TABLE test_list_words ADD CONSTRAINT FK_D3DD3CB61E5D0459 FOREIGN KEY (test_id) REFERENCES Tests (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_list_words ADD CONSTRAINT FK_D3DD3CB6AF6269B FOREIGN KEY (list_words_id) REFERENCES ListsWords (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED688E3B5D FOREIGN KEY (subscriptions_id) REFERENCES Subscriptions (id)');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15AFC2B591 FOREIGN KEY (module_id) REFERENCES Modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category ADD CONSTRAINT FK_22F2C810E357438D FOREIGN KEY (word_id) REFERENCES Words (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category ADD CONSTRAINT FK_22F2C81012469DE2 FOREIGN KEY (category_id) REFERENCES Categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Attempts DROP FOREIGN KEY FK_46B18532A76ED395');
        $this->addSql('ALTER TABLE Attempts DROP FOREIGN KEY FK_46B185321E5D0459');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289967B3B43D');
        $this->addSql('ALTER TABLE ListsWords DROP FOREIGN KEY FK_561C631659027487');
        $this->addSql('ALTER TABLE list_words_word DROP FOREIGN KEY FK_EA24BF5DAF6269B');
        $this->addSql('ALTER TABLE list_words_word DROP FOREIGN KEY FK_EA24BF5DE357438D');
        $this->addSql('ALTER TABLE Tests DROP FOREIGN KEY FK_D3A1D35AAFC2B591');
        $this->addSql('ALTER TABLE test_list_words DROP FOREIGN KEY FK_D3DD3CB61E5D0459');
        $this->addSql('ALTER TABLE test_list_words DROP FOREIGN KEY FK_D3DD3CB6AF6269B');
        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY FK_D5428AED688E3B5D');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15A76ED395');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15AFC2B591');
        $this->addSql('ALTER TABLE word_category DROP FOREIGN KEY FK_22F2C810E357438D');
        $this->addSql('ALTER TABLE word_category DROP FOREIGN KEY FK_22F2C81012469DE2');
        $this->addSql('DROP TABLE Attempts');
        $this->addSql('DROP TABLE Categories');
        $this->addSql('DROP TABLE Companies');
        $this->addSql('DROP TABLE ListsWords');
        $this->addSql('DROP TABLE list_words_word');
        $this->addSql('DROP TABLE Modules');
        $this->addSql('DROP TABLE Subscriptions');
        $this->addSql('DROP TABLE Tests');
        $this->addSql('DROP TABLE test_list_words');
        $this->addSql('DROP TABLE Themes');
        $this->addSql('DROP TABLE Users');
        $this->addSql('DROP TABLE user_module');
        $this->addSql('DROP TABLE Words');
        $this->addSql('DROP TABLE word_category');
    }
}
