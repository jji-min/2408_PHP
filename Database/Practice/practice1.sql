-- 100000번 사원의 연봉을 4000만원으로 변경해주세요.

-- 종료일자 먼저 갱신
UPDATE salaries
SET end_at = DATE(NOW())
WHERE
		emp_id = 100000
	AND end_at IS NULL
;

-- 새로운 레코드 추가
INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
VALUES (
	100000
	,40000000
	,DATE(NOW())
)
;

-- 수정날짜도 바꿔줌
UPDATE salaries
SET
	updated_at = NOW()
WHERE
		emp_id = 100000
	AND end_at = DATE(NOW())
;

-- 확인
SELECT *
FROM salaries
WHERE
	emp_id = 100000
;


-- ---------------------
-- 특정 레코드를 식별하려면 PK를 사용하는것이 가장 확실함
UPDATE salaries
SET
	updated_at = NOW()
	,end_at = DATE(NOW())
WHERE sal_id = 990339;

-- 기본값 설정되어 있는 건 제외
INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
VALUES (
	100000
	,40000000
	,DATE(NOW())
)
;

-- 최신 100000번의 연봉 조회
-- start_at이 제일 큰게 가장 최신이므로 start_at 기준
-- 가장 최신 내역 한개만 조회하려면 limit 1
SELECT *
FROM salaries
WHERE emp_id = 100000
ORDER BY start_at DESC
LIMIT 1;

-- 자동으로 최신 내역을 찾아서 갱신
UPDATE salaries
SET
	updated_at = NOW()
	,end_at = DATE(NOW())
WHERE
	sal_id = (
		SELECT sal_id
		FROM salaries
		WHERE emp_id = 100000
		ORDER BY start_at DESC
		LIMIT 1
	)
;