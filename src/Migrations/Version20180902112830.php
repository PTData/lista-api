<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902112830 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE list_products ADD lista_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_products ADD CONSTRAINT FK_CDD7693A6736D68F FOREIGN KEY (lista_id) REFERENCES lista (id)');
        $this->addSql('CREATE INDEX IDX_CDD7693A6736D68F ON list_products (lista_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE list_products DROP FOREIGN KEY FK_CDD7693A6736D68F');
        $this->addSql('DROP INDEX IDX_CDD7693A6736D68F ON list_products');
        $this->addSql('ALTER TABLE list_products DROP lista_id');
    }
}
