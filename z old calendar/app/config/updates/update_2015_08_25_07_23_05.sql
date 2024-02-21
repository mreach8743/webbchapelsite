
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblFieldRequired', 'backend', 'Label / This field is required.', 'script', '2015-08-25 06:50:43');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This field is required.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblEmailInvalid', 'backend', 'Label / Email is invalid.', 'script', '2015-08-25 06:51:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Email is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Email is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Email is invalid.', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_0', 'arrays', 'short_days_ARRAY_0', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Su', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Su', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Su', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_1', 'arrays', 'short_days_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Mo', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Mo', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Mo', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_2', 'arrays', 'short_days_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Tu', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Tu', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Tu', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_3', 'arrays', 'short_days_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'We', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'We', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'We', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_4', 'arrays', 'short_days_ARRAY_4', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Th', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Th', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Th', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_5', 'arrays', 'short_days_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fr', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fr', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fr', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_6', 'arrays', 'short_days_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Sa', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Sa', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Sa', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_Yes', 'arrays', 'enum_arr_ARRAY_Yes', 'script', '2015-08-25 07:15:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yes', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_No', 'arrays', 'enum_arr_ARRAY_No', 'script', '2015-08-25 07:15:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_below', 'arrays', 'enum_arr_ARRAY_below', 'script', '2015-08-25 07:22:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Below calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Below calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Below calendar', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_replace', 'arrays', 'enum_arr_ARRAY_replace', 'script', '2015-08-25 07:22:27');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Replace calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Replace calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Replace calendar', 'script');

COMMIT;