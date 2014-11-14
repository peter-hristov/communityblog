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
    text VARCHAR(500),
    created DATETIME,
    modified DATETIME
);


DROP TABLE IF EXISTS `users`;
CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login_type INT,
    login_id INT,
    name VARCHAR(100),
    birthDate DATE,
    gender VARCHAR(1),
    email VARCHAR(100),
    token VARCHAR(50),
    email_confirmed BOOLEAN,
    created DATETIME
);

DROP TABLE IF EXISTS `app_logins`;
CREATE TABLE app_logins
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(40)
);

DROP TABLE IF EXISTS `fb_logins`;
CREATE TABLE fb_logins
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fb_id VARCHAR(100)
);