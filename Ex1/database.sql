
CREATE TABLE users (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) DEFAULT NULL,
	gender CHAR(1) NOT NULL COMMENT 'm - мужчина, f - женщина.',
	birth_day DATE NOT NULL
);

CREATE TABLE phone_numbers (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id BIGINT UNSIGNED NOT NULL UNIQUE,
	phone BIGINT UNSIGNED DEFAULT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

SELECT u.name, count(p.phone) AS total 	
FROM phone_numbers p
JOIN users u ON p.user_id = u.id
WHERE (
	(YEAR(CURRENT_DATE) - YEAR(birth_day)) - 
	(DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(birth_day, '%m%d'))
	 ) 
BETWEEN 18 AND 22
GROUP BY u.name;
