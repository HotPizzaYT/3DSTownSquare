<?php
include("../../../detect.php");
if($isDSi){
	header("Location: unsupported.php");
}
?>
<html>
	
	<head>
		<script>
		window.pos = {"x":0,"y":0};
		</script>
		<script src="script/main.js" type="text/javascript"></script>
		<script>
			window.system = "<?php echo detect_system(); ?>";
			
		</script>
		
		<style>
			body {
				margin: 0px;
				width: 320px;
				background-color: #fffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: 150px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: 240px;
			}
			th, td {
				width: 16px;
				height: 16px;
				outline: 1px solid #000;
				padding: 12px
			}
		</style>
		<title>Venmite Game</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="An MMORPG for the Nintendo 3DS!">

	</head>
	<body onkeyup="kup(event)" onkeydown="kdown(event)">
		<div id="contentbot">
			<div id="status" style="background-color: #e0e0e0">0:00 - Sunday [<a href="javascript:alert('not implemented'); void(0)">INVENTORY</a>]</div>
			<script></script>
			<div id="objtest_1" style="position:absolute;top:0px;left:0px;width:15px;height:15px;zindex:200;"><img src="test/r.png" id="test"></img></div>
		</div>
		<div id="inventory" style="display: none;">
		<div id="inventory">
			<table>
<thead>
  <tr>
    <th id="slot1"></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
</thead>
<thead>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</thead>
</table>
<br />
Life: 50/50
<br/>
Hunger: 100%
<br/>
<font color="lime">XP: 100
<br/>
LVL: 1
</font>
<!-- hotbar -->
<table>
<thead>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</thead>
</table>

		</div>
		
		<div id="confirm" style="display: none; position: absolute; top: 220; left: 0; width: 320; height: 200; background-color: #f0f0f0;">
		<center>What do you wish to do with this item?
		<br/>
		<button>Sell</button> <button>Drop</button> <button>Use</button>
		</center>
		
		</div>
	</body>
</html>