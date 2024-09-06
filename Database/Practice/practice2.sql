-- 1. 직급테이블의 모든 정보를 조회해주세요.
SELECT *
FROM titles
;

-- 2. 급여가 60,000,000 이하인 사원의 사번을 조회해 주세요.
SELECT
	DISTINCT emp_id
FROM salaries
WHERE
		salary <= 60000000
;

-- 3. 급여가 60,000,000에서 70,000,000인 사원의 사번을 조회해 주세요.
SELECT
	emp_id
FROM salaries
WHERE
	salary BETWEEN 60000000 AND 70000000
;

-- 4. 사원번호가 10001, 10005인 사원의 사원테이블의 모든 정보를 조회해 주세요.
SELECT *
FROM employees
WHERE
	emp_id IN (10001, 10005)
;

-- 5. 직급에 '사'가 포함된 직급코드와 직급명을 조회해 주세요.
SELECT
	title_code
	,title
FROM titles
WHERE
	title LIKE '%사%'
;

-- 6. 사원 이름 오름차순으로 정렬해서 조회해 주세요.
SELECT NAME
FROM employees
ORDER BY NAME
;

-- 7. 사원별 전체 급여의 평균을 조회해 주세요.
SELECT
	emp_id
	,AVG(salary)
FROM salaries
GROUP BY emp_id
;

-- 8. 사원별 전체 급여의 평균이 30,000,000 ~ 50,000,000인, 사원번호와 평균급여를 조회해 주세요.
SELECT
	emp_id
	,AVG(salary) avg_sal
FROM salaries
GROUP BY emp_id
HAVING
	avg_sal BETWEEN 30000000 AND 50000000
;

-- 9. 사원별 전체 급여 평균이 70,000,000이상인, 사원의 사번, 이름, 성별을 조회해 주세요.
-- 서브쿼리
SELECT
	employees.emp_id
	,employees.name
	,employees.gender
FROM employees
WHERE employees.emp_id IN (
	SELECT
		salaries.emp_id
	FROM salaries
	GROUP BY salaries.emp_id
	HAVING AVG(salaries.salary) >= 70000000
)
;

-- join문
SELECT
	employees.emp_id
	,employees.name
	,employees.gender
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
GROUP BY salaries.emp_id
HAVING AVG(salaries.salary) >= 70000000
;

-- 10. 현재 직급이 'T005'인, 사원의 사원번호와 이름을 조회해 주세요. 
-- 서브쿼리
SELECT 
	employees.emp_id
	,employees.name
FROM employees
WHERE
	employees.emp_id IN (
		SELECT
			title_emps.emp_id
		FROM title_emps
		WHERE
				title_emps.title_code = 'T005'
			AND title_emps.end_at IS NULL 
	)
;

-- join문
SELECT
	employees.emp_id
	,employees.name 
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL 
			AND title_emps.title_code = 'T005'
;

-- --------------------------------------------------------------------

-- 1. 사원의 사원번호, 이름, 직급코드를 출력해 주세요.
SELECT
	employees.emp_id
	,employees.name
	,title_emps.title_code
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
		AND title_emps.end_at IS NULL 
;

-- 2. 사원의 사원번호, 성별, 현재 연봉을 출력해 주세요.
SELECT 
	employees.emp_id
	,employees.gender
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL 
;

-- 3. 10010 사원의 이름과 과거부터 현재까지 연봉 이력을 출력해 주세요.
SELECT
	employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND employees.emp_id = 10010
;

-- 4. 사원의 사원번호, 이름, 소속부서명을 출력해 주세요.
SELECT
	employees.emp_id
	,employees.name
	,departments.dept_name
FROM employees
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
			AND department_emps.end_at IS NULL 
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
;

-- 5. 현재 연봉의 상위 10위까지 사원의 사번, 이름, 연봉을 출력해 주세요.
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
ORDER BY salaries.salary DESC 
LIMIT 10
;

-- 6. 현재 각 부서의 부서장의 부서명, 이름, 입사일을 출력해 주세요.
SELECT
	departments.dept_name
	,employees.name
	,employees.hire_at
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
			AND department_managers.end_at IS NULL
	JOIN departments
		ON department_managers.dept_code = departments.dept_code
;

-- 7. 현재 직급이 "부장"인 사원들의 연봉 평균을 출력해 주세요.
SELECT
	titles.title
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
			AND title_emps.end_at IS NULL 
			AND titles.title = '부장'
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
GROUP BY titles.title
;

-- 8. 부서장직을 역임했던 모든 사원의 이름과 입사일, 사번, 부서번호를 출력해 주세요.
SELECT
	employees.name
	,employees.hire_at
	,employees.emp_id
	,department_managers.dept_code
FROM department_managers
	JOIN employees
		ON department_managers.emp_id = employees.emp_id
;

-- 9. 현재 각 직급별 평균연봉 중 60,000,000이상인 직급의 직급명, 평균연봉(정수)를을 내림차순으로 출력해 주세요.

-- 10. 성별이 여자인 사원들의 직급별 사원수를 출력해 주세요.