create table users (
    id integer primary key auto_increment,
    name varchar (255), 
    surname varchar (255), 
    email varchar (255), 
    username varchar (255), 
    password varchar (255)
)Engine= innodb;

create table movie(
    id integer auto_increment,
    user_id integer,
    movie_id varchar(255),
    title varchar(255),
    image varchar(255),
    index user(user_id),
    foreign key (user_id) references users(id),
    primary key(id, movie_id)
)Engine=innodb;

create table view(
    id integer primary key auto_increment,
    user_id integer,
    movie_id varchar(255),
    title varchar(255),
    image varchar(255),
    index user(user_id),
    foreign key (user_id) references users(id)
    
)Engine=innodb;