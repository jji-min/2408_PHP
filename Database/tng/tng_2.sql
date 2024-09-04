-- 1. 사원의 사원번호, 이름, 직급코드를 출력해 주세요.
SELECT
	emp.emp_id
	,emp.name
	,title.title_code
FROM employees emp
	JOIN title_emps title
	ON emp.emp_id = title.emp_id
WHERE title.end_at IS NULL 
;
SELECT
	employees.emp_id
	,employees.name
	,title_emps.title_code
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
		AND title_emps.end_at IS NULL
;
-- inner join 일 때는 on절에 적으나 where 절에 적으나 속도 차이 없지만,
-- left join 등을 할때는 차이날 수 있음
-- on절에 적는것이 적절함


-- 2. 사원의 사원번호, 성별, 현재 연봉을 출력해 주세요.
SELECT
	emp.emp_id
	,emp.gender
	,sal.salary
FROM employees emp
	JOIN salaries sal
	ON emp.emp_id = sal.emp_id
WHERE
	sal.end_at IS NULL
;

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
	emp.name
	,sal.salary
FROM salaries sal
	LEFT JOIN employees emp
	ON sal.emp_id = emp.emp_id
WHERE
	emp.emp_id = 10010
;

SELECT
	emp.name
	,sal.salary
FROM salaries sal
	JOIN employees emp
	ON sal.emp_id = emp.emp_id
WHERE
	emp.emp_id = 10010
;

SELECT
	employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.emp_id = 10010
;
SELECT
	employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND employees.emp_id = 10010
;
-- salaries나 employees에서 emp_id 어디서 가져오든 상관없음.


-- 4. 사원의 사원번호, 이름, 소속부서명을 출력해 주세요.
SELECT
	emp.emp_id
	,emp.NAME
	,departments.dept_name
FROM employees emp
	JOIN department_emps dep
		ON emp.emp_id = dep.emp_id
	JOIN departments
		ON dep.dept_code = departments.dept_code
WHERE
	dep.end_at IS NULL 
;

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


-- 5. 현재 월급의 상위 10위까지 사원의 사번, 이름, 연봉을 출력해 주세요.
SELECT
	employees.emp_id
	,employees.name 
	,salaries.salary
FROM employees
	JOIN salaries
	ON employees.emp_id = salaries.emp_id
WHERE salaries.end_at IS NULL
ORDER BY salaries.salary DESC 
LIMIT 10
;

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
-- 순위까지 보려면 rank 사용
-- 정렬을 이미했기 때문에 order by 절 생략해도 됨
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
	,RANK() OVER(ORDER BY salaries.salary DESC) rank
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL 
LIMIT 10
;


-- 6. 현재 각 부서의 부서장의 부서명, 이름, 입사일을 출력해 주세요.
SELECT
	departments.dept_name
	,employees.name
	,employees.hire_at
FROM department_managers
	JOIN departments
		ON department_managers.dept_code = departments.dept_code
	JOIN employees
		ON department_managers.emp_id = employees.emp_id
WHERE 
	department_managers.end_at IS NULL 
;

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
	employees.emp_id
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN employees
		ON title_emps.emp_id = employees.emp_id
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
WHERE
		title_emps.end_at IS NULL 
	AND title_emps.title_code = 'T005'
GROUP BY
	employees.emp_id
;

SELECT
	AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
WHERE
		title_emps.end_at IS NULL 
	AND titles.title = '부장'
;

-- 표준 문법 맞춰서 집계함수 쓰려면 group by 해줘야함
SELECT
	titles.title
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
WHERE
		title_emps.end_at IS NULL 
	AND titles.title = '부장'
GROUP BY titles.title
;
-- 현재 연봉으로 평균을 구하려면 salaries.end_at is null 넣어야함.
SELECT
	titles.title
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
WHERE
		title_emps.end_at IS NULL 
	AND salaries.end_at IS NULL 
	AND titles.title = '부장'
GROUP BY titles.title
;

SELECT
	titles.title
	,AVG(salaries.salary) AS avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
			AND titles.title = '부장'
			AND title_emps.end_at IS NULL 
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
GROUP BY titles.title
;
-- 현재 각 부장별 이름, 연봉평균
-- join문과 서브쿼리 활용
-- 서브쿼리를 작성하여 테이블을 만드는 것이기 때문에 컬럼 수 상관없음
SELECT
	employees.emp_id
	,employees.name
	,avg_table.avg_sal
FROM employees
	JOIN(
		SELECT 
			title_emps.emp_id
			,AVG(salaries.salary) avg_sal
		FROM title_emps
			JOIN titles
				ON title_emps.title_code = titles.title_code
				AND titles.title = '부장'
				AND title_emps.end_at IS NULL 
			JOIN salaries
				ON title_emps.emp_id = salaries.emp_id
		GROUP BY title_emps.emp_id
	) avg_table
		ON employees.emp_id = avg_table.emp_id
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

SELECT
	employees.name
	,employees.hire_at
	,employees.emp_id
	,department_managers.dept_code
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
;


-- 9. 현재 각 직급별 평균연봉 중 60,000,000이상인
-- 직급의 직급명, 평균연봉(정수)를을 평균연봉 내림차순으로 출력해 주세요.
SELECT
	titles.title
	,truncate(AVG(salaries.salary), 0) avg_sal
FROM title_emps
	JOIN employees
	ON title_emps.emp_id = employees.emp_id
	JOIN salaries
	ON employees.emp_id = salaries.emp_id
	JOIN titles
	ON title_emps.title_code = titles.title_code
GROUP BY title_emps.title_code
HAVING avg_sal >= 60000000
;
SELECT
	title_emps.title_code
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN employees
	ON title_emps.emp_id = employees.emp_id
	JOIN salaries
	ON employees.emp_id = salaries.emp_id
WHERE
	title_emps.end_at IS NULL 
GROUP BY title_emps.title_code
;

SELECT
	titles.title
	,CEILING(AVG(salaries.salary)) AS avg_sal
FROM salaries
	JOIN title_emps
		ON salaries.emp_id = title_emps.emp_id
			AND salaries.end_at IS NULL 
			AND title_emps.end_at IS NULL 
	JOIN titles
		ON title_emps.title_code = titles.title_code
GROUP BY titles.title
	HAVING avg_sal >= 60000000
ORDER BY avg_sal DESC 
;


-- 10. 성별이 여자인 사원들의 직급별 사원수를 출력해 주세요.
SELECT
	title_emps.title_code
	,COUNT(employees.emp_id)
FROM employees
	JOIN title_emps
	ON employees.emp_id = title_emps.emp_id
WHERE
	employees.gender = 'F'
GROUP BY
	title_emps.title_code
;
-- 현재 사원 기준으로 하기 위해서는 title_emps.end_at is null 넣어야 함
SELECT
	title_emps.title_code
	,COUNT(employees.emp_id)
FROM employees
	JOIN title_emps
	ON employees.emp_id = title_emps.emp_id
WHERE
		title_emps.end_at IS NULL 
	AND employees.gender = 'F'
GROUP BY
	title_emps.title_code
;

SELECT
	title_emps.title_code
	,COUNT(*) AS cnt
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL 
			AND employees.fire_at IS NULL 
			AND employees.gender = 'F'
GROUP BY title_emps.title_code
;
-- count(employees.*)는 불가능, count(*)는 가능 -> 조인해서 새로 만든 테이블의 모든 것 조회가능