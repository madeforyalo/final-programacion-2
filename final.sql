create database final;
use final;

drop table roles;
create table roles(
rol_id tinyint primary key,
rol_desc varchar(13));

insert into roles values (1, "Admin"), (2, "Directivo"), (3, "Profesor"), (4, "Alumno");

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


select * from alumnos;
drop table alumnos;

create table alumnos(
alu_id int auto_increment primary key,
alu_nom varchar(50),
alu_ape varchar(50),
usu_usuario varchar (20) UNIQUE,
rol_id tinyint,
foreign key (usu_usuario) references usuarios(usu_usuario),
foreign key (rol_id) references roles(rol_id));

insert into alumnos values (null,"Sofia", "peralta", "speralta", 4),
(null, "Fernando", "torres", "ftorres", 4),
(null, "Alen", "Ozcariz", "aozcariz", 4),
(null, "Celeste", "Diaz", "cdiaz", 4),
(null, "Dana", "More", "dmore", 4);


delete from aluxmat where alu_id=1;
select*from aluxmat;
INSERT INTO aluxmat VALUE (null, 1, 2);
drop table aluxmat;

create table aluxmat(
aluxmat_id int auto_increment primary key,
alu_id int,
mat_id tinyint,
foreign key(mat_id) references materias(mat_id),
foreign key(alu_id) references alumnos(alu_id));

insert into aluxmat values 
(null, 6, 1), (null, 6, 2),(null, 6, 3), (null, 6, 4),
(null, 7, 1), (null, 7, 2),(null, 7, 3), (null, 7, 4),
(null, 8, 1), (null, 8, 3),(null, 8, 5), (null, 8, 7),
(null, 9, 2), (null, 9, 4),(null, 9, 6), (null, 9, 8),
(null, 10, 4), (null, 10, 5),(null, 10, 6), (null, 10, 7);


select * From notas;
drop table notas;

create table notas(
nota_id tinyint primary key auto_increment,
nota_1 int (3),
nota_2 int (3),
nota_final int (3),
alu_id int,
mat_id tinyint,
foreign key (alu_id) references alumnos(alu_id),
foreign key (mat_id) references materias(mat_id));

insert into notas value (null, 1, 1, null, 6, 4),
						(null, 2, 2, null, 7, 4),
                        (null, 3, 3, null, 8, 4),
                        (null, 4, 4, null, 9, 4),
                        (null, 4, 4, null, 10, 4);

select * from usuarios;
drop table usuarios;
create table usuarios(
usu_id int primary key auto_increment,
usu_nombre varchar (20),
usu_apellido varchar(20),
usu_usuario varchar (20) UNIQUE,
usu_contra varchar (20),
rol_id tinyint,
foreign key(rol_id) references roles(rol_id));

insert into usuarios values (null, "Gonzalo", "Rojas", "grojas", "1234", 1),
							(null, "Matias", "Vicente", "mvicente", "1234", 2),
                            (null, "Paula", "Giaimo", "pgiaimo", "1234", 3),
                            (null, "Sofia", "Peralta", "speralta", "1234", 4);
                            
insert into usuarios values 
	(null, "Fernando", "Torres", "ftorres", "1234", 4),
	(null, "Alen", "Ozcariz", "aozcariz", "1234", 4),
	(null, "Celeste", "Diaz", "cdiaz", "1234", 4),
	(null, "Dana", "More", "dmore", "1234", 4);

create table profesores(
prof_id int auto_increment primary key,
prof_nom varchar(50),
prof_ape varchar(50),
prof_dni int(10));


