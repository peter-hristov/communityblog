CREATE TABLE Cars
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	type_id INT,
	name VARCHAR(100),
	price FLOAT
);

CREATE TABLE Types
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100)
);

CREATE TABLE Accessoires
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100)
);

CREATE TABLE Car_Accessoire
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	car_id INT,
	accessoire_id INT
);

CREATE TABLE Orders(
	id INT AUTO_INCREMENT PRIMARY KEY,
	car_id INT,
	address VARCHAR(100),
	date DATETIME
);



INSERT INTO Types(name)
VALUES ('Opel');

INSERT INTO Types(name)
VALUES ('BMW');

INSERT INTO Types(name)
VALUES ('Audi');

INSERT INTO Types(name)
VALUES ('Lada');




INSERT INTO Cars(type_id,name,price)
VALUES	(3,'Q7', 32000.00);

INSERT INTO Cars(type_id,name,price)
VALUES	(2,'M4', 2.50);

INSERT INTO Cars(type_id,name,price)
VALUES	(1,'Astra', 4.6);

INSERT INTO Cars(type_id,name,price)
VALUES	(3,'TT', 7.20);

INSERT INTO Cars(type_id,name,price)
VALUES	(3,'A8',4.00);

INSERT INTO Cars(type_id,name,price)
VALUES	(4,'Nive',7.00);





INSERT INTO Accessoires(name)
VALUES	('Климатик');

INSERT INTO Accessoires(name)
VALUES	('Кожен Салон');

INSERT INTO Accessoires(name)
VALUES	('Мини Бар');

INSERT INTO Accessoires(name)
VALUES	('4х4');

INSERT INTO Accessoires(name)
VALUES	('Комби');

INSERT INTO Accessoires(name)
VALUES	('Седан');

INSERT INTO Accessoires(name)
VALUES	('Кабрио');

INSERT INTO Accessoires(name)
VALUES	('Крууз Контрол');

INSERT INTO Accessoires(name)
VALUES	('Тъмни Стъкла');

INSERT INTO Accessoires(name)
VALUES	('Спинери');

INSERT INTO Accessoires(name)
VALUES	('Карбонов капак');

INSERT INTO Accessoires(name)
VALUES	('Спойлер');



INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(1,1);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(1,2);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(1,3);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(2,4);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(4,5);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(4,6);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(4,7);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(4,9);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(5,6);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(5,7);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(5,5);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(6,11);

INSERT INTO Car_Accessoire (car_id, accessoire_id)
VALUES(6,12);