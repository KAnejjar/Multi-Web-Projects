create table utilisateur(
	id_utilisateur int not null primary key AUTO_INCREMENT,
	nom varchar(225),
	email varchar(225),
	role varchar(225),
	password varchar(225)
);
create table ticket(
	id_ticket int not null primary key AUTO_INCREMENT,
	type varchar(225),
	categorie varchar(225),
	titre varchar(225),
	description varchar(225),
	statut varchar(225),
	priorite varchar(225),
	piece_jointe varchar(225)
);
create table attribution(
	id_attribution int not null primary key AUTO_INCREMENT,
	ticket int not null references ticket(id_ticket),
	utilisateur int not null references utilisateur(id_utilisateur)
);
create table suivi(
	id_suivi int not null primary key AUTO_INCREMENT,
	id_utilisateur int not null references utilisateur(id_utilisateur),
	id_ticket int not null references ticket(id_ticket),
	titre varchar(225),
	description varchar(225),
	date_creation varchar(225)
);

insert into utilisateur values(1,"user1", "user1@gmail.com", "technicien", "user1pwd");
insert into utilisateur values(2,"user2", "user2@gmail.com", "utilisateur", "user2pwd");
insert into utilisateur values(3,"user3", "user3@gmail.com", "chefdeprojet", "user3pwd");
select * from utilisateur;

insert into ticket values(1,"incident","logiciel","ticket1","le ticket 1","","haute","");

alter table ticket add demandeur varchar(225);
alter table ticket add technicien varchar(225);
alter table suivi add piece_jointe varchar(225);

alter table ticket add date_ajout varchar (255);