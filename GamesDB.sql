DROP DATABASE IF EXISTS GamesDB;
CREATE DATABASE GamesDB;
use GamesDB;

CREATE TABLE SubPage(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    parentPage INT NULL,
    title VARCHAR(100),
    header VARCHAR(100),
    content VARCHAR(1000),
    isActive BOOL
);

INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(NULL, "Genres", "All Genres", "Select a genre to view games of that genre", true);
INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(1, "RPG", "RPG Games", "These are games of the RPG variety", true);
INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(1, "Survival", "Survival Games", "These are games of the survival variety", true);

INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(2, "Baldur's Gate III", "Baldur's Gate III", "Baldur's Gate III is the hottest game of the year", true);
INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(2, "Baldur's Gate II", "Baldur's Gate II", "Baldur's Gate II is the hottest game of the year 2000", true);
INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(2, "Baldur's Gate", "Baldur's Gate", "Baldur's Gate is the hottest game forever ago", false);

INSERT INTO SubPage (parentPage, title, header, content, isActive) VALUES(3, "Minecraft", "Minecraft", "Minecraft is very overrated, but modded is cool I guess", true);