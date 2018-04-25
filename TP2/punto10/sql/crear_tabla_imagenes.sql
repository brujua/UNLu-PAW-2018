-- Database: "dbImagenes"

-- DROP DATABASE "dbImagenes";

--CREATE DATABASE "dbImagenes"
 -- WITH OWNER = postgres
   --    ENCODING = 'UTF8'
     --  TABLESPACE = pg_default
       --LC_COLLATE = 'Spanish_Argentina.1252'
    --   LC_CTYPE = 'Spanish_Argentina.1252'
     --  CONNECTION LIMIT = -1;
create table imagenes(
	ID_IMAGEN serial NOT NULL PRIMARY KEY,
	NOMBRE character(64),
	IMAGEN bytea
 );