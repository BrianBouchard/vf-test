CREATE DATABASE vf_test; 
USE vf_test; 

CREATE USER 'vf_test_dbconn'@'localhost' IDENTIFIED BY 'v8qcrWPk';
GRANT ALL PRIVILEGES ON vf_test.* TO 'vf_test_dbconn'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE `vf_widgets` (     
     `ID` INT NOT NULL AUTO_INCREMENT,
     `Name` VARCHAR(20) NOT NULL,
     `Description` VARCHAR(100),
     PRIMARY KEY (`ID`) ) ENGINE=InnoDB
;

INSERT INTO vf_widgets (Name, Description) VALUES ('Main Widget', 'This is the main widget');
INSERT INTO vf_widgets (Name, Description) VALUES ('Secondary Widget', 'This is the secondary widget');
