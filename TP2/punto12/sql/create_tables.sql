CREATE TABLE Post (
  id      SERIAL,
  title   TEXT,
  descr   TEXT,
  imgName TEXT,
  fecha   DATE,
  PRIMARY KEY (id)

);

CREATE TABLE comments (
  id      SERIAL,
  id_post SERIAL,
  author  TEXT,
  body    TEXT,
  PRIMARY KEY (id),
  FOREIGN KEY (id_post) REFERENCES Post

);

CREATE TABLE tags (
  id_post SERIAL,
  tag     VARCHAR(10),
  PRIMARY KEY (id_post, tag),
  FOREIGN KEY (id_post) REFERENCES Post
);