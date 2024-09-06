-- TRANSACTION 시작
START TRANSACTION;

-- insert
INSERT INTO employees(
	NAME, birth, gender, hire_at
)
VALUES(
	'미어캣', '2000-01-01', 'M', DATE(NOW())
); 

-- select
SELECT * FROM employees WHERE emp_id >= 100001;

-- rollback
ROLLBACK;

-- commit
COMMIT;