CREATE TABLE asiakkaat
(
asiakasnumero integer primary key,
nimi text,
osoite text,
sahkoposti text,
kayttajanimi text,
salasana text
);

CREATE TABLE tyontekijat
(
tunnusnumero integer primary key,
nimi text,
kayttajanimi text,
salasana text
);

CREATE TABLE paikkavaraukset
(
varausnumero integer primary key,
lento text,
paikka text,
varaaja integer references asiakkaat(asiakasnumero)
);

CREATE TABLE ateriapyynnot
(
vegaani boolean,
kasvis boolean,
muu text,
paikkavaraus integer,
primary key (paikkavaraus),
foreign key (paikkavaraus) references paikkavaraukset
);

CREATE TABLE tuoteryhmat
(
nimi text primary key
);

CREATE TABLE tuotteet
(
tuotenumero integer primary key,
nimi text,
kuvaus text,
hinta decimal,
kuva bytea,
kategoria text references tuoteryhmat(nimi)
);

CREATE TABLE ostokset
(
maara integer,
tilattu boolean,
paikkavaraus integer,
tuote integer,
primary key (paikkavaraus, tuote),
foreign key (paikkavaraus) references paikkavaraukset,
foreign key (tuote) references tuotteet
);

