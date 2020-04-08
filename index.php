<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>連接埠 掃描</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	  <link rel="shortcut icon" href="../web.ico">
	  <link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<div id="wrapper">
				<section id="intro" class="main" >
          <form method="post" action='#'>
            <h3>網址/IP：</h3>
            <br>
            <br>
            <input type="text" name="ip" value="<?php echo $pos_ip;?>">
            <br>
            <button>&nbsp掃描&nbsp</button>
          </form>
          <?   //判斷使用者是否有輸入 
            if(!isset($_POST['ip'])){
                exit;  
              }
          ?>
          <div style="height:350px;overflow:auto;">
          <table>
            <thead>
               <tr>
                 <td>ID</td>
                 <td>埠號(PORT)</td>
                 <td>服務名稱</td>
                 <td>服務狀態</td>
               </tr>
             </thead>
             <tbody>
              <?php
                  $ip = $_POST['ip'] ?? '127.0.0.1';
                  if(ip2long($ip)){
                    $aIp = explode('.', $ip);
                    foreach ($aIp as $key => $value) {
                      if($value < 0 || $value > 255){
                        die('IP錯誤');
                      }
                    }
                  }
                  $port = array(21,23,25,79,80,110,135,137,138,139,143,443,445,1433,3306);
                  $msg = array('Ftp','Telnet','Smtp','Finger','Http','Pop3','Location Service','Netbios-NS','Netbios-DGM','Netbios-SSN','IMAP','Https','Microsoft-DS','SQL','SQL');
                  foreach ($port as $key => $value) {
                    echo '<tr>';
                    echo '<td>' . $key . '</td>';
                    echo '<td>' . $value . '</td>';
                    echo '<td>' . $msg[$key] . '</td>';
                    $fp = @fsockopen($ip, $value, $errno, $errstr, 1);
                    $result = $fp ? '<span style="color:green;">開啟</span>' : '<span style="color:red;">關閉</span>';
                    echo '<td>' . $result . '</td>';
                    echo '</tr>';
                  }
              ?>
             </tbody>
          </table>
	     </body>
    </html>
