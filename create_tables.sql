use jadrn000;

drop table if exists enrollment;
drop table if exists program;
drop table if exists child;
drop table if exists parent;


create table parent(
    id int AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(25) NOT NULL,
    middle_name varchar(25),
    last_name varchar(25) NOT NULL,
    address1 varchar(50) NOT NULL,
    address2 varchar(50),
    city varchar(20) NOT NULL,
    state char(2) NOT NULL,
    zip varchar(10) NOT NULL,
    primary_phone char(14) NOT NULL,
    secondary_phone char(14),
    email varchar(50) NOT NULL);    

create table child(
    id int AUTO_INCREMENT PRIMARY KEY,
    parent_id int,
    relation varchar(25) NOT NULL,
    first_name varchar(25) NOT NULL,
    middle_name varchar(25),
    last_name varchar(25) NOT NULL,
    nickname varchar(25),
    image_filename varchar(15) NOT NULL,    
    gender char(1) NOT NULL,
    birthdate date NOT NULL,
    conditions varchar(255),
    diet varchar(255),
    emergency_name varchar(50) NOT NULL,
    emergency_phone char(14) NOT NULL,
    FOREIGN KEY(parent_id) references parent(id));
    
create table program(
    id int PRIMARY KEY,
    description varchar(50) NOT NULL );    
    
create table enrollment(
    program_id int NOT NULL,
    child_id int NOT NULL,
    FOREIGN KEY(program_id) references program(id),
    FOREIGN KEY(child_id) references child(id));    