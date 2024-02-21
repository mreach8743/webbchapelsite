
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'infoCategoriesTitle', 'backend', 'Infobox / List of categories', 'script', '2015-08-12 03:20:45');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'List of categories', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoCategoriesDesc', 'backend', 'Infobox / List of categories', 'script', '2015-08-12 03:21:53');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can see below the list of categories. If you want to add new category, let click "+ Add category" button.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCategoryTitle', 'backend', 'Infobox / Add category', 'script', '2015-08-12 03:25:09');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Add category', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCategoryDesc', 'backend', 'Infobox / Add category', 'script', '2015-08-12 03:25:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Fill in the category name and click "Save" button to add new category.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCategoryTitle', 'backend', 'Infobox / Update category', 'script', '2015-08-12 03:35:01');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Update category', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCategoryDesc', 'backend', 'Infobox / Update category', 'script', '2015-08-12 03:35:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can make any changes on the form below and click "Save" button to update category name.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUsersTitle', 'backend', 'Infobox / List of users', 'script', '2015-08-12 03:41:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'List of users', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUsersDesc', 'backend', 'Infobox / List of users', 'script', '2015-08-12 03:42:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can see below the list of users. Let click on the button "+ Add user" to add new user.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddUserTitle', 'backend', 'Infobox / Add user', 'script', '2015-08-12 03:43:49');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Add user', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddUserDesc', 'backend', 'Infobox / Add user', 'script', '2015-08-12 03:45:13');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Fill in the form below and click "Save" button to add new user. There are two types of users. Administrator account will have full access to the admin panel of the script. Editor account only have permission to access Events and Categories.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateUserTitle', 'backend', 'Infobox / Update user', 'script', '2015-08-12 03:46:52');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Update user', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateUserDesc', 'backend', 'Infobox / Update user', 'script', '2015-08-12 03:47:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can make any changes on the form below and click "Save" button to update user information.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoEventsTitle', 'backend', 'Infobox / List of events', 'script', '2015-08-12 03:51:15');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'List of events', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoEventsDesc', 'backend', 'Infobox / List of events', 'script', '2015-08-12 03:52:07');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can find below the list of defined events. If you want to add new event, click on the "+ Add event" button.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddEventTitle', 'backend', 'Infobox / Add event', 'script', '2015-08-12 03:53:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Add event', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddEventDesc', 'backend', 'Infobox / Add event', 'script', '2015-08-12 03:53:43');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Fill in the form below and click "Save" button to add new event.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateEventTitle', 'backend', 'Infobox / Update event', 'script', '2015-08-12 03:54:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Update event', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateEventDesc', 'backend', 'Infobox / Update event', 'script', '2015-08-12 03:55:07');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can make any changes on the form below and click "Save" button to update event information.', 'script');

COMMIT;