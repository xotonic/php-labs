 create table ctopics(
id int primary key auto_increment,
content text not null,
creator int not null,
created date not null ,
rating int unsigned default 0,
closed bool default false,
moderator int not null,
foreign key (creator) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (moderator) references cusers(id) on update NO ACTION on delete NO ACTION);


create table creplies(
id int primary key auto_increment,
id_topic int not null,
content text not null,
creator int not null,
created date not null,
rating int unsigned default 0,
is_solution bool default false,
moderator int not null,
foreign key (creator) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (moderator) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (id_topic) references ctopics(id) on update NO ACTION on delete NO ACTION
);

create table ccomments(
id int primary key auto_increment,
id_reply int,
id_topic int,
created date not null,
content text not null,
creator int not null,
rating int default 0,
moderator int,
foreign key (creator) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (moderator) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (id_reply) references creplies(id) on update NO ACTION on delete NO ACTION,
foreign key (id_topic) references ctopics(id) on update NO ACTION on delete NO ACTION
);

alter table cusers add column ban bool default false;

create table crates_topic(
id int primary key auto_increment,
id_user int,
id_topic int,
rate int not null,
foreign key (id_user) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (id_topic) references ctopics(id) on update NO ACTION on delete NO ACTION
);

create table crates_reply(
id int primary key auto_increment,
id_user int,
id_reply int,
rate int not null,
foreign key (id_user) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (id_reply) references creplies(id) on update NO ACTION on delete NO ACTION
);


create table crates_comment(
id int primary key auto_increment,
id_user int,
id_comment int,
rate int not null,
foreign key (id_user) references cusers(id) on update NO ACTION on delete NO ACTION,
foreign key (id_comment) references ccomments(id) on update NO ACTION on delete NO ACTION
);
