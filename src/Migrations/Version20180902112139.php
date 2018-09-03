<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902112139 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE list_products (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, INDEX IDX_CDD7693A105CFD56 (produto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE list_products ADD CONSTRAINT FK_CDD7693A105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE lista ADD produto_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDCDBF150D FOREIGN KEY (produto_id_id) REFERENCES list_products (id)');
        $this->addSql('CREATE INDEX IDX_FB9FEEEDCDBF150D ON lista (produto_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lista DROP FOREIGN KEY FK_FB9FEEEDCDBF150D');
        $this->addSql('DROP TABLE list_products');
        $this->addSql('DROP INDEX IDX_FB9FEEEDCDBF150D ON lista');
        $this->addSql('ALTER TABLE lista DROP produto_id_id');
    }
}
