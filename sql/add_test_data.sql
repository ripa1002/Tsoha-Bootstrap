INSERT INTO Kayttaja (name, password) VALUES ('Risto', 'Risto123');
INSERT INTO Kayttaja (name, password) VALUES ('Esa', 'Esa123');
INSERT INTO Kayttaja (name, password) VALUES ('Ohjaaja', 'ohjaaja1');

INSERT INTO Alue (name) VALUES ('Tietokoneet');
INSERT INTO Alue (name) VALUES ('Internet');
INSERT INTO Alue (name) VALUES ('Ohjelmointi');

INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (1,1,'AMD vs. Intel');
INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (2,2,'React vai angular?');
INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (3,3,'Ttk-91 esimerkkitietokone ja sen simulaattori');