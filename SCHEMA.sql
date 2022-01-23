CREATE DATABASE CAR_RENTAL;

use CAR_RENTAL;
CREATE TABLE `users` (
  `SSN` char(11) NOT NULL,
  `FirstName` varchar(120)  NOT NULL,
  `LastName` varchar(120) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ContactNo` char(11) NOT NULL,
  `dob` DATE NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `admin` boolean default false,
   UNIQUE (`Email`),
   UNIQUE (`ContactNo`),
   PRIMARY KEY (`SSN`)
);
INSERT INTO `users` values('12345678901','Omar','Khalaf','omar@gmail.com','4a7d1ed414474e4033ac29ccb8653d9b','01211498034','2000-05-28','Camp Cezar','Alexandria','Egypt',True);

CREATE TABLE `offices`(
`OId` int NOT NULL AUTO_INCREMENT,
`Country` varchar(50) NOT NULL,
PRIMARY KEY(`OId`)
);
INSERT INTO `offices` (`OId`,`Country`) VALUES
(1,'Egypt'),(2,'US'),(3,'UK'),(4,'Germany');

CREATE TABLE `car` (
  `PlateId` int NOT NULL,
  `CarName` varchar(225) NOT NULL,
  `Overview` varchar(225) NOT NULL,
  `PricePerDay` int NOT NULL,
  `Year` YEAR NOT NULL,
  `Image` varchar(300) NOT NULL,
  `DriverAirbag` char(1) NOT NULL,
  `AirConditioner` char(1) NOT NULL,
  `SeatingCapacity` int NOT NULL,
  `CrashSensor` char(1) NOT NULL,
  `Color` varchar(225) NOT NULL,
  `Auto` char(1) NOT NULL,
  `OId` int NOT NULL,
  `CarStatus` varchar(225) NOT NULL,
   PRIMARY KEY (`PlateId`)
);

INSERT INTO `car` (`PlateId`, `CarName`, `Overview`, `PricePerDay`, `Year`, `Image`,`DriverAirbag`,`AirConditioner`,`SeatingCapacity`,`CrashSensor`,`Color`,`Auto`,`OId`,`CarStatus`) VALUES
(1000, 'Rio',  'AC', 3000, '2022', './images/kia.jpg',1,1,6,0,'Silver',1,1,'Active'),
(1011, 'X6','SUPER FAST!', 10000, '2016', './images/BMW.jpg',1,1,4,1,'White',1,2,'Active'),
(1012, 'Q8',  'LARGE', 12000, '2018', './images/audi.jpg',1,1,4,0,'Black',1,3,'Active'),
(1013, 'Sunny', 'DOES THE JOB', 1500, '2015','./images/Nissan.jpg',0,1,4,0,'Grey',0,4,'Active');

CREATE TABLE `reservation` (
  `ReservationNumber` int NOT NULL AUTO_INCREMENT,
  `SSN` char(11) NOT NULL,
  `PlateId` int NOT NULL,
  `Pickup` DATE  NOT NULL,
  `Return` DATE  NOT NULL,
  `Payment` varchar(225),
  `TotalPrice` int NOT NULL,
  UNIQUE(`ReservationNumber`),
  PRIMARY KEY (`SSN`,`PlateId`,`Pickup`)
);


CREATE TABLE `category` (
  `CarName` varchar(225) NOT NULL ,
  `BrandName` varchar(225) NOT NULL,
  PRIMARY KEY(`CarName`) 
);
INSERT INTO `category` (`CarName`, `BrandName`) VALUES
('Rio', 'KIA'),
('X6', 'BMW'),
('Q8', 'AUDI'),
('Sunny', 'NISSAN');


ALTER TABLE `reservation` ADD foreign key (`SSN`)  references `users`(`SSN`) ON Delete CASCADE ON UPDATE CASCADE;
ALTER TABLE `reservation` ADD foreign key (`PlateId`)  references `car`(`PlateId`) ON Delete CASCADE ON UPDATE CASCADE;
ALTER TABLE `car` ADD foreign KEY(`CarName`) references `category`(`CarName`) ON Delete CASCADE ON UPDATE CASCADE;
ALTER TABLE `car` ADD foreign KEY(`OId`) references `offices` (`OId`) ON Delete CASCADE ON UPDATE CASCADE;

