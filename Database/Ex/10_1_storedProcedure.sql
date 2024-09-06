-- 프로시저 생성

DELIMITER $$

CREATE PROCEDURE add_emp(
	IN param_name VARCHAR(50)
	,IN param_birth VARCHAR(10)
	,IN param_gender CHAR(1)
)
BEGIN 
	DECLARE cup INT DEFAULT 0;
	
	-- 사원테이블 입력
	INSERT INTO employees (
		name
		,birth
		,gender
		,hire_at
	)
	VALUES (
		param_name
		,param_birth
		,param_gender
		,DATE(NOW())
	);
	
	-- 방금 입력한 사원 번호 조회
	SELECT emp_id
	INTO @cup
	FROM employees
	ORDER BY emp_id DESC
	LIMIT 1
	;
	
	-- 급여테이블 데이터 작성
	INSERT INTO salaries (
		emp_id
		,salary
		,start_at
	)
	VALUES (
		@cup
		,25000000
		,DATE(NOW())
	);
	
END $$

DELIMITER ;

-- 프로시저 실행
CALL add_emp('고양이', '2000-01-01', 'M');

-- 프로시저 삭제
DROP PROCEDURE add_emp;