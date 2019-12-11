<?php


//function bot($event) {

	//DBへの接続情報
	$dsn ='mysql:dbname=gomidahi;host=localhost;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock';
	$user = 'root';
	$password = 'root';
	$dbh = new PDO($dsn, $user, $password);
	$dbh -> query('SET NAMES utf8');


	//リクエストパラメータを取得し、発行するSQLに合わせて編集する。
	$date_thismonth = 'date'.date('m');
	$date_nextmonth = 'date'.date('m',strtotime(date('Y-m-1').' +1 month'));
	//$date_today = date('d');
	$date_today = 30;
	//sql文を発行し、該当するレコードを取得する。
	//insert文のprepare文を用意する。
	$sql = "select time, $date_thismonth, $date_nextmonth from gomidashi where name=?";
	$stmt = $dbh -> prepare($sql);
	$data[] = 'その他燃やさないごみ';

	$stmt -> execute($data);
	
	
	while(true) {
    	$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

    	if($rec == false) {
      		break;
    	}
		 $day_thismonth_div = explode(',', $rec["$date_thismonth"]);

		 //翌月の最初の該当日を取得し、デフォルト値に設定する。
		 $next = mb_substr($rec["$date_nextmonth"],0,mb_strpos($rec["$date_nextmonth"], ','));

		 //echo $firstday_nextmonth;
		 foreach($day_thismonth_div as $day){

		 	switch($day) {

		 		case $date_today <= $day:

		 			$next = $day;
		 			break 2;

		 		case $date_today >= $day:

		 			//ただのcoutinueではswitch文の頭に戻るだけなので、continue 2としてやらないとforeachの次にいかない。
		 			continue 2;
		 	}
	 	
		 }

	}
	
	//レスポンスの生成
	$text = '次のXXXXXは';
	$text.="\n\n";
	$text.=$next;
	$text.="です。"
	
	// reply($event, $text);

//}


?>