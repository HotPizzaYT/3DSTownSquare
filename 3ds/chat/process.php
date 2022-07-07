<?php
error_reporting(E_ALL);
	function process($txt){
		$arr = explode("\n", file_get_contents("badwords.txt"));

		foreach ($arr as $word)
		{
			$txt = str_replace("\r", "\n", $txt);
			$txt = str_ireplace($word, "****", $txt);
		}
		$txt = htmlspecialchars($txt);
		$txt = str_replace(":haxor:", "<img src='i/haxor.png' alt='haxor' />", $txt);
		$plazaEmotes = array(
		":)" => "<img alt='happy' src='i/happy.gif' />",
		":D" => "<img alt='grin' src='i/icon_cheesygrin.gif' />",
		";)" => "<img alt='wink' src='i/icon_wink.gif' />",
		";(" => "<img alt='cry' src='i/icon_cry.gif' />",
		":con:" => "<img alt='confused' src='i/icon_confused.gif' />",
		":@"  => "<img alt='mad' src='i/icon_mad.gif' />",
		":grr:" => "<img alt='annoyed' src='i/buy_sweat.gif' />",
		"XD"  => "<img alt='ecksdee' src='i/ecksdee.png' />",
		"xD"  => "<img alt='ecksdee' src='i/ecksdee.png' />",
		":omg:" => "<img alt='omg' src='i/icon_amazed.gif' />",
		":fp:" => "<img alt='facepalm' src='i/icon_facepalm.gif' />",
		":thinking:" => "<img alt='thinking' src='i/thinking.png' />",
		":eyes:" => "<img alt='eyes' src='i/eyes.png' />",
		"R(" => "<img alt = 'negitiveepicface' src='i/icon_unknown1.png' />",
		"RB:" => "<img alt='rainbowepicface' src='i/rbow.png' />",
		"R:" => "<img alt='epicface' src='i/epic.png' />",
		":ponything:" => "<img alt='ponything' src='i/icon_ponything.png' />",
		":waah:" => "<img alt='waah' src='i/waah.gif' />",
		":nuu:" => "<img alt='nuu' src='i/nuu.gif' />",
		":caps:" => "<img alt='caps' src='i/caps.gif' />",
		":lenny:" => "( ͡° ͜ʖ ͡°)",
		":shrug:" => "¯\_(ツ)_/¯",
		":megusta:" => "<img alt='megusta' src='i/icon_megusta.png' />",
		":lol:" => "<img alt='lol' src='i/lol.png' />",
		":troll:" => "<img alt='troll' src='i/icon_trollface.png' />",
		":no:" => "<img alt='no' src='i/no.png' />",
		":pface:" => "<img alt='pokerface' src='i/pokerface.png' />",
		":raeg:" => "<img alt='raeg' src='i/raeg.png' />",
		":ohplz:" => "<img alt='ohplz' src='i/please.png' />",
		":ydsay:" => "<img alt='ydsay' src='i/buy_youdontsay.png' />",
		":falone:" => "<img alt='falone' src='i/icon_foreveralone.png' />",
		":doge:" => "<img alt='<DOGE (not the currency)>' src='i/doge.png' />",
		":trig:" => "<img alt='triggered' src='i/triggered.jpg' />",
		":wolfthing:" => "<img alt='<•o•>' src='i/wolfthing.gif' />",
		":mccreeper:" => "<img alt='mccreeper' src='i/icon_mccreeper.png' />",
		":mchappy:" => "<img alt='mchappy' src='i/icon_mchappy.png' />",
		":sonic:" => "<img alt='sonic' src='i/buy_sonic.png' />",
		":yoshi:" => "<img alt='yoshi src='i/buy_yoshi.png' />",
		":mario:" => "<img alt='mario' src='i/icon_mario.png' />",
		":luigi:" => "<img alt='luigi' src='i/icon_luigi.png' />",
		":weegee:" => "<img alt='weegee' src='i/weegee.png' />",
		":pokeball:" => "<img alt='pokeball' src='i/buy_pokeball.jpg' />",
		":ds:" => "<img alt='ds' src='i/icon_ds.gif' />",
		":baby:" => "<img alt='baby' src='i/icon_baby.png' />",
		":bheart:" => "<img alt='heart' src='i/icon_bheart.gif' />",
		":taco:" => "<img alt='taco' src='i/icon_taco.gif' />",
		":burger:" => "<img alt='burger' src='i/icon_burger.gif' />",
		":icecream:" => "<img alt='icecream' src='i/icon_icecream.gif' />",
		":cake:" => "<img alt='cake' src='i/icon_cake.gif' />",
		":file:" => "<img alt='file' src='i/icon_file.png' />",
		":rec:" => "<img alt='RECOMMENDED' src='i/icon_recommended.png' />",
		":stb:" => "<img alt='STABLE' src='i/icon_stable.png' />",
		":uns:" => "<img alt='UNSTABLE' src='i/icon_unstable.png' />",
		":pre:" => "<img alt='pre' src='i/icon_prerelease.png' />",
		":0)" => "<img alt='clown' src='i/clown.png' />",
		":O)" => "<img alt='clown' src='i/clown.png' />",
		":o)" => "<img alt='clown' src='i/clown.png' />",
		":ht:" => "<img alt='Honey Troll' src='i/honey_troll.png' />"
		
		);

		$ef = array_keys($plazaEmotes);
		$er = array_values($plazaEmotes);

		$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
		$txt = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $txt);
		$txt = str_replace($ef, $er, $txt);
		return $txt;
	}
	?>
