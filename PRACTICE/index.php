<?php
	// GET으로 넘겨 받은 year값이 있다면 넘겨 받은걸 year변수에 적용하고 없다면 현재 년도
	$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
	// GET으로 넘겨 받은 month값이 있다면 넘겨 받은걸 month변수에 적용하고 없다면 현재 월
	$month = isset($_GET['month']) ? $_GET['month'] : date('m');
?>

<?php echo "$year 년 $month 월" ?>
<!-- 현재가 1월이라 이전 달이 작년 12월인경우 -->
<?php if ($month == 1): ?>
	<!-- 작년 12월 -->
	<a href="/?year=<?php echo $year-1 ?>&month=12">이전 달</a>
<?php else: ?>
	<!-- 이번 년 이전 월 -->
	<a href="/?year=<?php echo $year ?>&month=<?php echo $month-1 ?>">이전 달</a>
<?php endif ?>

<!-- 현재가 12월이라 다음 달이 내년 1월인경우 -->
<?php if ($month == 12): ?>
	<!-- 내년 1월 -->
	<a href="/?year=<?php echo $year+1 ?>&month=1">다음 달</a>
<?php else: ?>
	<!-- 이번 년 다음 월 -->
	<a href="/?year=<?php echo $year ?>&month=<?php echo $month+1 ?>">다음 달</a>
<?php endif ?>

<?php
	$date = "$year-$month-01"; // 현재 날짜
	$time = strtotime($date); // 현재 날짜의 타임스탬프
	$start_week = date('w', $time); // 1. 시작 요일
	$total_day = date('t', $time); // 2. 현재 달의 총 날짜
	$total_week = ceil(($total_day + $start_week) / 7);  // 3. 현재 달의 총 주차
?>

<table style="background-color: yellow; border-radius: 20px; padding: 10px; border: 2px solid black;">
	<tr style="border: 2px solid black;"> 
		<th style="background-color: red; border: 2px solid black;">일</th> 
		<th>월</th> 
		<th>화</th> 
		<th>수</th> 
		<th>목</th> 
		<th>금</th> 
		<th>토</th> 
	</tr> 

	<!-- 총 주차를 반복합니다. -->
	<?php for ($n = 1, $i = 0; $i < $total_week; $i++): ?> 
		<tr> 
			<!-- 1일부터 7일 (한 주) -->
			<?php for ($k = 0; $k < 7; $k++): ?> 
				<td> 
					<!-- 시작 요일부터 마지막 날짜까지만 날짜를 보여주도록 -->
					<?php if ( ($n > 1 || $k >= $start_week) && ($total_day >= $n) ): ?>
						<!-- 현재 날짜를 보여주고 1씩 더해줌 -->
						<a href="/?<?php echo $year."-".$month."-".$n ?>"><?php echo $n++ ?><p><img src="./img/bear.png" alt="" width="50px" height="100px"></p></a>
					<?php endif ?>
				</td> 
			<?php endfor; ?> 
		</tr> 
	<?php endfor; ?> 
</table>