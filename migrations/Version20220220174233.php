<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220174233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit ALTER libelle TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE produit ALTER libelle DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE produit DROP prix');
        $this->addSql('ALTER TABLE produit ALTER libelle TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE produit ALTER libelle DROP DEFAULT');
        $this->addSql('ALTER TABLE produit ALTER libelle TYPE DOUBLE PRECISION');
    }
}
