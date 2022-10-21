<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021181116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bloomjoyer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE page_content_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE page_content_update_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bloomjoyer (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F60880E7927C74 ON bloomjoyer (email)');
        $this->addSql('CREATE TABLE page_content (id INT NOT NULL, author INT DEFAULT NULL, html_content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A5DB3CBDAFD8C8 ON page_content (author)');
        $this->addSql('CREATE TABLE page_content_update (id INT NOT NULL, page_content_id INT DEFAULT NULL, author INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_418976808F409273 ON page_content_update (page_content_id)');
        $this->addSql('CREATE INDEX IDX_41897680BDAFD8C8 ON page_content_update (author)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE page_content ADD CONSTRAINT FK_4A5DB3CBDAFD8C8 FOREIGN KEY (author) REFERENCES bloomjoyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_content_update ADD CONSTRAINT FK_418976808F409273 FOREIGN KEY (page_content_id) REFERENCES page_content (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_content_update ADD CONSTRAINT FK_41897680BDAFD8C8 FOREIGN KEY (author) REFERENCES bloomjoyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bloomjoyer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE page_content_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE page_content_update_id_seq CASCADE');
        $this->addSql('ALTER TABLE page_content DROP CONSTRAINT FK_4A5DB3CBDAFD8C8');
        $this->addSql('ALTER TABLE page_content_update DROP CONSTRAINT FK_418976808F409273');
        $this->addSql('ALTER TABLE page_content_update DROP CONSTRAINT FK_41897680BDAFD8C8');
        $this->addSql('DROP TABLE bloomjoyer');
        $this->addSql('DROP TABLE page_content');
        $this->addSql('DROP TABLE page_content_update');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
