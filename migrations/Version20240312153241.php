<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312153241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidats (id INT AUTO_INCREMENT NOT NULL, gender_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, passeport_id INT DEFAULT NULL, cv_id INT DEFAULT NULL, user_id INT DEFAULT NULL, experience_id INT DEFAULT NULL, category_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, birth_place VARCHAR(255) NOT NULL, current_location VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_3C663B15708A0E0 (gender_id), UNIQUE INDEX UNIQ_3C663B157E9E4C8C (photo_id), UNIQUE INDEX UNIQ_3C663B15691B94D5 (passeport_id), UNIQUE INDEX UNIQ_3C663B15CFE419E2 (cv_id), UNIQUE INDEX UNIQ_3C663B15A76ED395 (user_id), INDEX IDX_3C663B1546E90E27 (experience_id), INDEX IDX_3C663B1512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidatures (id INT AUTO_INCREMENT NOT NULL, job_offer_id INT DEFAULT NULL, candidats_id INT DEFAULT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_DE57CF663481D195 (job_offer_id), INDEX IDX_DE57CF66E4CF8FC2 (candidats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name_societe VARCHAR(255) NOT NULL, name_contact VARCHAR(255) NOT NULL, email_contact VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', telephone_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_type (id INT AUTO_INCREMENT NOT NULL, contract VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, experience VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, contract_type_id INT DEFAULT NULL, category_id INT DEFAULT NULL, company_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', position VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, salary INT NOT NULL, ref VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, closed_at VARCHAR(255) NOT NULL, INDEX IDX_288A3A4ECD1DF15B (contract_type_id), INDEX IDX_288A3A4E12469DE2 (category_id), INDEX IDX_288A3A4E979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B157E9E4C8C FOREIGN KEY (photo_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15691B94D5 FOREIGN KEY (passeport_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15CFE419E2 FOREIGN KEY (cv_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B1546E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B1512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF663481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF66E4CF8FC2 FOREIGN KEY (candidats_id) REFERENCES candidats (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4ECD1DF15B FOREIGN KEY (contract_type_id) REFERENCES contract_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15708A0E0');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B157E9E4C8C');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15691B94D5');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15CFE419E2');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15A76ED395');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B1546E90E27');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B1512469DE2');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF663481D195');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF66E4CF8FC2');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4ECD1DF15B');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E12469DE2');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E979B1AD6');
        $this->addSql('DROP TABLE candidats');
        $this->addSql('DROP TABLE candidatures');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE contract_type');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE `user`');
    }
}
