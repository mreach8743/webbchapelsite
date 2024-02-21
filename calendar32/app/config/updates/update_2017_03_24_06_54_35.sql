
START TRANSACTION;

DELETE FROM `multi_lang` WHERE `locale`<>'1';

COMMIT;