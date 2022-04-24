<!doctype html>
<html>
    <head>
        <title>Pong</title>
        <script src="pong.js"></script>
		<meta name="viewport" content="width=320">
		<style>
			body, html {
				margin: 0px;
			}
		</style>
    </head>
    <body>
        <div id="pong-game"></div>
		<a href="../" style="background-color: #0080ff"><img src="back.png" /> Go back!</a>
        <script>
            new Pong('pong-game', window, document);
        </script>
    </body>
</html>