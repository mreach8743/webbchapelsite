
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AR21', 'arrays', 'error_titles_ARRAY_AR21', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Export events', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Export events', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Export events', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AR21', 'arrays', 'error_bodies_ARRAY_AR21', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can export events in different formats. You can either download a file with events details or use a link for a feed which load all the events.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can export events in different formats. You can either download a file with events details or use a link for a feed which load all the events.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can export events in different formats. You can either download a file with events details or use a link for a feed which load all the events.', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_formats_ARRAY_ical', 'arrays', 'export_formats_ARRAY_ical', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'iCal', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'iCal', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'iCal', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_formats_ARRAY_xml', 'arrays', 'export_formats_ARRAY_xml', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'XML', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'XML', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'XML', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_formats_ARRAY_csv', 'arrays', 'export_formats_ARRAY_csv', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'CSV', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'CSV', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'CSV', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_types_ARRAY_file', 'arrays', 'export_types_ARRAY_file', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'File', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'File', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'File', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_types_ARRAY_feed', 'arrays', 'export_types_ARRAY_feed', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Feed', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_periods_ARRAY_next', 'arrays', 'export_periods_ARRAY_next', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Coming', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Coming', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Coming', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_periods_ARRAY_last', 'arrays', 'export_periods_ARRAY_last', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Created or Modified', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Created or Modified', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Created or Modified', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblFormat', 'backend', 'Label / Format', 'script', '2014-11-27 06:54:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Format', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Format', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Format', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblEnterPassword', 'backend', 'Label / Enter password', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter password', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter password', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter password', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblEvents', 'backend', 'Label / Events', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Events', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Events', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Events', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_1', 'arrays', 'coming_arr_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_2', 'arrays', 'coming_arr_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Tomorrow', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Tomorrow', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Tomorrow', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_3', 'arrays', 'coming_arr_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This week', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_4', 'arrays', 'coming_arr_ARRAY_4', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Next week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Next week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Next week', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_5', 'arrays', 'coming_arr_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This month', 'script');

INSERT INTO `fields` VALUES (NULL, 'coming_arr_ARRAY_6', 'arrays', 'coming_arr_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Next month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Next month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Next month', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_1', 'arrays', 'made_arr_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_2', 'arrays', 'made_arr_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yesterday', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yesterday', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yesterday', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_3', 'arrays', 'made_arr_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This week', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_4', 'arrays', 'made_arr_ARRAY_4', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Last week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Last week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Last week', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_5', 'arrays', 'made_arr_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This month', 'script');

INSERT INTO `fields` VALUES (NULL, 'made_arr_ARRAY_6', 'arrays', 'made_arr_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Last month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Last month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Last month', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnExport', 'backend', 'Button / Export', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Export', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Export', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Export', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnGetFeedURL', 'backend', 'Button / Get Feed URL', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Get Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Get Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Get Feed URL', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoEventFeedTitle', 'backend', 'Infobox / Events Feed URL', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Events Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Events Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Events Feed URL', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoEventFeedDesc', 'backend', 'Infobox / Events Feed URL', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Use the URL below to have access to all events. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Use the URL below to have access to all events. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Use the URL below to have access to all events. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblNoAccessToFeed', 'backend', 'Label / No access to feed', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No access to feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No access to feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No access to feed', 'script');

DROP TABLE IF EXISTS `password`;
CREATE TABLE IF NOT EXISTS `password` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `events` ADD `modified` DATETIME DEFAULT NULL AFTER `status`;

ALTER TABLE `events` ADD `created` DATETIME DEFAULT NULL AFTER `modified`;

COMMIT;