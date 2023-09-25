create database CRUD ;

create table account (
username varchar(50) primary key ,
password varchar(50) not null,
email varchar(100) not null,
created_date date default (current_date())
);