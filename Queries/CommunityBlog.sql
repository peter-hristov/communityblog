
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

## Posts

# 1
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title', 'This body', NOW(), NOW());

# 2
INSERT INTO posts(user_id, status, title, body, created, modified)
VALUES (3, 0, 'This title2', 'This body2', NOW(), NOW());


## Comments
INSERT INTO comments(user_id, post_id, body, created, modified)
VALUES (3, 1, 'GREAT POST!', NOW(), NOW());