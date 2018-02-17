CREATE TABLE Kayttaja (
    id SERIAL PRIMARY KEY,
    name varchar(30),
    password varchar(50),
    admin boolean DEFAULT false
);

CREATE TABLE Alue (
    id SERIAL PRIMARY KEY,
    name varchar(50)
);

CREATE TABLE Ketju (
    id SERIAL PRIMARY KEY,
    alue_id integer NOT NULL,
    kayttaja_id integer NOT NULL,
    name varchar(120),
    FOREIGN KEY (alue_id) REFERENCES Alue(id),
    FOREIGN KEY (kayttaja_id) REFERENCES Kayttaja(id)
);

CREATE TABLE Viesti (
    id SERIAL PRIMARY KEY,
    ketju_id integer NOT NULL,    
    kayttaja_id integer NOT NULL,
    sisalto varchar(2000),
    aika varchar(20),
    FOREIGN KEY (ketju_id) REFERENCES Ketju(id),
    FOREIGN KEY (kayttaja_id) REFERENCES Kayttaja(id)
);
