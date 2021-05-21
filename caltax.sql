create database caltax;
use coltax;
create table admin
(
    adminID  int         not null
        primary key,
    username varchar(30) not null,
    password varchar(30) not null,
    constraint username
        unique (username)
);
create table employee
(
    Name       varchar(30) not null,
    employeeID int         not null
        primary key,
    username   varchar(30) not null,
    password   varchar(30) not null
);

-- add your admin credentials.
INSERT INTO caltax.admin (adminID, username, password) VALUES (1, 'saim', 'saim123');
INSERT INTO caltax.admin (adminID, username, password) VALUES (1, 'admin', 'loverboi321');

-- add employess credentials.
INSERT INTO caltax.employee (employeeID, Name, username, password) VALUES (1, 'Salal Shah', 'salal', 'coltax123');
INSERT INTO caltax.employee (employeeID, Name, username, password) VALUES (2, 'Qasim Khan', 'qasim', 'coltax1234');
INSERT INTO caltax.employee (employeeID, Name, username, password) VALUES (3, 'Awais Khan', 'awais', 'coltax12345');
INSERT INTO caltax.employee (employeeID, Name, username, password) VALUES (4, 'Bashir Khan', 'basir', 'coltax123456');


CREATE TABLE paymenttypes
(
  typeID int(11) NOT NULL,
  paymentName varchar(30) NOT NULL,
  PRIMARY KEY (`typeID`)
);

INSERT INTO paymenttypes (typeID, paymentName) VALUES (1, 'Bitcoin');
INSERT INTO paymenttypes (typeID, paymentName) VALUES (2, 'Perfect Money');

create table products
(
    productID   int         not null
        primary key,
    productName varchar(30) not null
);

INSERT INTO caltax.products (productID, productName) VALUES (1, 'Scampage');
INSERT INTO caltax.products (productID, productName) VALUES (2, 'Antibot Scampage');
INSERT INTO caltax.products (productID, productName) VALUES (3, 'Monthly Cpanel');
INSERT INTO caltax.products (productID, productName) VALUES (4, 'Hacked Cpanel');

create table employeeachievements
(
    achievementID int auto_increment
        primary key,
    employeeID    int  not null,
    productID     int  not null,
    price         int  not null,
    investment    int  not null,
    salary        int  null,
    submitionDate date not null,
    paymentTypeID int  not null,
    constraint EmployeeAchievements_employee_employeeID_fk
        foreign key (employeeID) references employee (employeeID)
            on update cascade,
    constraint EmployeeAchievements_products_productID_fk
        foreign key (productID) references products (productID)
            on update cascade,
    constraint employeeachievements_paymenttypes_typeID_fk
        foreign key (paymentTypeID) references paymenttypes (typeID)
            on update cascade
);

/*
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (3, 1, 3, 90000, 10000, 80000, '2021-04-08', 1);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (4, 1, 2, 10000, 155, 9845, '2021-04-11', 1);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (5, 1, 1, 9000, 8000, 1000, '2021-04-06', 1);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (6, 2, 1, 10000, 1900, 8100, '2021-04-16', 2);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (7, 2, 4, 80000, 20000, 60000, '2021-04-07', 1);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (8, 1, 2, 8000, 1000, 7000, '2021-04-12', 2);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (9, 1, 1, 12000, 1400, 10600, '2021-04-10', 1);
INSERT INTO caltax.employeeachievements (achievementID, employeeID, productID, price, investment, salary, submitionDate, paymentTypeID) VALUES (10, 1, 1, 1200, 800, 400, '2021-04-01', 2);*/



create table pagezips
(
    zipfilename varchar(30) not null,
    previewLink longtext    null
);







