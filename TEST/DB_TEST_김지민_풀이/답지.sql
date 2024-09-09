-- 1. 사원 정보테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO employees(
	NAME 
	,birth
	,gender
	,hire_at
)
VALUES(
	'김지민'
	,'2000-06-30'
	,'F'
	,DATE(NOW())
)
;


-- 2. 월급, 직급, 소속부서 테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO salaries(
	emp_id
	,salary
	,start_at
)
VALUES(
	100001
	,30000000
	,DATE(NOW())
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
)
VALUES(
	100001
	,'T001'
	,DATE(NOW())
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES(
	100001
	,'D002'
	,DATE(NOW())
)
;


-- 3. 짝궁의 것도 넣어주세요.
INSERT INTO employees(
	name
	,birth
	,gender
	,hire_at
)
VALUES(
	'우민주'
	,'2000-02-08'
	,'F'
	,DATE(NOW())
)
;

INSERT INTO salaries(
	emp_id
	,salary
	,start_at
)
VALUES(
	100002
	,26000000
	,DATE(NOW())
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
)
VALUES(
	100002
	,'T001'
	,DATE(NOW())
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES(
	100002
	,'D002'
	,DATE(NOW())
)
;


-- 4. 나와 짝궁의 소속 부서를 D009로 변경해 주세요.
-- UPDATE department_emps
-- SET department_emps.dept_code = 'D009'
-- WHERE
-- 	department_emps.emp_id IN (100001, 100002)
-- ;
-- -> where 조건 이상 - 소속부서 이력이 복수일경우 모두 갱신됨
-- UPDATE department_emps
-- SET
-- 	end_at = DATE(NOW())
-- 	,updated_at = NOW()
-- WHERE
-- 		(
-- 				emp_id = 100001
-- 			OR emp_id = 100002
-- 		)
-- 		AND end_at IS NULL 
-- ;
UPDATE department_emps
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE
			emp_id IN (100001, 100002)
		AND end_at IS NULL 
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES(
	100001
	,'D009'
	,DATE(NOW())
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES(
	100002
	,'D009'
	,DATE(NOW())
)
;


-- 5. 짝궁의 모든 정보를 삭제해 주세요.
-- employees부터 삭제하는 것이 아니라
-- 참조하고 있는 테이블부터 삭제해야함
-- 그다음에 employees 삭제
DELETE FROM salaries
WHERE emp_id = 100002;

DELETE FROM title_emps
WHERE emp_id = 100002;

DELETE FROM department_emps
WHERE emp_id = 100002;

DELETE FROM employees
WHERE emp_id = 100002;


-- 6. 'D009'부서의 관리자를 나로 변경해 주세요.
UPDATE department_managers
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE
		dept_code = 'D009'
	AND end_at IS NULL
;

INSERT INTO department_managers(
	emp_id
	,dept_code
	,start_at
)
VALUES(
	100001
	,'D009'
	,DATE(NOW())
)
;


-- 7. 오늘 날짜부로 나의 직책을 '대리'로 변경해 주세요.
-- UPDATE title_emps
-- SET
-- 	end_at = DATE(NOW())
-- 	,updated_at = NOW()
-- WHERE
-- 	emp_id = 100001
-- ;
-- 
-- INSERT INTO title_emps(
-- 	emp_id
-- 	,title_code
-- 	,start_at
-- )
-- VALUES(
-- 	100001
-- 	,'T002'
-- 	,DATE(NOW())
-- )
-- ;
-- -> where 조건 이상- 나의 직책 이력이 복수 존재할경우 모두 변경됨
UPDATE title_emps
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE
		emp_id = 100001
	AND end_at IS NULL
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
)
VALUES(
	100001
	,'T002'
	,DATE(NOW())
)
;


-- 8. 최저 연봉 사원의 사번과 이름, 연봉을 출력해 주세요.
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
ORDER BY salaries.salary
LIMIT 1
;
-- -> 최저 연봉이 동일한 사원이 있을 경우에도 한명만 출력됨
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
	,RANK() OVER(ORDER BY salaries.salary) rank_sal
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
WHERE
	rank_sal = 1
;
-- rank_sal 없는 column...
-- 출력하는 컬럼을 조건으로 넣을 수 없나?
SELECT
	employees.emp_id
	,employees.name
	,rank_table.salary
FROM employees
	JOIN (
		SELECT
			salaries.emp_id
			,salaries.salary
			,DENSE_RANK() OVER(ORDER BY salaries.salary) rank_sal
		FROM salaries
		WHERE 
			salaries.end_at IS NULL 
	) rank_table
		ON employees.emp_id = rank_table.emp_id
			AND rank_table.rank_sal = 1
;
-- rank() 사용하면 11345로 2등이 없어짐
-- dense_rank()로 수정

SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
			AND salaries.salary = (
				SELECT
					MIN(salary)
				FROM salaries
				WHERE
					end_at IS NULL 
			)
;
-- end_at is null은 두번 다 사용해야 함
-- -> 서브쿼리의 결과는 salary 값을 조회하는 것이므로,
-- -> 현재 기준으로 하려면 메인 쿼리문에도 end_at is null 필요


-- 9. 전체 사원의 평균 연봉을 출력해 주세요.
SELECT
	AVG(salary) avg_sal
FROM salaries
WHERE
	end_at IS NULL 
;

SELECT
	AVG(salaries.salary) avg_sal
FROM salaries
WHERE
	end_at IS NULL 
;

SELECT
	title_emps.title_code
	,AVG(salaries.salary)
FROM title_emps
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
GROUP BY title_emps.title_code
;




-- 10. 사번이 54321인 사원의 지금까지 평균 연봉을 출력해 주세요.
SELECT
	emp_id
	,AVG(salary) avg_sal
FROM salaries
WHERE
	emp_id = 54321
GROUP BY emp_id
;


-- 01 아래 구조의 테이블을 작성하는 SQL을 작성해 주세요.
CREATE TABLE users (
	userid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	,username VARCHAR(30) NOT NULL 
	,authflg CHAR(1) DEFAULT '0'
	,birthday DATE NOT NULL 
	,created_at DATETIME DEFAULT CURRENT_DATE
)
;
-- -> created_at의 data type이 datetime이기 때문에,
-- current_date가 아니라 current_timestamp 사용해야함
CREATE TABLE users (
	userid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	,username VARCHAR(30) NOT NULL 
	,authflg CHAR(1) DEFAULT '0'
	,birthday DATE NOT NULL 
	,created_at DATETIME DEFAULT CURRENT_TIMESTAMP()
)
;


-- 02 [01]에서 만든 테이블에 아래 데이터를 입력해 주세요.
INSERT INTO users (
	username
	,birthday
)
VALUES(
	'그린'
	,'2024-01-26'
)
;


-- 03 [02]에서 만든 레코드를 아래 데이터로 갱신해 주세요.
UPDATE users
SET
	username = '테스터'
	,authflg = '1'
	,birthday = '2007-03-01'
WHERE
		userid = 1
;


-- 04 [02]에서 만든 레코드를 삭제해 주세요.
DELETE FROM users
WHERE userid = 1
;


-- 05 [01]에서 만든 테이블에 아래 Column을 추가해 주세요.
ALTER TABLE users
ADD COLUMN addr VARCHAR(100) NOT NULL DEFAULT '-'
;


-- 06 [01]에서 만든 테이블을 삭제해 주세요.
DROP TABLE users;


-- 07 아래 테이블에서 유저명, 생일, 랭크명을 출력해 주세요.
SELECT
	users.username
	,users.birthday
	,rankmanagement.rankname
FROM users
	JOIN rankmanagement
		ON users.userid = rankmanagement.userid
;