CREATE TABLE candidatos (
  nome varchar(200) NOT NULL,
  codigo int NOT NULL,
  cargo varchar(99) NOT NULL,
  partido varchar(10) NOT NULL,
  PRIMARY KEY (codigo, cargo)
);

CREATE TABLE cargos (
  nome varchar(20) NOT NULL,
  qtd_digitos int NOT NULL,
  ordem_votacao int NOT NULL UNIQUE,
  PRIMARY KEY (nome)
);

INSERT INTO cargos
VALUES
    ('vereador', 5, 0),
    ('prefeito', 2, 1);