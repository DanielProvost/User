create table user
(
    id        int auto_increment
        primary key,
    lastname  varchar(155)                       null,
    firstname varchar(155)                       null,
    email     varchar(155)                       null,
    password  varchar(155)                       null,
    avatar    varchar(60)                        null,
    createdAt datetime default CURRENT_TIMESTAMP not null,
    constraint Email_UNIQUE
        unique (email)
);