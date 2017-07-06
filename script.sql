create database omsdm character set utf8 collate utf8_general_ci;
use omsdm;

create table korisnik (
sifra int not null primary key auto_increment,
ime varchar(250),
prezime varchar(250),
avatar varchar(250),
lozinka varchar(250),
korisnicko_ime varchar(250),
device varchar(500) default "Unknown",
admin boolean
)engine=innodb;

create table status (
sifra int not null primary key auto_increment,
tekst text,
korisnik int,
vrijeme datetime
)engine=innodb;

create table likestatus (
sifra int not null primary key auto_increment,
liked boolean,
korisnik int,
status int
)engine=innodb;

create table komentarstatus (
sifra int not null primary key auto_increment,
naziv text,
korisnik int,
status int,
vrijeme datetime
)engine=innodb;

create table zadaca (
sifra int not null primary key auto_increment,
naziv varchar(250),
opiszadatka text,
pocetak date,
kraj date
)engine=innodb;

create table uploadzadaca (
sifra int not null primary key auto_increment,
zadaca int,
korisnik int,
putanja varchar(250)
)engine=innodb;

create table komentarzadaca (
sifra int not null primary key auto_increment,
naziv text,
uploadzadaca int,
korisnik int,
vrijeme datetime
)engine=innodb;

create table likezadaca (
sifra int not null primary key auto_increment,
liked boolean,
uploadzadaca int,
korisnik int
)engine=innodb;

alter table status add foreign key(korisnik) references korisnik(sifra);
alter table likestatus add foreign key(korisnik) references korisnik(sifra);
alter table likestatus add foreign key(status) references status(sifra);
alter table komentarstatus add foreign key(korisnik) references korisnik(sifra);
alter table komentarstatus add foreign key(status) references status(sifra);
alter table uploadzadaca add foreign key(korisnik) references korisnik(sifra);
alter table komentarzadaca add foreign key(korisnik) references korisnik(sifra);
alter table komentarzadaca add foreign key(uploadzadaca) references uploadzadaca(sifra);
alter table likezadaca add foreign key(korisnik) references korisnik(sifra);
alter table likezadaca add foreign key(uploadzadaca) references uploadzadaca(sifra);

#korisnici
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Manuela", "Mikulecki", "slike/avatar_1.png", md5("123"), "mmikulecki");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Tena", "Vilček", "slike/avatar_2.png", md5("123"), "tvilcek");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Andrea", "Mihaljević", "slike/avatar_3.png", md5("123"), "amihaljevic");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime) values ("Antun", "Matanović", "slike/avatar_4.png", md5("123"), "amatanovic");
insert into korisnik (ime, prezime, avatar, lozinka, korisnicko_ime, admin) values ("Tomislav", "Jakopec", "slike/avatar_5.jpg", md5("123"), "tjakopec", 1);

#statusi
insert into status (tekst, korisnik, vrijeme) values ("Ovotjedna zadaća iz OMS-a zahtijeva puno vremena i truda pa vam predlažem da ju počnete što prije raditi.", 1, "2015-10-30 15:30:00");
insert into status (tekst, korisnik, vrijeme) values ("Kako se napravi ono kad upisuješ lozinku da ti budu točkice?", 2, "2015-10-29 14:00:00");

#like statusa 
insert into likestatus (liked, korisnik, status) values (1, 2, 1);
insert into likestatus (liked, korisnik, status) values (1, 3, 1);
insert into likestatus (liked, korisnik, status) values (1, 4, 1);
insert into likestatus (liked, korisnik, status) values (1, 1, 2);

#komentar statusa
insert into komentarstatus (naziv, korisnik, status, vrijeme) values ("hehe imaš pravo, zato sam ja svoju prošli tjedan napravila.", 2, 1, "2015-10-30 16:00:00");
insert into komentarstatus (naziv, korisnik, status, vrijeme) values ("dobro pa si rekla!", 3, 1, "2015-10-30 16:10:00");
insert into komentarstatus (naziv, korisnik, status, vrijeme) values ("na input staviš type da je password", 4, 2, "2015-10-29 14:15:00");

#zadace
insert into zadaca (naziv, opiszadatka, pocetak, kraj) values ("Zadatak 1", "U ovom zadatku je potrebno napraviti web stranicu o vašem talentu", "2015-10-19", "2015-10-25");
insert into zadaca (naziv, opiszadatka, pocetak, kraj) values ("Zadatak 2", "U ovom zadatku je potrebno napraviti web stranicu u kojem ćete koristiti liste", "2015-10-26", "2015-11-01");
insert into zadaca (naziv, opiszadatka, pocetak, kraj) values ("Zadatak 3", "Napravite mrežno mjesto po vašem izboru", "2015-11-02", "2015-11-08");
insert into zadaca (naziv, opiszadatka, pocetak, kraj) values ("Zadatak 4", "Napravite mrežno mjesto sa svim do sada naučenim CSS svojstvima", "2015-11-09", "2015-11-15");

#upload zadace 
insert into uploadzadaca (zadaca, korisnik, putanja) values (1, 1, "http://oziz.ffos.hr/z1");
insert into uploadzadaca (zadaca, korisnik, putanja) values (1, 2, "http://oziz.ffos.hr/z1");
insert into uploadzadaca (zadaca, korisnik, putanja) values (1, 3, "http://oziz.ffos.hr/z1");
insert into uploadzadaca (zadaca, korisnik, putanja) values (1, 4, "http://oziz.ffos.hr/z1");
insert into uploadzadaca (zadaca, korisnik, putanja) values (2, 1, "http://oziz.ffos.hr/z2");
insert into uploadzadaca (zadaca, korisnik, putanja) values (2, 2, "http://oziz.ffos.hr/z2");

#like zadace 
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 1, 2);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 1, 3);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 1, 4);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 1, 5);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 2, 1);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 2, 3);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 5, 1);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 5, 5);
insert into likezadaca (liked, uploadzadaca, korisnik) values (1, 6, 2);

#komentari zadace
insert into komentarzadaca (naziv, uploadzadaca, korisnik, vrijeme) values ("Predobra ti je ova zadaća", 1, 2, "2015-10-22 15:00:00");
insert into komentarzadaca (naziv, uploadzadaca, korisnik, vrijeme) values ("Hvala :)", 1, 1, "2015-10-22 15:15:00");
insert into komentarzadaca (naziv, uploadzadaca, korisnik, vrijeme) values ("Kolegice ovo ne liči ni na što", 2, 5, "2015-10-24 11:00:00");