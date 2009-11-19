CREATE TABLE admins (
      id SERIAL,
      username char(40) NOT NULL,
      password char(32) NOT NULL,
      PRIMARY KEY (id)
);

CREATE TABLE file (
      id SERIAL,
      name char(128) NOT NULL,
      filename char(128) NOT NULL,
      type char(40) NOT NULL,
      date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      description text NOT NULL,
      size float NOT NULL,
      PRIMARY KEY (id)
);

CREATE TABLE tagmap (
      id SERIAL,
      file_id integer NOT NULL,
      tag_id integer NOT NULL,
      PRIMARY KEY (id)
);

CREATE TABLE tags (
      tag_id SERIAL,
      name char(40) NOT NULL,
      PRIMARY KEY (tag_id)
);

