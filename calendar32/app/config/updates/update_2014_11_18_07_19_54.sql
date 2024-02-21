
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblLocation', 'backend', 'Label / Location', 'script', '2014-11-18 14:33:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Location', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblLocationOnMap', 'backend', 'Label / Location on Google map', 'script', '2014-11-18 15:16:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Location on Google map', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoDefineLocation', 'backend', 'Label / Define location', 'script', '2014-11-18 15:18:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Drag pin to select exact address', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblLocationNotFound', 'backend', 'Label / Location not found', 'script', '2014-11-18 15:59:18');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Location not found', 'script');

INSERT INTO `fields` VALUES (NULL, 'event_statarr_ARRAY_T', 'arrays', 'event_statarr_ARRAY_T', 'script', '2014-11-18 16:13:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Show', 'script');

INSERT INTO `fields` VALUES (NULL, 'event_statarr_ARRAY_F', 'arrays', 'event_statarr_ARRAY_F', 'script', '2014-11-18 16:14:30');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Hide', 'script');


INSERT INTO `fields` VALUES (NULL, 'lblNoCategoriesSet', 'backend', 'Label / No categories Set', 'script', '2014-11-27 10:57:46');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'No categories set. Manage categories [STAG]here[ETAG].', 'script');

ALTER TABLE `events` ADD `location` VARCHAR(255) DEFAULT NULL AFTER `event_title`;

ALTER TABLE `events` ADD `lat` VARCHAR(50) DEFAULT NULL AFTER `location`;

ALTER TABLE `events` ADD `lng` VARCHAR(50) DEFAULT NULL AFTER `lat`;

INSERT INTO `options` (`foreign_id`, `key`, `tab_id`, `value`, `label`, `type`, `order`, `is_visible`, `style`) VALUES(1, 'o_fields_index', 99, 'd874fcc5fe73b90d770a544664a3775d', NULL, 'string', NULL, 0, NULL);

COMMIT;