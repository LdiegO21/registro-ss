create database servicio;
use servicio;

create table area(
	id_area int primary key not null auto_increment,
	nombre varchar(20));

describe area;
+---------+-------------+------+-----+---------+----------------+
| Field   | Type        | Null | Key | Default | Extra          |
+---------+-------------+------+-----+---------+----------------+
| id_area | int(11)     | NO   | PRI | NULL    | auto_increment |
| nombre  | varchar(20) | YES  |     | NULL    |                |
+---------+-------------+------+-----+---------+----------------+
2 rows in set (0.14 sec)

create table administrador(
	id_admin int primary key not null auto_increment,
	nombre varchar(30),
	app varchar(30),
	apm varchar(30),
	user varchar(10),
	password text(10),
	email varchar(50),
	telefono varchar(15),
	id_area int,
	foreign key(id_area) references area(id_area));

describe administrador;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| id_admin | int(11)     | NO   | PRI | NULL    | auto_increment |
| nombre   | varchar(30) | YES  |     | NULL    |                |
| app      | varchar(30) | YES  |     | NULL    |                |
| apm      | varchar(30) | YES  |     | NULL    |                |
| user     | varchar(15) | YES  |     | NULL    |                |
| password | tinytext    | YES  |     | NULL    |                |
| email    | varchar(30) | YES  |     | NULL    |                |
| telefono | varchar(15) | YES  |     | NULL    |                |
| id_area  | int(11)     | YES  | MUL | NULL    |                |
+----------+-------------+------+-----+---------+----------------+
9 rows in set (0.09 sec)

create table estudiante(
	matricula int primary key not null auto_increment,
	nombre varchar(30),
	app varchar(30),
	apm varchar(30),
	tipo varchar(20),
	telefono varchar(15),
	email varchar(40),
	id_area int,
	foreign key(id_area) references area(id_area));

describe estudiante;
+-----------+-------------+------+-----+---------+-------+
| Field     | Type        | Null | Key | Default | Extra |
+-----------+-------------+------+-----+---------+-------+
| matricula | int(11)     | NO   | PRI | NULL    |       |
| nombre    | varchar(30) | YES  |     | NULL    |       |
| app       | varchar(30) | YES  |     | NULL    |       |
| apm       | varchar(30) | YES  |     | NULL    |       |
| tipo      | varchar(20) | YES  |     | NULL    |       |
| telefono  | varchar(15) | YES  |     | NULL    |       |
| status    | varchar(20) | YES  |     | NULL    |       |
| id_area   | int(11)     | YES  | MUL | NULL    |       |
+-----------+-------------+------+-----+---------+-------+
8 rows in set (0.01 sec)

create table registro_alumno(
	matricula int;
	fecha varchar(10),
	hora_entrada varchar(5),
	hora_salida varchar(5),
	horas varchar(5),
	foreign key(matricula) references estudiante(matricula));

describe registro_alumno;
+--------------+-------------+------+-----+---------+-------+
| Field        | Type        | Null | Key | Default | Extra |
+--------------+-------------+------+-----+---------+-------+
| matricula    | int(11)     | YES  | MUL | NULL    |       |
| fecha        | varchar(15) | YES  |     | NULL    |       |
| hora_entrada | varchar(8)  | YES  |     | NULL    |       |
| hora_salida  | varchar(8)  | YES  |     | NULL    |       |
| horas        | int(11)     | YES  |     | NULL    |       |
+--------------+-------------+------+-----+---------+-------+
5 rows in set (0.00 sec)

create table registro_administrador(
	fecha varchar(10),
	horaregistro varchar(5),
	tipo_actividad varchar(10),
	id_admin int,
	foreign key(id_admin) references adminstrador(id_admin));

describe registro_administrador;
+----------------+-------------+------+-----+---------+-------+
| Field          | Type        | Null | Key | Default | Extra |
+----------------+-------------+------+-----+---------+-------+
| fecha          | varchar(15) | YES  |     | NULL    |       |
| hora_registro  | varchar(8)  | YES  |     | NULL    |       |
| tipo_actividad | varchar(10) | YES  |     | NULL    |       |
| id_admin       | int(11)     | YES  | MUL | NULL    |       |
+----------------+-------------+------+-----+---------+-------+
4 rows in set (0.00 sec)


/*REGISTRAR*/

//delimiter
	CREATE TRIGGER bitacora_alumno_registrar after INSERT ON estudiante OR adminstrador
	for each row 
	begin
		insert into registro_administrador(fecha, horaregistro, tipo_actividad, id_admin) VALUES(CURDATE(), CURTIME(), 'AGREGO',);
end//
delimiter;

/*MODIFICAR*/

//delimiter
	CREATE TRIGGER bitacora_alumno_modificar after UPDATE ON estudiante OR adminstrador
	for each row 
	begin
		insert into registro_administrador(fecha, horaregistro, tipo_actividad) VALUES(CURDATE(), CURTIME(), 'MODIFICO');
end//
delimiter;

/*ELIMINAR*/

//delimiter
	CREATE TRIGGER bitacora_alumno_eliminar after DELETE ON estudiante OR adminstrador
	for each row 
	begin
		insert into registro_administrador(fecha, horaregistro, tipo_actividad) VALUES(CURDATE(), CURTIME(), 'ELIMINO');
end//
delimiter;