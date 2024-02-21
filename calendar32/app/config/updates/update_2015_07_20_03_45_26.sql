
START TRANSACTION;

UPDATE `options` SET `is_visible`='0' WHERE `key`='o_theme';

INSERT INTO `fields` VALUES (NULL, 'front_starts_at', 'frontend', 'Label / starts at', 'script', '2015-07-20 03:08:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'starts at', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_ends_at', 'frontend', 'Label / ends at', 'script', '2015-07-20 03:09:01');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'ends at', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_no_events_found', 'frontend', 'No events found.', 'script', '2015-07-20 03:30:32');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'No events found.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_all_categories', 'frontend', 'Label / All categories', 'script', '2015-07-20 03:42:28');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'All categories', 'script');

COMMIT;