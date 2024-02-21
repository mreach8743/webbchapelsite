
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblAll', 'backend', 'Lable / All', 'script', '2017-03-24 06:35:46');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'All', 'script');

COMMIT;