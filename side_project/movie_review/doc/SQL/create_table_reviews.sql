CREATE DATABASE IF NOT EXISTS movie_review;

USE movie_review;

DROP TABLE IF EXISTS reviews;

CREATE TABLE reviews (
	id 			BIGINT(20) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,title 		VARCHAR(100) 			NOT NULL
	,rating 		INT(2) 					NOT NULL 	DEFAULT 0 	COMMENT '0 ~ 10 까지의 숫자'
	,review 		VARCHAR(1000)
	,img 			VARCHAR(1000) 			NOT NULL 					COMMENT '이미지 저장 경로'
	,good			BIGINT(20) UNSIGNED 	NOT NULL 	DEFAULT 0
	,bad			BIGINT(20) UNSIGNED 	NOT NULL 	DEFAULT 0
	,created_at TIMESTAMP 				NOT NULL 	DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP				NOT NULL 	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP
);