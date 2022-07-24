create database APIsuperHeroes;

use APIsuperHeroes;

create table grupoHeroe (idGrupoHeroe int AUTO_INCREMENT, grupoHeroe varchar(10) not null, primary key(idGrupoHeroe));

create table tipoPoder (idTipoPoder int AUTO_INCREMENT, tipoPoder varchar(100) not null, primary key(idTipoPoder));

create table ciudadHeroe (idCiudadHeroe int AUTO_INCREMENT, ciudadHeroe varchar(100) not null, primary key(idCiudadHeroe));

create table condicion (idCondicion int AUTO_INCREMENT, tipoCondicion varchar(12) not null, primary key(idCondicion));

create table vehiculo (idVehiculo int AUTO_INCREMENT, nomVehiculo varchar(100) not null, primary key(idVehiculo));

create table super (idSuper int AUTO_INCREMENT, nomSuper varchar (100) not null, idGrupoHeroe int not null, idCiudadHeroe int not null, idCondicion int not null, idVehiculo int not null, img varchar(100), primary key(idSuper));

create table poderes (idSuper int not null, idTipoPoder int not null);

alter table super add foreign key (idGrupoHeroe) references grupoHeroe (idGrupoHeroe) ON DELETE CASCADE ON UPDATE CASCADE;
alter table super add foreign key (idCiudadHeroe) references ciudadHeroe (idCiudadHeroe) ON DELETE CASCADE ON UPDATE CASCADE;
alter table super add foreign key (idCondicion) references condicion (idCondicion) ON DELETE CASCADE ON UPDATE CASCADE;
alter table super add foreign key (idVehiculo) references vehiculo (idVehiculo) ON DELETE CASCADE ON UPDATE CASCADE;
alter table poderes add foreign key (idSuper) references super (idSuper) ON DELETE CASCADE ON UPDATE CASCADE;
alter table poderes add foreign key (idTipoPoder) references tipoPoder (idTipoPoder) ON DELETE CASCADE ON UPDATE CASCADE;