<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180605083104 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories_articles (category_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_6923985112469DE2 (category_id), INDEX IDX_692398517294869C (article_id), PRIMARY KEY(category_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_articles (user_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_C49C1AB2A76ED395 (user_id), INDEX IDX_C49C1AB27294869C (article_id), PRIMARY KEY(user_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_articles ADD CONSTRAINT FK_6923985112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_articles ADD CONSTRAINT FK_692398517294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_articles ADD CONSTRAINT FK_C49C1AB2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_articles ADD CONSTRAINT FK_C49C1AB27294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_23A0E662B36786B ON article');
        $this->addSql('ALTER TABLE article ADD image VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD user_id INT DEFAULT NULL, CHANGE updatedat updateAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1A76ED395 ON category (user_id)');
        $this->addSql('ALTER TABLE user CHANGE lastName lastName VARCHAR(50) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE categories_articles');
        $this->addSql('DROP TABLE users_articles');
        $this->addSql('ALTER TABLE article DROP image');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E662B36786B ON article (title)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A76ED395');
        $this->addSql('DROP INDEX IDX_64C19C1A76ED395 ON category');
        $this->addSql('ALTER TABLE category DROP user_id, CHANGE updateat updatedAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE lastName lastName VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci');
    }
}
