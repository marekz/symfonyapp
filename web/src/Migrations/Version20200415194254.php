<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415194254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle ADD model_id INT NOT NULL, ADD producer_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48689B658FE FOREIGN KEY (producer_id) REFERENCES vehicle_producer (id)');
        $this->addSql('CREATE INDEX IDX_1B80E4867975B7E7 ON vehicle (model_id)');
        $this->addSql('CREATE INDEX IDX_1B80E48689B658FE ON vehicle (producer_id)');
        $this->addSql('ALTER TABLE vehicle_model ADD producer_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF23589B658FE FOREIGN KEY (producer_id) REFERENCES vehicle_producer (id)');
        $this->addSql('CREATE INDEX IDX_B53AF23589B658FE ON vehicle_model (producer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48689B658FE');
        $this->addSql('DROP INDEX IDX_1B80E4867975B7E7 ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E48689B658FE ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP model_id, DROP producer_id');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF23589B658FE');
        $this->addSql('DROP INDEX IDX_B53AF23589B658FE ON vehicle_model');
        $this->addSql('ALTER TABLE vehicle_model DROP producer_id');
    }
}
