CREATE DATABASE articledb with encoding 'UTF8';

CREATE TABLE articles (
    id serial primary key,
    name varchar(255) not null,
    text text not null,
    date_created timestamp default NOW(),
    creator_name varchar(255) not null
);

CREATE TABLE comments (
    id serial primary key,
    creator_name varchar(255) not null,
    email varchar(255) not null,
    text text not null,
    date_created timestamp default NOW(),
    article_id integer not null REFERENCES articles ON DELETE CASCADE,
    FOREIGN KEY(article_id) REFERENCES articles (id)
);

insert into articles (name, text, creator_name) values ('How to lose weight', 'To loose weight you have to excercise', 'John Doe');
