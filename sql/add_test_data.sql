INSERT INTO Kayttaja (name, password) VALUES ('Risto', 'Risto123');
INSERT INTO Kayttaja (name, password) VALUES ('Esa', 'Esa123');

INSERT INTO Alue (name) VALUES ('Tietokoneet');
INSERT INTO Alue (name) VALUES ('Autot');
INSERT INTO Alue (name) VALUES ('Junat');

INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (1,1,'Commodore 64');
INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (1,1,'Sinclair');