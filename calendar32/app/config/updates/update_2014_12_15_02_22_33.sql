
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblRequiredField', 'backend', 'Label / This field is required.', 'script', '2014-12-15 02:19:30');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'This field is required.', 'script');

COMMIT;