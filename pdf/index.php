<?php
include_once '../inc/site.php';

if($_GET['format'] == 1 || $_GET['format'] == 2 || $_GET['format'] == 3){
	
	$format = array('','bond_format_1.pdf', 'bond_format_2.pdf', 'bond_format_3.pdf');
	//echo $format['format'];
	//https://usortblog.com/php-html-pdf-mpdf-japanese/
	include("./lib/mpdf.php");
	$mpdf = new mPDF('ja','A4','8',"ipa");
	$mpdf->ignore_invalid_utf8 = true;// utf8指定
	$mpdf->SetImportUse();// PDFをインポートして下敷きとして使うための設定
	$pagecount = $mpdf->SetSourceFile($format[$_GET['format']]);// PDF読み込み
	$tplId = $mpdf->ImportPage(1);// 1ページ目をテンプレートとして指定
	$mpdf->SetPageTemplate($tplId);
	 
	$mpdf->WriteHTML('<div style="position:relative;">');
	 
	// 内容用のDIVテンプレート
	$tempDivl = '<div style="width:%spx;position:absolute;top:%spx;left:%spx;font-size:%s;white-space: nowrap;line-height:1.3rem;text-align:left;">%s</div>';
	$tempDivr = '<div style="width:%spx;position:absolute;top:%spx;left:%spx;font-size:%s;white-space: nowrap;line-height:1.3rem;text-align:right;">%s</div>';
	$tempDivc = '<div style="width:%spx;position:absolute;top:%spx;left:%spx;font-size:%s;white-space: nowrap;line-height:1.3rem;text-align:center;">%s</div>';
	

		

			if($_GET['id'] != 0){
				include_once ROOTDIR.'inc/sales.php';
				//print_r($http_response_header);
				$status_code = explode(' ', $http_response_header[0]);
				//print_r($status_code);
				if($status_code[1] != 200 ){
					$urllog = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$host = ROOT;
$errlog =<<<HTML
【{$host}】エラーログが送信されました。
以下のURLで問題が発生しています。

アクセスurl : 
{$urllog}
HTML;

					echo '<!doctype html><html><head><meta charset="UTF-8"><title>bois de gui | error</title></head><body>';
					echo '[ERROR] 指定のPDFが存在しません。<br>';
					echo '<form id="contact_confirm" action="'.ROOT.'inc/errlog/" method="post">
						<input type="hidden" name="errlog" value="'.$errlog.'">
						<input type="submit" value="エラーログを開発者に送信" name="submit">
					</form>';
					echo '<br><a href="'.ROOT.'pdf/?format=1&id=0">注文書・受領書</a><br><a href="'.ROOT.'pdf/?format=2&id=0">納品書</a><br>';
					echo '<a href="'.ROOT.'">サイトへ戻る</a></body></html>';
				}else{
					$ayear = date('Y',$rj1['sale']['accepted_mail_sent_date']);//受付年
					$amonth = date('n',$rj1['sale']['accepted_mail_sent_date']);//受付月
					$aday = date('j',$rj1['sale']['accepted_mail_sent_date']);//受付日
					$aweek = $w[date('w',$rj1['sale']['accepted_mail_sent_date'])];//受付曜日
					
					if(isset($rj1['sale']['delivered_mail_sent_date'])){
						$dmonth = date('n',$rj1['sale']['delivered_mail_sent_date']);//発送月
						$dday = date('j',$rj1['sale']['delivered_mail_sent_date']);//発送日
						$dweek = $w[date('w',$rj1['sale']['delivered_mail_sent_date'])];//発送曜日
					}
					
					$ddate = $rj1['sale']['sale_deliveries'][0]['preferred_date'];//配送希望日
					if(isset($ddate)){
						$ddatemonth = date('n',strtotime($ddate));//配送希望月
						$ddateday = date('j',strtotime($ddate));//配送希望日
						$ddateweek = $w[date('w',strtotime($ddate))];//配送希望曜日
					}
					$dtime = $rj1['sale']['sale_deliveries'][0]['preferred_period'];//配送希望時間帯
					
					$dpostal = $rj1['sale']['sale_deliveries'][0]['postal'];
					$daddress = $rj1['sale']['sale_deliveries'][0]['pref_name'].$rj1['sale']['sale_deliveries'][0]['address1'].$rj1['sale']['sale_deliveries'][0]['address2'];
					$daddress = mb_substr($daddress, 0, 34);
					$dfuri = $rj1['sale']['sale_deliveries'][0]['furigana'];
					$dfuri = mb_substr($dfuri, 0, 17);
					$dname = $rj1['sale']['sale_deliveries'][0]['name'];
					$dname = mb_substr($dname, 0, 26);
					$dtel = $rj1['sale']['sale_deliveries'][0]['tel'];
					
					$cpostal = $rj1['sale']['customer']['postal'];
					$caddress = $rj1['sale']['customer']['pref_name'].$rj1['sale']['customer']['address1'].$rj1['sale']['customer']['address2'];
					$caddress = mb_substr($caddress, 0, 34);
					$cfuri = $rj1['sale']['customer']['furigana'];
					$cfuri = mb_substr($cfuri, 0, 17);
					$cname = $rj1['sale']['customer']['name'];
					$cname = mb_substr($cname, 0, 26);
					$ctel = $rj1['sale']['customer']['tel'];
					$cmail = $rj1['sale']['customer']['mail'];
					
					$shoukei = number_format($rj1['sale']['product_total_price']);
					$souryou = number_format($rj1['sale']['delivery_total_charge']);
					$zei = number_format($rj1['sale']['tax']);
					$goukei = number_format($rj1['sale']['total_price']);
				};
		
			}else{// id = 0
				$dpostal = $_GET['zip_to'];
				$daddress = $_GET['addr_to'];
				$dfuri = $_GET['furigana_to'];
				$dname = $_GET['name_to'];
				$dtel = $_GET['tel_to'];
				
				$cpostal = $_GET['zip_from'];
				$caddress = $_GET['addr_from'];
				$cfuri = $_GET['furigana_from'];
				$cname = $_GET['name_from'];
				$ctel = $_GET['tel_from'];
				$cmail = $_GET['email'];
				
				$detail_comments = $_GET['detail_comments'];

			};
			
			if($_GET['format'] == 1){
				
				/*-----------------
				　注文書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 180, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 235, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 37, 303, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 37, 510, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 582, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 635, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 37, 700, '1.3rem', $aweek));//受付日(曜日)
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 132, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 149, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 170, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 193, 240, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 192, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 252, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 270, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 292, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 319, 240, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 300, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 322, 510, '1.2rem', $cmail));//メールアドレス
				if($_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 359, 530, '1.3rem', $shoukei.'円'));//小計
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 394, 530, '1.3rem', $souryou.'円'));//送料
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 428, 530, '1.3rem', $zei.'円'));//消費税
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 462, 530, '1.3rem', $goukei.'円'));//合計
					if($rj1['sale']['paid']){
						$mpdf->WriteHTML('<div style="width:20px;height:20px;border-radius:50%;position:absolute;top:373px;left:666px;border:2px solid #000;"></div>');//入金済み
					}else{
						$mpdf->WriteHTML('<div style="width:20px;height:20px;border-radius:50%;position:absolute;top:373px;left:699px;border:2px solid #000;"></div>');//未入金
					};
				};
				
				
				/*-----------------
				　受領書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 180, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 235, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 597, 303, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 597, 510, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 582, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 635, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 597, 700, '1.3rem', $aweek));//受付日(曜日)
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 692, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 709, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 730, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 752, 240, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 752, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 812, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 830, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 852, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 878, 240, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 860, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 881, 510, '1.2rem', $cmail));//メールアドレス
				
			}elseif($_GET['format'] == 2){
				
				/*-----------------
				　納品書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 46, 180, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 46, 235, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 46, 303, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 46, 510, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 46, 582, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 46, 635, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 46, 700, '1.3rem', $aweek));//受付日(曜日)
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 138, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 156, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 176, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 200, 240, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 199, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 258, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 277, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 298, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 326, 240, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 307, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 329, 510, '1.2rem', $cmail));//メールアドレス
			
		}elseif($_GET['format'] == 3){
				
				/*-----------------
				　注文書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 180, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 235, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 37, 303, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 37, 510, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 582, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 37, 635, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 37, 700, '1.3rem', $aweek));//受付日(曜日)
				};
				if(isset($ddate) && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 85, 180, '1.3rem', $ddatemonth));//配送希望日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 85, 235, '1.3rem', $ddateday));//配送希望日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 85, 303, '1.3rem', $ddateweek));//配送希望日(曜日)
				};
				if(isset($dtime)){
					$mpdf->WriteHTML(sprintf($tempDivl, 200, 85, 348, '1.3rem', $dtime));//配送希望時間帯
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 132, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 149, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 170, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 193, 240, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 192, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 252, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 270, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 292, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 319, 240, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 300, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 322, 510, '1.2rem', $cmail));//メールアドレス
				if($_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 359, 530, '1.3rem', $shoukei.'円'));//小計
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 394, 530, '1.3rem', $souryou.'円'));//送料
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 428, 530, '1.3rem', $zei.'円'));//消費税
					$mpdf->WriteHTML(sprintf($tempDivr, 85, 462, 530, '1.3rem', $goukei.'円'));//合計
					if($rj1['sale']['paid']){
						$mpdf->WriteHTML('<div style="width:20px;height:20px;border-radius:50%;position:absolute;top:373px;left:666px;border:2px solid #000;"></div>');//入金済み
					}else{
						$mpdf->WriteHTML('<div style="width:20px;height:20px;border-radius:50%;position:absolute;top:373px;left:699px;border:2px solid #000;"></div>');//未入金
					};
				};
				
				
				/*-----------------
				　受領書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 180, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 235, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 597, 303, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 597, 510, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 582, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 597, 635, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 597, 700, '1.3rem', $aweek));//受付日(曜日)
				};
				if(isset($ddate) && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 644, 180, '1.3rem', $ddatemonth));//配送希望日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 644, 235, '1.3rem', $ddateday));//配送希望日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 644, 303, '1.3rem', $ddateweek));//配送希望日(曜日)
				};
				
				if(isset($dtime)){
					$mpdf->WriteHTML(sprintf($tempDivl, 200, 644, 348, '1.3rem', $dtime));//配送希望時間帯
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 692, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 709, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 730, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 752, 240, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 752, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 812, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 830, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 852, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 878, 240, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 860, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 881, 510, '1.2rem', $cmail));//メールアドレス
			$mpdf->WriteHTML('</div>');
			$mpdf->ignore_invalid_utf8 = true;// utf8指定
			$mpdf->SetImportUse();// PDFをインポートして下敷きとして使うための設定
			$pagecount = $mpdf->SetSourceFile($format[$_GET['format']]);// PDF読み込み
			$tplId = $mpdf->ImportPage(2);// 1ページ目をテンプレートとして指定
			$mpdf->SetPageTemplate($tplId);
			$mpdf->AddPage();
			$mpdf->WriteHTML('<div style="position:relative;">');
				
				/*-----------------
				　納品書
				-----------------*/
				if($rj1['sale']['delivered'] && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 36, 178, '1.3rem', $dmonth));//発送日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 36, 233, '1.3rem', $dday));//発送日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 36, 298, '1.3rem', $dweek));//発送日(曜日)
				};
				if($rj1['sale']['accepted_mail_state'] == 'sent' && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 50, 36, 508, '1.3rem', $ayear));//受付日(年)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 36, 578, '1.3rem', $amonth));//受付日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 36, 630, '1.3rem', $aday));//受付日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 36, 694, '1.3rem', $aweek));//受付日(曜日)
				};
				if(isset($ddate) && $_GET['id'] != 0){
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 82, 178, '1.3rem', $ddatemonth));//配送希望日(月)
					$mpdf->WriteHTML(sprintf($tempDivr, 30, 82, 233, '1.3rem', $ddateday));//配送希望日(日)
					$mpdf->WriteHTML(sprintf($tempDivl, 30, 82, 298, '1.3rem', $ddateweek));//配送希望日(曜日)
				};
				
				if(isset($dtime)){
					$mpdf->WriteHTML(sprintf($tempDivl, 200, 82, 348, '1.3rem', $dtime));//配送希望時間帯
				};
				
				//配送先
				if(!empty($dpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 128, 255, '1.2rem', $dpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 146, 255, '1.3rem', $daddress));//住所
				if(!empty($dfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 166, 240, '1.1rem', $dfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 188, 236, '1.4rem', $dname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 189, 510, '1.3rem', $dtel));//電話番号
				
				
				//購入者
				if(!empty($cpostal)){
					$mpdf->WriteHTML(sprintf($tempDivl, 100, 248, 255, '1.2rem', $cpostal));//郵便番号
				};
				$mpdf->WriteHTML(sprintf($tempDivl, 500, 267, 255, '1.3rem', $caddress));//住所
				if(!empty($cfuri)){
					$mpdf->WriteHTML(sprintf($tempDivc, 200, 288, 240, '1.1rem', $cfuri));//ふりがな
				};
				$mpdf->WriteHTML(sprintf($tempDivc, 200, 313, 236, '1.4rem', $cname));//名前
				$mpdf->WriteHTML(sprintf($tempDivl, 200, 297, 510, '1.3rem', $ctel));//電話番号
				$mpdf->WriteHTML(sprintf($tempDivl, 160, 319, 510, '1.2rem', $cmail));//メールアドレス
		}
	
	$mpdf->WriteHTML('</div>');
	// PDFを出力
	$mpdf->Output(/*'sample.pdf', 'D'*/);

}else{//formatが1or2以外
$urllog = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$host = ROOT;
$errlog =<<<HTML
【{$host}】エラーログが送信されました。
以下のURLで問題が発生しています。

アクセスurl : 
{$urllog}
HTML;

	echo '<!doctype html><html><head><meta charset="UTF-8"><title>bois de gui | error</title></head><body>';
	echo '[ERROR] 指定のPDFが存在しません。<br>';
	echo '<form id="contact_confirm" action="'.ROOT.'inc/errlog/" method="post">
		<input type="hidden" name="errlog" value="'.$errlog.'">
		<input type="submit" value="エラーログを開発者に送信" name="submit">
	</form>';
	echo '<a href="'.ROOT.'">サイトへ戻る</a></body></html>';
};