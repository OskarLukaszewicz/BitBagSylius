<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260922071610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Dodanie kolumny notatki administratorskiej dla zamówień';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sylius_order ADD admin_note VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sylius_order DROP admin_note');
    }
}
