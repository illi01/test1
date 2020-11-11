CREATE TABLE Article (
id serial primary key,
name varchar(255) not null,
text text not null,
date_created datetime default NOW(),
creator_name varchar(255) not null
)

create table Commnets (
id serial primary key,
creator_name varchar(255) not null,
email varchar(255) not null,
text text not null,
date_created datetime default NOW(),
article_id integer not null REFERENCES Article ON DELETE CASCADE
FOREIGN KEY(article_id) REFERENCES Article (id)
)