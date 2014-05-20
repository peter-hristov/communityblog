
DROP TABLE IF EXISTS `posts`;
CREATE TABLE posts
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    status INT,
    title VARCHAR(300),
    body VARCHAR(3000),
    created DATETIME,
    modified DATETIME
);

DROP TABLE IF EXISTS `comments`;
CREATE TABLE comments
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    body VARCHAR(500),
    created DATETIME,
    modified DATETIME
);


DROP TABLE IF EXISTS `comments`;
CREATE TABLE comments
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    body VARCHAR(500),
    created DATETIME,
    modified DATETIME
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    password VARCHAR(40),
    created DATETIME
);

## Posts

# 1
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title', 'This body', NOW(), NOW());

# 2
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title2', 'This body2', NOW(), NOW());

# 3
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title3', 'This body3', NOW(), NOW());

# 4
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title4', 'This body4', NOW(), NOW());

# 5
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title5', 'This body5', NOW(), NOW());

# 6
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title6', 'This body6', NOW(), NOW());



## Users

# 1
INSERT INTO users(email, password, created)
VALUES ('admin@admin.com', 'admin', NOW());


## Comments

INSERT INTO comments(user_id, post_id, body, created, modified)
VALUES (3, 1, 'GREAT POST!', NOW(), NOW());