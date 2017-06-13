DROP TABLE `common`, `credentials`, `users`;

DROP TABLE `users`;

CREATE TABLE `users` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
  , first_name VARCHAR(20) NOT NULL
  , last_name VARCHAR(20) NOT NULL
  , place VARCHAR(32) DEFAULT TRUE
  , region VARCHAR(32) DEFAULT TRUE
  , country VARCHAR(32) DEFAULT TRUE
  , month VARCHAR(2) DEFAULT TRUE
  , day INT(2) DEFAULT TRUE
  , year INT(4) DEFAULT TRUE
  , gender VARCHAR(1)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci
;

DROP TABLE `credentials`;

CREATE TABLE `credentials` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
  , users_id INT NOT NULL
  , email VARCHAR(64) NOT NULL UNIQUE
  , password VARCHAR(45) NOT NULL
  , salt VARCHAR(8) NOT NULL
  , cookie VARCHAR(10) NOT NULL
  , FOREIGN KEY (users_id) REFERENCES users(id)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci
;

DROP TABLE `common`;

CREATE TABLE `common` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
  , users_id INT NOT NULL
  , credentials_id INT NOT NULL
  , FOREIGN KEY (users_id) REFERENCES users(id)
  , FOREIGN KEY (credentials_id) REFERENCES credentials(id)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci
;

DROP TRIGGER IF EXISTS `add_in_common`;

DELIMITER $$
CREATE TRIGGER `add_in_common`
AFTER INSERT ON `credentials`
FOR EACH ROW
  BEGIN
    INSERT INTO `common` SET
      `id` = NULL
      ,`users_id` = NEW.id
      , `credentials_id` = LAST_INSERT_ID()
    ;
  END $$
DELIMITER ;