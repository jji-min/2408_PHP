-- DB 생성
-- CREATE DATABASE shop;

-- DB 선택
-- USE shop;

-- DB 삭제
-- DROP DATABASE shop;


-- -------------
-- 테이블 생성
-- -------------
CREATE TABLE users (
	id				BIGINT(20) 		PRIMARY KEY AUTO_INCREMENT
	,NAME 		VARCHAR(50) 	NOT NULL 
	,addr 		VARCHAR(150) 	NOT NULL 
	,gender 		CHAR(1) 			NOT NULL COMMENT 'M = 남자, F = 여자'
	,tel 			VARCHAR(20) 	NOT NULL COMMENT '- 제외 숫자'
	,created_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP
);

CREATE TABLE orders (
	id 				BIGINT(20) 	PRIMARY KEY AUTO_INCREMENT
	,user_id 		BIGINT(20) 	NOT NULL  
	,order_id 		VARCHAR(50) NOT NULL 
	,total_price 	BIGINT(20) 	NOT NULL 
	,created_at 	TIMESTAMP 	NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at 	TIMESTAMP 	NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at 	TIMESTAMP
);

CREATE TABLE products (
	id 				BIGINT(20) 		PRIMARY KEY AUTO_INCREMENT
	,product_name 	VARCHAR(100) 	NOT NULL 
	,price 			BIGINT(20) 		NOT NULL 
	,created_at 	TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at 	TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at 	TIMESTAMP
);

-- --------------
-- 테이블 제거
-- --------------
DROP TABLE orders;
DROP TABLE users, products;

-- --------------
-- TRUNCATE : 테이블 비우기
-- --------------
-- TRUNCATE users;

-- ----------------
-- ALTER : 테이블의 구조를 수정하는 문
-- ----------------
-- FK 추가 방법
-- ALTER TABLE [테이블명]
-- ADD CONSTRAINT [CONSTRAINT]
-- FOREIGN KEY (CONSTRAINT 부여 컬럼명)
-- REFERENCES 참조테이블명(참조테이블 컬럼명)
-- [ON DELETE 동작 / ON UPDATE 동작];

ALTER TABLE orders
ADD CONSTRAINT fk_orders_user_id
FOREIGN KEY (user_id)
REFERENCES users(id);

-- -------------------
-- 컬럼 수정
-- -------------------
ALTER TABLE users
MODIFY COLUMN addr VARCHAR(100) NOT NULL 
;

-- -------------------
-- 컬럼 추가
-- -------------------
ALTER TABLE users
ADD COLUMN birth DATE NOT NULL 
;

-- --------------------
-- 컬럼 제거
-- --------------------
ALTER TABLE users
DROP COLUMN birth
;


-- pk 부호없음 추가1
ALTER TABLE orders
DROP CONSTRAINT fk_orders_user_id;

ALTER TABLE users
DROP COLUMN id;

ALTER TABLE users
ADD COLUMN id BIGINT(20) UNSIGNED
;

ALTER TABLE users
ADD PRIMARY KEY(id);

ALTER TABLE users
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT
;

-- pk 부호없음 추가2
ALTER TABLE orders
DROP CONSTRAINT fk_orders_user_id;
-- fk를 먼저 끊어줌

ALTER TABLE users
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT
;
-- unsigned 추가
ALTER TABLE orders
MODIFY COLUMN user_id BIGINT(20) UNSIGNED NOT NULL
;
-- fk로 연결하기 위해서는 pk와 데이터 타입을 일치 시켜줘야함
ALTER TABLE orders
ADD CONSTRAINT fk_orders_user_id
FOREIGN KEY (user_id)
REFERENCES users(id)
;
-- 다시 fk 연결

-- orders, products 부호없음 추가
ALTER TABLE orders
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT
;

ALTER TABLE products
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT
;