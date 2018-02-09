INSERT INTO Kayttaja (name, password) VALUES ('Risto', 'Risto123');
INSERT INTO Kayttaja (name, password) VALUES ('Esa', 'Esa123');

INSERT INTO Alue (name) VALUES ('Test1');
INSERT INTO Alue (name) VALUES ('Test2');
INSERT INTO Alue (name) VALUES ('Test3');

INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (1,1,'test1Chain');
INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (2,1,'test2Chain');
INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (3,1,'test3Chain');