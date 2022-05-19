create database tribunal;

create table  type_inculpation(
    id_inculpation int Auto_increment primary key,
    inculpation char(60)
)ENGINE=InnoDB DEFAULT charset=utf8mb4;

create table dossierinculpe(
    id_inculpe int Auto_increment primary key,
    nom char(60),
    adresse char(60),
    date_reception date,
    id_inculpation int,
    decision char(60)
    ,constraint fk_inculpe foreign key (id_inculpation)
    references type_inculpation(id_inculpation)
)ENGINE=InnoDB DEFAULT charset=utf8mb4;


/*
create table dossierinculpe(
    id_inculpe int Auto_increment primary key,
    nom char(60),
    adresse char(60),
    date_reception date,
    inculpation char(60),
    decision char(60)
   )ENGINE=InnoDB DEFAULT charset=utf8mb4;
*/

