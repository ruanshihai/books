drop database if exists books;
create database books;
use books;
create table book_info (
	BookID int not null auto_increment,
	Name varchar(64),
	Author varchar(64),
	Pubdate varchar(64),
	Subject varchar(64),
	Publisher varchar(64),
	Price int,
	AddOn varchar(128),
	primary key(BookID)
) charset=utf8 auto_increment=1;

create table managers (
	username varchar(64),
	password varchar(128),
	primary key(username)
) charset=utf8;