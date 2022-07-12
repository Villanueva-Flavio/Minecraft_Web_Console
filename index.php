<?php
$die = true;
//include a login for security purpose
$logFile = "/home/pozzard/Servidores_Minecraft/MC_1.18.1-Paper/logs/latest.log";
$interval = 1000;
$textColor = ""; //use CSS color
$index_debug = ["/INFO", "/WARN", "/ERROR", "/FATAL", "Thread RCON Client"];
// Thread RCON Client
if(isset($_GET['getLog'])){
    $file = file($logFile);
    foreach ($file as $string) {
        if(strpos($string, $index_debug[4]) == true){
			$string = '';
		}else if(strpos($string, $index_debug[0]) == true){
			echo "<p style='color: #10fa10;'>$string</p>";
        }else if (strpos($string, $index_debug[1]) == true){
			echo "<p style='color: #ff7f00;'>$string</p>";
        }else if (strpos($string, $index_debug[2]) == true){
			echo "<p style='color: #ff4040;'>$string</p>";
        }else if (strpos($string, $index_debug[3]) == true){
			echo "<p style='color: #ff0000;'>$string</p>";
        }else{
			echo "<p style='color: #ffffff;'>$string</p>";
        }
    }
}else{


?>
<!DOCTYPE html>
    <link rel="stylesheet" href="styles.css" />
	<title>Log</title>
    <script type="text/javascript" src="static/js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="static/js/script.js" ></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
	<script>
			setInterval(readLogFile, <?php echo $interval; ?>);
			window.onload = readLogFile; 
			var pathname = window.location.pathname;
			var scrollLock = true;
			
			$(document).ready(function(){
				$('.disableScrollLock').click(function(){
					$("html,body").clearQueue()
					$(".disableScrollLock").hide();
					$(".enableScrollLock").show();
					scrollLock = false;
				});
				$('.enableScrollLock').click(function(){
					$("html,body").clearQueue()
					$(".enableScrollLock").hide();
					$(".disableScrollLock").show();
					scrollLock = true;
				});
			});
			function readLogFile(){
				$.get(pathname, { getLog : "true" }, function(data) {
					data = data.replace(new RegExp("\n", "g"), "<br />");
					$("#log").html(data);
					if(scrollLock == true) { window.scrollTo(0, 99999); $('html,body').animate({scrollTop: $("#scrollLock").offset().top}, <?php echo $interval; ?>) };
				});
			}
		</script>
	<body>	
	<ul>
        <li><a href="https://bonzzard.com.ar">[Bonzzard]</a></li>
        <li><a href="#">[1.18.1] - Vanilla</a></li>
        <li><a href="#">[1.17.1] - Vanilla</a></li>
        <li><a href="#">[1.12.2] - Zombies</a></li>
        <li><a href="#">[1.12.2] - FWelder</a></li>
    </ul>
		<div id="log"></div>
		<div id="scrollLock"> <input class="disableScrollLock" type="button" value="🔒 Scrolling" /> <input class="enableScrollLock" style="display: none;" type="button" value="Scrolling" /></div>
			<div id="text-input">
				<span class="floating-label">></span>
				<input type="text" autocomplete="off" class="form-control" id="txtCommand" size="40" />
			</div>
	</body>
</html>		
<?php  }?>
