CREATE TABLE turnos (
  id        SERIAL      NOT NULL,
  titulo    VARCHAR(10) NOT NULL,
  nombre    VARCHAR(50) NOT NULL,
  email     TEXT        NOT NULL,
  telefono  TEXT        NULL,
  edad      INT         NOT NULL,
  talle     INT         NOT NULL,
  altura    TEXT        NOT NULL,
  fechaNac  DATE        NOT NULL,
  colorPelo TEXT        NOT NULL,
  horario   TEXT        NOT NULL,
  PRIMARY KEY (id)
);