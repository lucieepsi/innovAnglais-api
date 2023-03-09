<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309093606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_words_word ADD CONSTRAINT FK_EA24BF5DAF6269B FOREIGN KEY (list_words_id) REFERENCES ListsWords (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_words_word ADD CONSTRAINT FK_EA24BF5DE357438D FOREIGN KEY (word_id) REFERENCES Words (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_list_words ADD CONSTRAINT FK_D3DD3CB61E5D0459 FOREIGN KEY (test_id) REFERENCES Tests (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_list_words ADD CONSTRAINT FK_D3DD3CB6AF6269B FOREIGN KEY (list_words_id) REFERENCES ListsWords (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category ADD CONSTRAINT FK_22F2C810E357438D FOREIGN KEY (word_id) REFERENCES Words (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category ADD CONSTRAINT FK_22F2C81012469DE2 FOREIGN KEY (category_id) REFERENCES Categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_words_word DROP FOREIGN KEY FK_EA24BF5DAF6269B');
        $this->addSql('ALTER TABLE list_words_word DROP FOREIGN KEY FK_EA24BF5DE357438D');
        $this->addSql('ALTER TABLE test_list_words DROP FOREIGN KEY FK_D3DD3CB61E5D0459');
        $this->addSql('ALTER TABLE test_list_words DROP FOREIGN KEY FK_D3DD3CB6AF6269B');
        $this->addSql('ALTER TABLE word_category DROP FOREIGN KEY FK_22F2C810E357438D');
        $this->addSql('ALTER TABLE word_category DROP FOREIGN KEY FK_22F2C81012469DE2');
    }
}
