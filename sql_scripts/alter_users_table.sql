ALTER TABLE
    users ADD COLUMN first_name varchar(255),
    ADD COLUMN last_name varchar(255),
    ADD COLUMN date_created TIMESTAMP,
    ADD COLUMN last_login TIMESTAMP;