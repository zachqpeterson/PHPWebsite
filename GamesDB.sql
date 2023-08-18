DROP DATABASE IF EXISTS GamesDB;
CREATE DATABASE GamesDB;
use GamesDB;

CREATE TABLE SubPages(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    parentPage INT NULL,
    image varchar(225) NULL,
    title VARCHAR(100),
    header VARCHAR(100),
    content VARCHAR(1000),
    isActive BOOL
);

INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(NULL, "Genres", NULL, "All Genres", "Select a genre to view games of that genre", true);
INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(1, "RPG", NULL, "RPG Games", "These are games of the RPG variety", true);
INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(1, "Survival", NULL, "Survival Games", "These are games of the survival variety", true);

INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(2, "Baldur's Gate III", "Images\\BaldursGateIII.png", "Baldur's Gate III", "Baldur's Gate III is the hottest game of the year", true);
INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(2, "Baldur's Gate II", "Images\\BaldursGateII.png","Baldur's Gate II", "Baldur's Gate II is the hottest game of the year 2000", true);
INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(2, "Baldur's Gate", "Images\\BaldursGate.png", "Baldur's Gate", "Baldur's Gate is the hottest game forever ago", false);

INSERT INTO SubPages (parentPage, title, image, header, content, isActive) VALUES(3, "Minecraft", "Images\\Minecraft.png", "Minecraft", "Minecraft is very overrated, but modded is cool I guess", true);

CREATE TABLE Users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    password VARCHAR(20),
    theme INT,
    admin BOOL
);

INSERT INTO Users (username, password, theme, admin) VALUES("ADMIN_USER", "ADMIN_PASSWORD", 1, true);