INSERT INTO asiakkaat VALUES (DEFAULT, 'jaska jokunen', 'asdasd 3b', 'asd@hotmail.com', 'jaskanen', '1234');
INSERT INTO asiakkaat VALUES (DEFAULT, 'maijja mallikas', 'asdasd 4b', 'asd2@hotmail.com', 'maijjanen', '4321');

INSERT INTO tyontekijat VALUES (DEFAULT, 'maijja mehilainen', 'maijjis', 'maijjis1234');

INSERT INTO paikkavaraukset VALUES (DEFAULT, 'DEF', '24A', 1);
INSERT INTO paikkavaraukset VALUES (DEFAULT, 'ABC123', '13C', 1);
INSERT INTO paikkavaraukset VALUES (DEFAULT, 'ABC123', '25B', 1);

INSERT INTO ateriapyynnot VALUES (FALSE, TRUE, 'tupla-ateria mulle', 1);
INSERT INTO ateriapyynnot VALUES (TRUE, FALSE, '', 2);
INSERT INTO ateriapyynnot VALUES (TRUE, FALSE, '', 3);

INSERT INTO tuoteryhmat VALUES ('elektroniikka');
INSERT INTO tuoteryhmat VALUES ('vaatteet');
INSERT INTO tuoteryhmat VALUES ('kosmetiikka');

INSERT INTO tuotteet (nimi, kuvaus, hinta, kategoria) VALUES ('mp3-soitin', 'soittaa musaa', 25.5, 'elektroniikka');
INSERT INTO tuotteet VALUES (DEFAULT, 'imuri', 'imuroi pölyä', 50.99, NULL, 'elektroniikka');
INSERT INTO tuotteet VALUES (DEFAULT, 't-paita', 'lämmin t-paita', 10, NULL, 'vaatteet');
INSERT INTO tuotteet VALUES (DEFAULT, 'sukat', 'mustat sukat', 5, NULL, 'vaatteet');
INSERT INTO tuotteet VALUES (DEFAULT, 'shampoo', 'pesee hiukset', 1, NULL, 'kosmetiikka');

INSERT INTO ostokset VALUES (3, TRUE, 1, 1);
INSERT INTO ostokset VALUES (2, FALSE, 1, 2);

