CREATE TABLE administrator (
    id       INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL
);

INSERT INTO administrator (id, username, password)
VALUES (1, 'admin', '123456789');


CREATE TABLE animal (
    id          INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    specie_id   INT         NOT NULL,
    name        VARCHAR(32) NOT NULL,
    description MEDIUMTEXT  NOT NULL,
    image_url   MEDIUMTEXT  NOT NULL
);

CREATE TABLE specie (
    id          INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(32) NOT NULL,
    description MEDIUMTEXT  NOT NULL,
    image_url   MEDIUMTEXT  NOT NULL
);

ALTER TABLE animal
ADD CONSTRAINT fk_specie
FOREIGN KEY (specie_id) REFERENCES specie(id);


CREATE TABLE `event` (
    id            INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    kids_only     BOOLEAN     NOT NULL,
    name          VARCHAR(128) NOT NULL,
    description   MEDIUMTEXT  NOT NULL,
    image_url     MEDIUMTEXT  NOT NULL,
    starting_time DATETIME    NOT NULL
);

CREATE TABLE visitor (
    id       INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(32)  NOT NULL,
    username VARCHAR(32)  NOT NULL UNIQUE,
    password MEDIUMTEXT   NOT NULL,
    email    VARCHAR(128) NOT NULL UNIQUE,
    phone    VARCHAR(32)  NOT NULL UNIQUE,
    birthday DATE         NOT NULL
);

CREATE TABLE attendance (
    event_id   INT NOT NULL,
    visitor_id INT NOT NULL
)

ALTER TABLE attendance
ADD CONSTRAINT pk_attendance
PRIMARY KEY (event_id, visitor_id);

ALTER TABLE attendance
ADD CONSTRAINT fk_event
FOREIGN KEY (event_id) REFERENCES event(id);

ALTER TABLE attendance
ADD CONSTRAINT fk_visitor
FOREIGN KEY (visitor_id) REFERENCES visitor(id);


CREATE TABLE page (
    id        INT          NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
    menu_name VARCHAR(16)  NOT NULL,
    title     VARCHAR(128) NOT NULL,
    body_text MEDIUMTEXT   NOT NULL,
    order     INT          NOT NULL
);
