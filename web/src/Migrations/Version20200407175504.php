<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200407175504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users_vehicles DROP FOREIGN KEY FK_648F4220545317D1');
        $this->addSql('ALTER TABLE users_vehicles DROP FOREIGN KEY FK_648F4220A76ED395');
        $this->addSql('ALTER TABLE users_vehicles ADD CONSTRAINT FK_648F4220545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE users_vehicles ADD CONSTRAINT FK_648F4220A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP last_name');
        $this->addSql('ALTER TABLE users_vehicles DROP FOREIGN KEY FK_648F4220A76ED395');
        $this->addSql('ALTER TABLE users_vehicles DROP FOREIGN KEY FK_648F4220545317D1');
        $this->addSql('ALTER TABLE users_vehicles ADD CONSTRAINT FK_648F4220A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_vehicles ADD CONSTRAINT FK_648F4220545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
