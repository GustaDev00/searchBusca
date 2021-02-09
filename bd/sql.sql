create database apisch;
# drop database apisch;

CREATE TABLE projeto (
    ID_projeto int NOT NULL AUTO_INCREMENT,
    dominio varchar(255) NOT NULL,
    PRIMARY KEY (ID_projeto)
);

# drop table projeto;

CREATE TABLE pesquisa (
    ID_pesquisa int NOT NULL AUTO_INCREMENT,
    procura varchar(255) NOT NULL,
    data_pesquisa DATE,
    recorrencia varchar(255) NOT NULL,
    ID_projeto int NOT NULL,
    PRIMARY KEY (ID_pesquisa),
    FOREIGN KEY (ID_projeto) REFERENCES projeto(ID_projeto)
);