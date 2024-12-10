CREATE DATABASE aquarium
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE aquarium;

CREATE TABLE administrator (
    id       INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL
);

INSERT INTO administrator
    (id, username , password)
VALUES
    ( 1, 'admin'  , '123456789'),
    ( 2, 'semidev', '123456789');


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
    image_url   MEDIUMTEXT  NOT NULL,
    featured    BOOLEAN     NOT NULL
);

ALTER TABLE animal
ADD CONSTRAINT fk_animal_specie
FOREIGN KEY (specie_id) REFERENCES specie(id);


CREATE TABLE visitor (
    id       INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(32)  NOT NULL,
    username VARCHAR(32)  NOT NULL UNIQUE,
    password MEDIUMTEXT   NOT NULL,
    email    VARCHAR(128) NOT NULL UNIQUE,
    phone    VARCHAR(32)  NOT NULL UNIQUE,
    birthday DATE         NOT NULL
);

CREATE TABLE `event` (
    id            INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    kids_only     BOOLEAN      NOT NULL,
    name          VARCHAR(128) NOT NULL,
    description   MEDIUMTEXT   NOT NULL,
    image_url     MEDIUMTEXT   NOT NULL,
    starting_time DATETIME     NOT NULL
);


CREATE TABLE attendance (
    event_id   INT NOT NULL,
    visitor_id INT NOT NULL
)

ALTER TABLE attendance
ADD CONSTRAINT pk_attendance
PRIMARY KEY (event_id, visitor_id);

ALTER TABLE attendance
ADD CONSTRAINT fk_attendance_event
FOREIGN KEY (event_id) REFERENCES event(id);

ALTER TABLE attendance
ADD CONSTRAINT fk_attendance_visitor
FOREIGN KEY (visitor_id) REFERENCES visitor(id);


CREATE TABLE review (
    id          INT        NOT NULL AUTO_INCREMENT PRIMARY KEY,
    visitor_id  INT        NOT NULL,
    rating      INT        NOT NULL,
    feedback    MEDIUMTEXT NOT NULL,
    submit_time DATETIME   NOT NULL
);

ALTER TABLE review
ADD CONSTRAINT fk_review_visitor
FOREIGN KEY (visitor_id) REFERENCES visitor(id);


CREATE TABLE page (
    id        INT          NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
    menu_name VARCHAR(16)  NOT NULL,
    title     VARCHAR(128) NOT NULL,
    body_text MEDIUMTEXT   NOT NULL,
    order     INT          NOT NULL,
    slug      VARCHAR(16)  NOT NULL  UNIQUE
);
