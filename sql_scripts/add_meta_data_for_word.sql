ALTER TABLE
    words ADD COLUMN `length` TINYINT(1),
    ADD COLUMN `weight` TINYINT(1),
    ADD COLUMN `strength` TINYINT(1),
    ADD COLUMN `level` TINYINT(1),
    ADD COLUMN `date_created` TIMESTAMP DEFAULT NOW(),
    ADD COLUMN `date_modified` TIMESTAMP DEFAULT NOW( ) ON UPDATE NOW();