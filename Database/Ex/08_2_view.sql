-- 사원의 사번, 이름, 현재직급명, 현재소속부서명, 현재연봉 조회
SELECT
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary	
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL 
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
			AND department_emps.end_at IS NULL 
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
;


-- view 생성
CREATE VIEW view_emp_now_data
AS
SELECT
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary	
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL 
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
			AND department_emps.end_at IS NULL 
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
;

-- view 사용
SELECT * FROM view_emp_now_data;

-- view 삭제
DROP VIEW view_emp_now_data;