TRUNCATE TABLE candidatos;
TRUNCATE TABLE vices;

INSERT INTO candidatos (cargo, codigo, nome, partido)
VALUES 
    ('vereador', 51222, 'Christianne Varão', 'PEN'),
    ('vereador', 55555, 'Homero do Zé Filho', 'PSL'),
    ('vereador', 43333, 'Dandor', 'PV'),
    ('vereador', 15123, 'Filho', 'MDB'),
    ('vereador', 27222, 'Joel Varão', 'PSDC'),
    ('vereador', 45000, 'Professor Clebson Almeida', 'PSDB'),

    ('prefeito', 12, 'Chiquinho do Adbon', 'PDT'),
    ('prefeito', 15, 'Malrinete Gralhada', 'MDB'),
    ('prefeito', 45, 'Dr. Francisco', 'PSC'),
    ('prefeito', 54, 'Zé Lopes', 'PPL'),
    ('prefeito', 65, 'Lindomar Pescador', 'PC do B');

INSERT INTO vices (cargo, codigo, nome, partido)
VALUES 
    ('prefeito', 12, 'Arão', 'PDT'),
    ('prefeito', 15, 'Biga', 'MDB'),
    ('prefeito', 45, 'João Rodrigues', 'PSC'),
    ('prefeito', 54, 'Fracisca Ferreira Ramos', 'PPL'),
    ('prefeito', 65, 'Malú', 'PC do B');