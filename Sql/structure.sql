CREATE TABLE car (
    id INT AUTO_INCREMENT NOT NULL, 
    car_id VARCHAR(255) NOT NULL, 
    number_plate VARCHAR(255) NOT NULL, 
    release_date DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
;


CREATE TABLE picture (
    id INT AUTO_INCREMENT NOT NULL, 
    car_id INT DEFAULT NULL, 
    thumbnail VARCHAR(255) NOT NULL,
    INDEX IDX_16DB4F89C3C6F69F (car_id), 
    PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
 BIGIN;

ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id);