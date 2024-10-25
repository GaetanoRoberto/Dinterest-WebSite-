create user www password 'tsw2022';

drop table if exists utente cascade;
drop table if exists foto cascade;
drop table if exists salvataggio cascade;
drop table if exists likes cascade;
drop table if exists post cascade;
drop table if exists commento cascade;

create table utente(
	username varchar(100) primary key,
	mail varchar(100) not null,
	password varchar(255) not null,
	topic1 varchar(100) not null,
	topic2 varchar(100) not null,
	topic3 varchar(100) not null
);

create table foto(
	id serial primary key,
	img varchar(255) not null, 
	topic varchar(100) not null, 
	data date not null default current_date,
	num_likes int default 0
);

create table salvataggio(
	utente varchar(100) references utente(username) on update cascade on delete cascade,
	foto int references foto(id) on update cascade on delete cascade,
	primary key(utente, foto)
);

create table likes(
	utente varchar(100) references utente(username) on update cascade on delete cascade,
	foto int references foto(id) on update cascade on delete cascade,
	primary key(utente, foto)
);

create table post(
	utente varchar(100) references utente(username) on update cascade on delete cascade,
	foto int references foto(id) on update cascade on delete cascade,
	primary key(utente, foto)
);

create table commento(
	id serial primary key,
	text varchar(255),
	foto_id int references foto(id) on update cascade on delete cascade,
	utente varchar(100) references utente(username) on update cascade on delete cascade
);

grant all privileges on all tables in schema public to www;
grant all privileges on all sequences in schema public to www;