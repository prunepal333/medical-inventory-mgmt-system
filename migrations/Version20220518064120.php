<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518064120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer_medicines');
        $this->addSql('DROP TABLE sales');
        $this->addSql('ALTER TABLE customer ADD id INT AUTO_INCREMENT NOT NULL, DROP c_id, CHANGE address address VARCHAR(50) NOT NULL, CHANGE username username VARCHAR(16) NOT NULL, CHANGE password password VARCHAR(156) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE employee ADD id INT AUTO_INCREMENT NOT NULL, DROP e_id, CHANGE dob dob DATE NOT NULL, CHANGE password password VARCHAR(16) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX med_id ON medicine');
        $this->addSql('ALTER TABLE medicine ADD id INT AUTO_INCREMENT NOT NULL, CHANGE expiry_date expiry_date DATE NOT NULL, CHANGE med_id dosage_mg INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_medicines (c_id INT NOT NULL, med_id INT NOT NULL, INDEX FK_CustomerMedicinesCustomer (c_id), INDEX FK_CustomerMedicinesMedicine (med_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sales (c_id INT NOT NULL, med_id INT NOT NULL, issuer_id INT NOT NULL, quantity INT NOT NULL, recorded_at DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX c_id (c_id), INDEX issuer_id (issuer_id), INDEX med_id (med_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE customer_medicines ADD CONSTRAINT FK_CustomerMedicinesCustomer FOREIGN KEY (c_id) REFERENCES customer (c_id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_medicines ADD CONSTRAINT FK_CustomerMedicinesMedicine FOREIGN KEY (med_id) REFERENCES medicine (med_id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT sales_ibfk_1 FOREIGN KEY (c_id) REFERENCES customer (c_id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT sales_ibfk_2 FOREIGN KEY (med_id) REFERENCES medicine (med_id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT sales_ibfk_3 FOREIGN KEY (issuer_id) REFERENCES employee (e_id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE customer MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE customer DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE customer ADD c_id INT NOT NULL, DROP id, CHANGE address address VARCHAR(50) DEFAULT NULL, CHANGE username username VARCHAR(16) DEFAULT NULL, CHANGE password password VARCHAR(16) DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD PRIMARY KEY (c_id)');
        $this->addSql('ALTER TABLE employee MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE employee DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE employee ADD e_id INT NOT NULL, DROP id, CHANGE dob dob DATETIME NOT NULL, CHANGE password password VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE employee ADD PRIMARY KEY (e_id)');
        $this->addSql('ALTER TABLE medicine MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE medicine DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE medicine DROP id, CHANGE expiry_date expiry_date DATETIME NOT NULL, CHANGE dosage_mg med_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX med_id ON medicine (med_id)');
        $this->addSql('ALTER TABLE medicine ADD PRIMARY KEY (med_id)');
    }
}
