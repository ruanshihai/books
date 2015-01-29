DROP DATABASE IF EXISTS books;
CREATE DATABASE books;
USE books;

CREATE TABLE book_info (
	BookID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(64),
	Author VARCHAR(64),
	Pubdate VARCHAR(64),
	Subject VARCHAR(64),
	Publisher VARCHAR(64),
	Price INT,
	AddOn VARCHAR(128),
	PRIMARY KEY(BookID)
) CHARSET=UTF8 AUTO_INCREMENT=1;

CREATE TABLE managers (
	username VARCHAR(64),
	password VARCHAR(128),
	PRIMARY KEY(username)
) CHARSET=UTF8;