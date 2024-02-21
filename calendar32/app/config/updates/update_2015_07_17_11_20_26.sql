
START TRANSACTION;

UPDATE `options` SET `value`='tooltip|datecell|hidden::tooltip', `is_visible`='0' WHERE `key`='o_event_title_position';

INSERT INTO `fields` VALUES (NULL, 'opt_o_theme', 'backend', 'Options / Theme', 'script', '2015-07-17 03:42:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoThemeTitle', 'backend', 'Infobox / Preview front end', 'script', '2015-07-17 03:43:37');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Preview front end', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoThemeDesc', 'backend', 'Infobox / Preview front end', 'script', '2015-07-17 03:44:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'There are multiple color schemes available for the front end. Click on each of the thumbnails below to preview it. Click on "Use this theme" button for the theme you want to use.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblInstallTheme', 'backend', 'Label / Choose theme', 'script', '2015-07-17 03:44:58');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Choose theme', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblCurrentlyInUse', 'backend', 'Label / Currently in use', 'script', '2015-07-17 03:45:24');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Currently in use', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnUseThisTheme', 'backend', 'Button / Use this theme', 'script', '2015-07-17 03:45:52');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Use this theme', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_1', 'arrays', 'option_themes_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 1', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_2', 'arrays', 'option_themes_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 2', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_3', 'arrays', 'option_themes_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 3', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_4', 'arrays', 'option_themes_ARRAY_4', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 4', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_5', 'arrays', 'option_themes_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 5', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_6', 'arrays', 'option_themes_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 6', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_7', 'arrays', 'option_themes_ARRAY_7', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 7', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_8', 'arrays', 'option_themes_ARRAY_8', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 8', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_9', 'arrays', 'option_themes_ARRAY_9', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 9', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_themes_ARRAY_10', 'arrays', 'option_themes_ARRAY_10', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Theme 10', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_day_of_next_month', 'frontend', 'Label / Days of the next month', 'script', '2015-07-17 10:32:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Days of the next month', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_day_of_prev_month', 'frontend', 'Label / Days of the previous month', 'script', '2015-07-17 10:33:25');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Days of the previous month', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_today', 'frontend', 'Label / Today', 'script', '2015-07-17 10:34:10');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Today', 'script');

COMMIT;