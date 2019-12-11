<?php

require_once("./phpQuery-onefile.php");

//登録するDBに関する情報。
//$dsn ='mysql:dbname=gomidashi;host=localhost;';

//MACの時はUNIXドメインソケットを渡さんといかんらしい
$dsn ='mysql:dbname=gLAA0994264-nagatatetsu;host=mysql133.phy.lolipop.lan'
$user = 'LAA0994264';
$password = 'Zaq12wsx';
$dbh = new PDO($dsn, $user, $password);
$dbh -> query('SET NAMES utf8');

//DBを一旦クリアする。
//ここにtruncate処理を記載する
$dbh -> exec('truncate table gomidashi');


//insert文のprepare文を用意する。
$sql = 'insert into gomidashi(name,time,date4,date5,date6,date7,date8,date9,date10,date11,date12,date1,date2,date3,biko) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$stmt = $dbh -> prepare($sql);

//置換ワードを定義
$search = array('/.*月/','/日/','/・/');
$replace = array('','',',');

//htmlからスクレピングしてくる処理
$html = file_get_contents("http://www.city.ashiya.lg.jp/kankyoushori/calendar/31we.html");
$doc = phpQuery::newDocument($html);

//echo count($doc["tbody"]["tr:contains('新聞紙・紙パック')"]); //4
//echo $doc["tbody"]["tr:contains('新聞紙・紙パック')"];

//echo count($doc["tbody"]["tr:contains('新聞紙・紙パック')"]["td"]);

$lists = ["燃やすごみ","雑誌・チラシ等","新聞紙・紙パック","段ボール","ペットボトル","カン","ビン","その他燃やさないごみ"];

// foreach($lists as $idx => $target){

// 	print($idx);
// 	print($target);
// }

foreach($lists as $idx => $target){

	if($target == "燃やすごみ"){

		//燃やすゴミの処理。毎週なのでこいつ単独で処理をする。毎月に同じ値を入れる。

		//項目名を取得
		//変数の中に別の変数を組み込みたい時のいい例が以下。""を使った変数展開を利用する。
		${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(0)"]["td:eq(0)"]->text());

		//ゴミ出し時間帯を取得。（比較をしないので文字列で取得）
		${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(0)"]["td:eq(1)"]->text());

		//ゴミ出し日を取得
		for($i = 0; $i < 12; $i++) {

			${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(0)"]["td:eq(2)"]->text());		
		}

		//備考
		${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(1)"]["td:eq(2)"]["p"]->text());

		//print_r(${"dateList_"."$idx"});
		
		$stmt -> execute(${"dateList_"."$idx"});

	} elseif ($target == "ペットボトル") {

		//ペットボトルの時の処理
		//午前の部、午後の部の２つが上期・下期でそれぞれ２つずつの計４つ存在する。(indexだと0と2が午前、1と3が午後)
		//ペットボトルについては、ペットボトル（午前）、ペットボトル（午後）という形でそれぞれレコードを作る。

		$dateListCount_am = 0;
		$dateListCount_pm = 0;

		for($i = 0; $i < count($doc["tbody"]["tr:contains($target)"]); $i++){

			$timeofday = "";

			//午前の場合
			if ($i == 0 || $i == 2) {

				$timeofday = "am";

				${"dateList_"."$idx"."_"."$timeofday"}[0] = "ペットボトル（午前）";
				${"dateList_"."$idx"."_"."$timeofday"}[1] = trim($doc["tbody"]["tr:contains($target):eq($i)"]["td:eq(1)"]->text());

			//午後の場合
			} elseif ($i == 1 || $i == 3){

				$timeofday = "pm";

				${"dateList_"."$idx"."_"."$timeofday"}[0] = "ペットボトル（午後）";
				${"dateList_"."$idx"."_"."$timeofday"}[1] = trim($doc["tbody"]["tr:contains($target):eq($i)"]["td:eq(1)"]->text());

			} else {

			}

			for($k = 2; $k < count($doc["tbody"]["tr:contains($target):eq($i)"]["td"]); $k++) {

					//${"dateList_"."$idx"."_"."$timeofday"}[${"dateListCount_$timeofday"}] = trim($doc["tbody"]["tr:contains($target):eq($i)"]["td:eq($k)"]->text());

					${"dateList_"."$idx"."_"."$timeofday"}[] = preg_replace($search,$replace,trim($doc["tbody"]["tr:contains($target):eq($i)"]["td:eq($k)"]->text()));

					//午前、午後に応じたカウントをインクリメントする。
					${"dateListCount_$timeofday"}++;

			}
			//備考
			//${"dateList_"."$idx"."_"."$timeofday"}[14] = "";

		}
		${"dateList_"."$idx"."_"."am"}[] = "";
		${"dateList_"."$idx"."_"."pm"}[] = "";

		$stmt -> execute(${"dateList_"."$idx"."_"."am"});
		$stmt -> execute(${"dateList_"."$idx"."_"."pm"});
		
		//echo print_r(${"dateList_"."$idx"."_"."am"});

	} else {

		//項目名を取得
		${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(0)"]["td:eq(0)"]->text());

		//ゴミ出し時間帯を取得。（比較をしないので文字列で取得）
		${"dateList_"."$idx"}[] = trim($doc["tbody"]["tr:contains($target):eq(0)"]["td:eq(1)"]->text());

		$dateListCount = 0;

		for ($i = 0; $i < count($doc["tbody"]["tr:contains($target)"]); $i++){

			for($k = 2; $k < count($doc["tbody"]["tr:contains($target):eq($i)"]["td"]); $k++) {

				//ゴミ出し日を取得
				${"dateList_"."$idx"}[] = preg_replace($search,$replace,trim($doc["tbody"]["tr:contains($target):eq($i)"]["td:eq($k)"]->text()));

				$dateListCount++;
			}
		}
		//備考
		${"dateList_"."$idx"}[] = "";
		//print_r(${"dateList_"."$idx"});
		$stmt -> execute(${"dateList_"."$idx"});

	}
	$dbh = null;	
}

?>