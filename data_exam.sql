create database students ;

create table student (
id int auto_increment primary key ,
name varchar(40) not null,
email varchar(40) not null ,
phone varchar(10) not null,
dob date not null
);

insert into student (name,email,phone,dob)
value ("Nguyen van A","NguyenvanA@gmail.com","0367508795","1994/08/23"),
("Nguyen van B","NguyenvanB@gmail.com","0367508796","1995/09/24"),
("Nguyen van C","NguyenvanC@gmail.com","0367508797","1996/10/25"),
("Nguyen van D","NguyenvanD@gmail.com","0367508798","1997/11/26"),
("Nguyen van E","NguyenvanE@gmail.com","0367508799","1998/12/27");

select * from student ;
