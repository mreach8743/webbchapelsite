
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'infoGeneralTitle', 'backend', 'Infobox / General options', 'script', '2015-08-25 08:14:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'General options', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'General options', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'General options', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoGeneralDesc', 'backend', 'Infobox / General options', 'script', '2015-08-25 08:15:18');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Below you can set the main system options for PHP Event Calendar.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Below you can set the main system options for PHP Event Calendar.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Below you can set the main system options for PHP Event Calendar.', 'script');

COMMIT;