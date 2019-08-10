CREATE DATABASE IF NOT EXISTS freshtomatoes_test;
CREATE USER 'testuser'@'%' IDENTIFIED BY 'testpassword';
GRANT ALL ON freshtomatoes_test.* TO 'testuser'@'%';