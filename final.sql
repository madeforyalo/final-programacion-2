create database final;
use final;

create table roles(
rol_id tinyint primary key,
rol_desc varchar(13));

insert into roles values (1, "SuperAdmin"), (2, "Admin"), (3, "Profesor");

create table carreras(
car_id tinyint primary key,
car_desc varchar (50));

insert into carreras value (1, "Tecnicarura en analisis de sistemas"),
(2, "Profesorado de matematicas"), (3, "Profesorado de ingles");


create table materias(
mat_id tinyint primary key,
mat_nom varchar (50),
car_id tinyint,
foreign key(car_id) references carreras(car_id));

SELECT mat_id, mat_nom FROM materias WHERE car_id = '1' ORDER BY mat_nom ASC;

insert into materias values (1, "Ingles I", 1), 
(2, "Ciencia Tecnologia y sociedad", 1),
(3, "Analisis matematico I", 1),
(4, "Algebra", 1),
(5, "Algoritmos y estructura de datos I", 1),
(6, "Sistemas y Organizaciones", 1),
(7, "Arquitectura de computadores", 1),
(8, "Practicas profesionalizantes I", 1),
(9, "Ingles II", 1),
(10, "Analisis matematico II", 1),
(11, "Estadistica", 1),
(12, "Ingenieria de sofware I", 1),
(13, "Algoritmos y estructura de datos II", 1),
(14, "Sistemas operativos", 1),
(15, "Base de datos", 1),
(16, "Practicas profesionalizantes II", 1),
(17, "Ingles III", 1),
(18, "Aspectos legales de la profesión", 1),
(19, "Seminario de actualización", 1),
(20, "Redes y comunicaciones", 1),
(21, "Ingenieria de sofware II", 1),
(22, "Algoritmos y estructura de datos III", 1),
(23, "Practicas profesionalizantes III", 1);
#inner join (materias) on materias.car_id = carreras.car_id;

create table alumnos(
alu_id int auto_increment primary key,
alu_nom varchar(50),
alu_ape varchar(50)
#alu_dni int(9),
#alu_dir varchar(50),
#alu_fecha date,
#alu_tel int(15)
);
create table aluxcar(
aluxcar_id int auto_increment primary key,
alu_id int,
car_id tinyint,
foreign key(car_id) references carreras(car_id),
foreign key(alu_id) references alumnos(alu_id));

create table aluxmat(
aluxmat_id int auto_increment primary key,
alu_id int,
mat_id tinyint,
foreign key(mat_id) references materias(mat_id),
foreign key(alu_id) references alumnos(alu_id));

drop table notas;
create table notas(
nota_id tinyint primary key auto_increment,
nota_1 int (3),
nota_2 int (3),
nota_final int (3),
aluxmat_id int,
foreign key(aluxmat_id) references aluxmat(aluxmat_id));

UPDATE notas SET nota_1=7, nota_2=8, nota_final=4
            WHERE aluxmat_id = 4;
select * from aluxmat;
insert into notas values (null, 5, 6, null, 4);
insert into notas (nota_1, nota_2) values (7, 7);
#create table notxaluxmat (
#notxaluxmat tinyint auto_increment primary key,
#nota_id tinyint,
#alu_id int,
#mat_id tinyint,
#foreign key(mat_id) references materias(mat_id),
#foreign key(alu_id) references alumnos(alu_id),
#foreign key(nota_id) references notas(nota_id));

SELECT alu_nom, alu_ape, nota_1, nota_2 from notas 
    inner join alumnos on notas.alu_id = alumnos.alu_id
    inner join materias on notas.mat_id = materias.mat_id
    #inner join notas on notxaluxmat.nota_id = notas.nota_id
    WHERE materias.mat_id = 1;


create table usuarios(
usu_id int primary key auto_increment,
usu_nombre varchar (20),
usu_apellido varchar(20),
usu_usuario varchar (20),
usu_contra varchar (20),
rol_id tinyint,
foreign key(rol_id) references roles(rol_id));

create table profesores(
prof_id int auto_increment primary key,
prof_nom varchar(50),
prof_ape varchar(50),
prof_dni int(10));

create table profxcarr (
pxc_id int auto_increment primary key,
prof_id int,
car_id tinyint,
foreign key(prof_id) references profesores(prof_id),
foreign key(car_id) references carreras(car_id));

insert into alumnos values (null,"Gonzalo", "Rojas"),
(null, "Fernando", "torres"),
(null, "Luis", "Sbarbati"),
(null, "Rodrigo", "Bombillar"),
(null, "Dana", "More");

insert into aluxmat values 
(null, 1, 1), (null, 1, 2),(null, 1, 3), (null, 1, 4),
(null, 2, 1), (null, 2, 2),(null, 2, 3), (null, 2, 4),
(null, 3, 1), (null, 3, 3),(null, 3, 5), (null, 3, 7),
(null, 4, 2), (null, 4, 4),(null, 4, 6), (null, 4, 8),
(null, 5, 4), (null, 5, 5),(null, 5, 6), (null, 5, 7);

select alumnos.alu_nom, materias.mat_nom from aluxmat 
inner join alumnos on aluxmat.alu_id = alumnos.alu_id
inner join materias on aluxmat.mat_id = materias.mat_id;

SELECT alu_nom, alu_ape from aluxmat 
inner join alumnos on aluxmat.alu_id = alumnos.alu_id
WHERE mat_id = 1;

SELECT notas.aluxmat_id, alumnos.alu_id, alumnos.alu_nom, alumnos.alu_ape, notas.nota_1, notas.nota_2, notas.nota_final
    FROM notas
    INNER JOIN aluxmat ON notas.aluxmat_id = aluxmat.aluxmat_id
    INNER JOIN alumnos ON aluxmat.alu_id = alumnos.alu_id
    WHERE aluxmat.mat_id = 4;