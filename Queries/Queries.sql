CREATE TABLE Food
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

CREATE TABLE Ingredients
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100),
	quantity INT
);

CREATE TABLE Food_Ingredients
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	food_id INT,
	ingredient_id INT
);

CREATE TABLE Food_Orders
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	food_id INT,
	order_id INT
);

CREATE TABLE Orders(
	id INT AUTO_INCREMENT PRIMARY KEY,
	address VARCHAR(100),
	distributor_id INT
);

CREATE TABLE Distributors
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100),
	car VARCHAR(100)
);



INSERT INTO Types(name)
VALUES ('salad');

INSERT INTO Types(name)
VALUES ('soup');

INSERT INTO Types(name)
VALUES ('main');

INSERT INTO Types(name)
VALUES ('desert');



INSERT INTO Food(type_id,name,price)
VALUES	(3,'Spaghetti Boloneze', 5.00);

INSERT INTO Food(type_id,name,price)
VALUES	(2,'Meatball soup', 2.50);

INSERT INTO Food(type_id,name,price)
VALUES	(1,'Sea Sallad', 4.6);

INSERT INTO Food(type_id,name,price)
VALUES	(3,'Pizza Peperone', 7.20);

INSERT INTO Food(type_id,name,price)
VALUES	(3,'Pizza Margaritta',4.00);

INSERT INTO Food(type_id,name,price)
VALUES	(4,'Fruit Cake',7.00);




INSERT INTO Ingredients(name, quantity)
VALUES	('Spaghetti',100);

INSERT INTO Ingredients(name, quantity)
VALUES	('Tomatoes',10);

INSERT INTO Ingredients(name, quantity)
VALUES	('Boloneze',90);

INSERT INTO Ingredients(name, quantity)
VALUES	('Meatballs',11);

INSERT INTO Ingredients(name, quantity)
VALUES	('Flour',10);

INSERT INTO Ingredients(name, quantity)
VALUES	('Olives',30);

INSERT INTO Ingredients(name, quantity)
VALUES	('Cheese',100);

INSERT INTO Ingredients(name, quantity)
VALUES	('Chicken',15);

INSERT INTO Ingredients(name, quantity)
VALUES	('Salami',19);

INSERT INTO Ingredients(name, quantity)
VALUES	('Sausage',100);

INSERT INTO Ingredients(name, quantity)
VALUES	('Apples',101);

INSERT INTO Ingredients(name, quantity)
VALUES	('Oranges',400);



INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(1,1);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(1,2);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(1,3);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(2,4);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(4,5);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(4,6);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(4,7);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(4,9);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(5,6);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(5,7);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(5,5);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(6,11);

INSERT INTO Food_Ingredients (food_id, ingredient_id)
VALUES(6,12);







select Ingredients.name 
from Food  
Inner join Food_Ingredients 
on Food.id = Food_Ingredients.food_id 
Inner join Ingredients 
on Food_Ingredients.ingredient_id = Ingredients.id 
where Food.id=1;


SELECT Food.name, Ingredients.name
from Food_Ingredients	
left join Food
on Food_Ingredients.food_id = Food.id 
left join Ingredients
on Food_Ingredients.ingredient_id = Ingredients.id
where Food.type_id=3;