<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023163055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE image ALTER name DROP NOT NULL');
        $this->addSql('ALTER TABLE image ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE image ALTER date_created TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN image.date_created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE users ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E93DA5256D ON users (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E93DA5256D');
        $this->addSql('DROP INDEX UNIQ_1483A5E93DA5256D');
        $this->addSql('ALTER TABLE users DROP image_id');
        $this->addSql('ALTER TABLE image ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE image ALTER name SET NOT NULL');
        $this->addSql('ALTER TABLE image ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE image ALTER date_created TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN image.date_created IS NULL');
    }
}
