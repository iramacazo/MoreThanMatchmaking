<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href ='{{asset('css/getstarted.css')}}'>
		<link rel='icon' href='{{asset('css/images/logo.png')}}'>
		<title> Get Started | MTM </title>
		<script src ='{{asset('js/jquery-3.1.1.min.js')}}'> </script>
		<script src ='{{asset('js/getstarted.js')}}'> </script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
	
	<body>
		<nav id='header'>
			<a href="{{route('/mainpage')}}"><img src='{{asset('css/images/LogoWord.png')}}' height ='35px'></a>
            <a href="{{route('logout')}}" id="Logout" class="navText">Logout</a>
            <a href="#profile" id="username" class="navText">{{Auth::user()->username}}</a>
		</nav>
		
		<div id='heading'>
			<h1> Let's set up your profile! </h1>
		</div>
		
		<div class ='choose'>
			<img class ='logo' id = 'dota2' src='{{'css/images/dota2logo.png'}}'>
			<img class ='logo' id ='ow' src='{{'css/images/owlogo.png'}}'>
		</div>
		
		<div class ='dota pos'>
			<h1> What is your position / role ingame? </h1>
			<ul id='roles'>
				<li id='Carry'> <h2> Carry </h2> </li>
				<li id='Midlaner'> <h2> Midlaner </h2> </li>
				<li id='Offlaner'> <h2> Offlaner </h2> </li>
				<li id='Roaming Support'> <h2> Roaming Support</h2> </li>
				<li id='Hard Support'> <h2> Hard Support </h2> </li>
				<li id='Jungler'> <h2> Jungler </h2> </li>
			</ul>
		</div> 
		
		<div class ='overwatch step1'>
			<h1> What is your role ingame? </h1>
			<ul id='rolesOW'>
				<li id='Offense'> <h2> Offense </h2> </li>
				<li id='Defense'> <h2> Defense </h2> </li>
				<li id='Support'> <h2> Support </h2> </li>
				<li id='Tank'> <h2> Tank </h2> </li>
			</ul>
		</div>
		
		<div class ='dota heroes'>
			<h1> Who are your three main heroes? </h1>
			<select class='h1'>
				<option value='Abaddon'> Abaddon </option>
				<option value='Alchemist'>Alchemist </option>
				<option value='Ancient Apparition'> Ancient Apparition</option>
				<option value='Anti-Mage'>Anti-Mage </option>
				<option value='Arc Warden'> Arc Warden</option>
				<option value='Axe'> Axe </option>
				<option value='Bane'> Bane</option>
				<option value='Batrider'> Batrider</option>
				<option value='Beastmaster'> Beastmaster </option>
				<option value='Bloodseeker'> Bloodseeker</option>
				<option value='Bounty Hunter'> Bounty Hunter</option>
				<option value='Brewmaster'> Brewmaster </option>
				<option value='Bristleback'> Bristleback </option>
				<option value='Broodmother'> Broodmother</option>
				<option value='Centaur Warrunner'> Centaur Warrunner</option>
				<option value='Chaos Knight'> Chaos Knight</option>
				<option value='Chen'> Chen</option>
				<option value='Clinkz'> Clinkz </option>
				<option value='Clockwerk'> Clockwerk</option>
				<option value='Crystal Maiden'> Crystal Maiden</option>
				<option value='Dark Seer'>Dark Seer </option>
				<option value='Dazzle'> Dazzle</option>
				<option value='Death Prophet'> Death Prophet </option>
				<option value='Disruptor'> Disruptor</option>
				<option value='Doom'> Doom </option>
				<option value='Dragon Knight'> Dragon Knight</option>
				<option value='Drow Ranger'> Drow Ranger </option>
				<option value='Earth Spirit'> Earth Spirit</option>
				<option value='Earthshaker'> Earthshaker </option>
				<option value='Elder Titan'> Elder Titan </option>
				<option value='Ember Spirit'> Ember Spirit </option>
				<option value='Enchantress'> Enchantress</option>
				<option value='Enigma'> Enigma</option>
				<option value='Faceless Void'>Faceless Void </option>
				<option value='Gyrocopter'> Gyrocopter </option>
				<option value='Huskar'> Huskar</option>
				<option value='Invoker'> Invoker</option>
				<option value='Io'> Io </option>
				<option value='Jakiro'> Jakiro</option>
				<option value='Juggernaut'> Juggernaut</option>
				<option value='Keeper of the Light'> Keeper of the Light </option>
				<option value='Kunkka'> Kunkka</option>
				<option value='Legion Commander'> Legion Commander </option>
				<option value='Leshrac'> Leshrac</option>
				<option value='Lich'> Lich </option>
				<option value='Lifestealer'>Lifestealer </option>
				<option value='Lina'>Lion </option>
				<option value='Lone Druid'> Lone Druid</option>
				<option value='Luna'> Luna </option>
				<option value='Lycan'> Lycan</option>
				<option value='Magnus'> Magnus</option>
				<option value='Medusa'> Medusa</option>
				<option value='Meepo'> Meepo</option>
				<option value='Mirana'> Mirana</option>
				<option value='Monkey King'> Monkey King </option>
				<option value='Morphling'> Morphling</option>
				<option value='Naga Siren'> Naga Siren</option>
				<option value="Nature's Prophet"> Nature's Prophet</option>
				<option value='Necrophos'> Necrophos</option>
				<option value='Night Stalker'> Night Stalker</option>
				<option value='Nyx Assassin'>Nyx Assassin </option>
				<option value='Ogre Magi'> Ogre Magi</option>
				<option value='Omniknight'> Omniknight</option>
				<option value='Oracle'>Oracle </option>
				<option value='Outworld Devourer'>Outworld Devourer </option>
				<option value='Phantom Assassin'> Phantom Assassin</option>
				<option value='Phantom Lancer'>Phantom Lancer </option>
				<option value='Phoenix'>Phoenix </option>
				<option value='Puck'>Puck </option>
				<option value='Pudge'>Pudge </option>
				<option value='Pugna'>Pugna </option>
				<option value='Queen of Pain'>Queen of Pain </option>
				<option value='Razor'> Razor </option>
				<option value='Riki'> Riki </option>
				<option value='Rubick'> Rubick</option>
				<option value='Sand King'> Sand King</option>
				<option value='Shadow Demon'> Shadow Demon</option>
				<option value='Shadow Fiend'> Shadow Fiend</option>
				<option value='Shadow Shaman'> Shadow Shaman</option>
				<option value='Silencer'> Silencer</option>
				<option value='Skywrath Mage'>Skywrath Mage </option>
				<option value='Slardar'> Slardar</option>
				<option value='Slark'> Slark</option>
				<option value='Sniper'> Sniper</option>
				<option value='Spectre'> Spectre </option>
				<option value='Spirit Breaker'> Spirit Breaker </option>
				<option value='Storm Spirit'> Storm Spirit</option>
				<option value='Sven'>Sven </option>
				<option value='Techies'>Techies </option>
				<option value='Templar Assassin'>Templar Assassin </option>
				<option value='Terrorblade'>Terrorblade </option>
				<option value='Tidehunter'> Tidehunter</option>
				<option value='Timbersaw'> Timbersaw</option>
				<option value='Tinker'> Tinker</option>
				<option value='Tiny'>Tiny </option>
				<option value='Treant Protector'>Treant Protector </option>
				<option value='Troll Warlord'>Troll Warlord </option>
				<option value='Tusk'> Tusk</option>
				<option value='Underlord'>Underlord </option>
				<option value='Undying'> Undying</option>
				<option value='Ursa'> Ursa</option>
				<option value='Vengeful Spirit'>Vengeful Spirit </option>
				<option value='Venomancer'>Venomancer </option>
				<option value='Viper'>Viper </option>
				<option value='Visage'> Visage</option>
				<option value='Warlock'> Warlock</option>
				<option value='Weaver'>Weaver </option>
				<option value='Windranger'>Windranger </option>
				<option value='Winter Wyvern'> Winter Wyvern </option>
				<option value='Witch Doctor'>Witch Doctor </option>
				<option value='Wraith King'>Wraith King </option>
				<option value='Zeus'> Zeus</option>
			</select>
			
			<select class='h2'>
				<option value='Abaddon'> Abaddon </option>
				<option value='Alchemist'>Alchemist </option>
				<option value='Ancient Apparition'> Ancient Apparition</option>
				<option value='Anti-Mage'>Anti-Mage </option>
				<option value='Arc Warden'> Arc Warden</option>
				<option value='Axe'> Axe </option>
				<option value='Bane'> Bane</option>
				<option value='Batrider'> Batrider</option>
				<option value='Beastmaster'> Beastmaster </option>
				<option value='Bloodseeker'> Bloodseeker</option>
				<option value='Bounty Hunter'> Bounty Hunter</option>
				<option value='Brewmaster'> Brewmaster </option>
				<option value='Bristleback'> Bristleback </option>
				<option value='Broodmother'> Broodmother</option>
				<option value='Centaur Warrunner'> Centaur Warrunner</option>
				<option value='Chaos Knight'> Chaos Knight</option>
				<option value='Chen'> Chen</option>
				<option value='Clinkz'> Clinkz </option>
				<option value='Clockwerk'> Clockwerk</option>
				<option value='Crystal Maiden'> Crystal Maiden</option>
				<option value='Dark Seer'>Dark Seer </option>
				<option value='Dazzle'> Dazzle</option>
				<option value='Death Prophet'> Death Prophet </option>
				<option value='Disruptor'> Disruptor</option>
				<option value='Doom'> Doom </option>
				<option value='Dragon Knight'> Dragon Knight</option>
				<option value='Drow Ranger'> Drow Ranger </option>
				<option value='Earth Spirit'> Earth Spirit</option>
				<option value='Earthshaker'> Earthshaker </option>
				<option value='Elder Titan'> Elder Titan </option>
				<option value='Ember Spirit'> Ember Spirit </option>
				<option value='Enchantress'> Enchantress</option>
				<option value='Enigma'> Enigma</option>
				<option value='Faceless Void'>Faceless Void </option>
				<option value='Gyrocopter'> Gyrocopter </option>
				<option value='Huskar'> Huskar</option>
				<option value='Invoker'> Invoker</option>
				<option value='Io'> Io </option>
				<option value='Jakiro'> Jakiro</option>
				<option value='Juggernaut'> Juggernaut</option>
				<option value='Keeper of the Light'> Keeper of the Light </option>
				<option value='Kunkka'> Kunkka</option>
				<option value='Legion Commander'> Legion Commander </option>
				<option value='Leshrac'> Leshrac</option>
				<option value='Lich'> Lich </option>
				<option value='Lifestealer'>Lifestealer </option>
				<option value='Lina'>Lion </option>
				<option value='Lone Druid'> Lone Druid</option>
				<option value='Luna'> Luna </option>
				<option value='Lycan'> Lycan</option>
				<option value='Magnus'> Magnus</option>
				<option value='Medusa'> Medusa</option>
				<option value='Meepo'> Meepo</option>
				<option value='Mirana'> Mirana</option>
				<option value='Monkey King'> Monkey King </option>
				<option value='Morphling'> Morphling</option>
				<option value='Naga Siren'> Naga Siren</option>
				<option value="Nature's Prophet"> Nature's Prophet</option>
				<option value='Necrophos'> Necrophos</option>
				<option value='Night Stalker'> Night Stalker</option>
				<option value='Nyx Assassin'>Nyx Assassin </option>
				<option value='Ogre Magi'> Ogre Magi</option>
				<option value='Omniknight'> Omniknight</option>
				<option value='Oracle'>Oracle </option>
				<option value='Outworld Devourer'>Outworld Devourer </option>
				<option value='Phantom Assassin'> Phantom Assassin</option>
				<option value='Phantom Lancer'>Phantom Lancer </option>
				<option value='Phoenix'>Phoenix </option>
				<option value='Puck'>Puck </option>
				<option value='Pudge'>Pudge </option>
				<option value='Pugna'>Pugna </option>
				<option value='Queen of Pain'>Queen of Pain </option>
				<option value='Razor'> Razor </option>
				<option value='Riki'> Riki </option>
				<option value='Rubick'> Rubick</option>
				<option value='Sand King'> Sand King</option>
				<option value='Shadow Demon'> Shadow Demon</option>
				<option value='Shadow Fiend'> Shadow Fiend</option>
				<option value='Shadow Shaman'> Shadow Shaman</option>
				<option value='Silencer'> Silencer</option>
				<option value='Skywrath Mage'>Skywrath Mage </option>
				<option value='Slardar'> Slardar</option>
				<option value='Slark'> Slark</option>
				<option value='Sniper'> Sniper</option>
				<option value='Spectre'> Spectre </option>
				<option value='Spirit Breaker'> Spirit Breaker </option>
				<option value='Storm Spirit'> Storm Spirit</option>
				<option value='Sven'>Sven </option>
				<option value='Techies'>Techies </option>
				<option value='Templar Assassin'>Templar Assassin </option>
				<option value='Terrorblade'>Terrorblade </option>
				<option value='Tidehunter'> Tidehunter</option>
				<option value='Timbersaw'> Timbersaw</option>
				<option value='Tinker'> Tinker</option>
				<option value='Tiny'>Tiny </option>
				<option value='Treant Protector'>Treant Protector </option>
				<option value='Troll Warlord'>Troll Warlord </option>
				<option value='Tusk'> Tusk</option>
				<option value='Underlord'>Underlord </option>
				<option value='Undying'> Undying</option>
				<option value='Ursa'> Ursa</option>
				<option value='Vengeful Spirit'>Vengeful Spirit </option>
				<option value='Venomancer'>Venomancer </option>
				<option value='Viper'>Viper </option>
				<option value='Visage'> Visage</option>
				<option value='Warlock'> Warlock</option>
				<option value='Weaver'>Weaver </option>
				<option value='Windranger'>Windranger </option>
				<option value='Winter Wyvern'> Winter Wyvern </option>
				<option value='Witch Doctor'>Witch Doctor </option>
				<option value='Wraith King'>Wraith King </option>
				<option value='Zeus'> Zeus</option>
			</select>
			
			<select class='h3'>
				<option value='Abaddon'> Abaddon </option>
				<option value='Alchemist'>Alchemist </option>
				<option value='Ancient Apparition'> Ancient Apparition</option>
				<option value='Anti-Mage'>Anti-Mage </option>
				<option value='Arc Warden'> Arc Warden</option>
				<option value='Axe'> Axe </option>
				<option value='Bane'> Bane</option>
				<option value='Batrider'> Batrider</option>
				<option value='Beastmaster'> Beastmaster </option>
				<option value='Bloodseeker'> Bloodseeker</option>
				<option value='Bounty Hunter'> Bounty Hunter</option>
				<option value='Brewmaster'> Brewmaster </option>
				<option value='Bristleback'> Bristleback </option>
				<option value='Broodmother'> Broodmother</option>
				<option value='Centaur Warrunner'> Centaur Warrunner</option>
				<option value='Chaos Knight'> Chaos Knight</option>
				<option value='Chen'> Chen</option>
				<option value='Clinkz'> Clinkz </option>
				<option value='Clockwerk'> Clockwerk</option>
				<option value='Crystal Maiden'> Crystal Maiden</option>
				<option value='Dark Seer'>Dark Seer </option>
				<option value='Dazzle'> Dazzle</option>
				<option value='Death Prophet'> Death Prophet </option>
				<option value='Disruptor'> Disruptor</option>
				<option value='Doom'> Doom </option>
				<option value='Dragon Knight'> Dragon Knight</option>
				<option value='Drow Ranger'> Drow Ranger </option>
				<option value='Earth Spirit'> Earth Spirit</option>
				<option value='Earthshaker'> Earthshaker </option>
				<option value='Elder Titan'> Elder Titan </option>
				<option value='Ember Spirit'> Ember Spirit </option>
				<option value='Enchantress'> Enchantress</option>
				<option value='Enigma'> Enigma</option>
				<option value='Faceless Void'>Faceless Void </option>
				<option value='Gyrocopter'> Gyrocopter </option>
				<option value='Huskar'> Huskar</option>
				<option value='Invoker'> Invoker</option>
				<option value='Io'> Io </option>
				<option value='Jakiro'> Jakiro</option>
				<option value='Juggernaut'> Juggernaut</option>
				<option value='Keeper of the Light'> Keeper of the Light </option>
				<option value='Kunkka'> Kunkka</option>
				<option value='Legion Commander'> Legion Commander </option>
				<option value='Leshrac'> Leshrac</option>
				<option value='Lich'> Lich </option>
				<option value='Lifestealer'>Lifestealer </option>
				<option value='Lina'>Lion </option>
				<option value='Lone Druid'> Lone Druid</option>
				<option value='Luna'> Luna </option>
				<option value='Lycan'> Lycan</option>
				<option value='Magnus'> Magnus</option>
				<option value='Medusa'> Medusa</option>
				<option value='Meepo'> Meepo</option>
				<option value='Mirana'> Mirana</option>
				<option value='Monkey King'> Monkey King </option>
				<option value='Morphling'> Morphling</option>
				<option value='Naga Siren'> Naga Siren</option>
				<option value="Nature's Prophet"> Nature's Prophet</option>
				<option value='Necrophos'> Necrophos</option>
				<option value='Night Stalker'> Night Stalker</option>
				<option value='Nyx Assassin'>Nyx Assassin </option>
				<option value='Ogre Magi'> Ogre Magi</option>
				<option value='Omniknight'> Omniknight</option>
				<option value='Oracle'>Oracle </option>
				<option value='Outworld Devourer'>Outworld Devourer </option>
				<option value='Phantom Assassin'> Phantom Assassin</option>
				<option value='Phantom Lancer'>Phantom Lancer </option>
				<option value='Phoenix'>Phoenix </option>
				<option value='Puck'>Puck </option>
				<option value='Pudge'>Pudge </option>
				<option value='Pugna'>Pugna </option>
				<option value='Queen of Pain'>Queen of Pain </option>
				<option value='Razor'> Razor </option>
				<option value='Riki'> Riki </option>
				<option value='Rubick'> Rubick</option>
				<option value='Sand King'> Sand King</option>
				<option value='Shadow Demon'> Shadow Demon</option>
				<option value='Shadow Fiend'> Shadow Fiend</option>
				<option value='Shadow Shaman'> Shadow Shaman</option>
				<option value='Silencer'> Silencer</option>
				<option value='Skywrath Mage'>Skywrath Mage </option>
				<option value='Slardar'> Slardar</option>
				<option value='Slark'> Slark</option>
				<option value='Sniper'> Sniper</option>
				<option value='Spectre'> Spectre </option>
				<option value='Spirit Breaker'> Spirit Breaker </option>
				<option value='Storm Spirit'> Storm Spirit</option>
				<option value='Sven'>Sven </option>
				<option value='Techies'>Techies </option>
				<option value='Templar Assassin'>Templar Assassin </option>
				<option value='Terrorblade'>Terrorblade </option>
				<option value='Tidehunter'> Tidehunter</option>
				<option value='Timbersaw'> Timbersaw</option>
				<option value='Tinker'> Tinker</option>
				<option value='Tiny'>Tiny </option>
				<option value='Treant Protector'>Treant Protector </option>
				<option value='Troll Warlord'>Troll Warlord </option>
				<option value='Tusk'> Tusk</option>
				<option value='Underlord'>Underlord </option>
				<option value='Undying'> Undying</option>
				<option value='Ursa'> Ursa</option>
				<option value='Vengeful Spirit'>Vengeful Spirit </option>
				<option value='Venomancer'>Venomancer </option>
				<option value='Viper'>Viper </option>
				<option value='Visage'> Visage</option>
				<option value='Warlock'> Warlock</option>
				<option value='Weaver'>Weaver </option>
				<option value='Windranger'>Windranger </option>
				<option value='Winter Wyvern'> Winter Wyvern </option>
				<option value='Witch Doctor'>Witch Doctor </option>
				<option value='Wraith King'>Wraith King </option>
				<option value='Zeus'> Zeus</option>
			</select>
			<div class ='btn' id='forButton'>
				<input id ='btnHero' type='button' value ='Next'> 
			</div>
		</div>
		
		<div class ='overwatch heroesOW'>
			<h1> Who are your three main heroes? </h1>
			<select class='owh1'>
				<option value='Ana'>Ana</option>
				<option value='Bastion'>Bastion</option>
				<option value='D.Va'> D.Va</option>
				<option value='Genji'> Genji</option>
				<option value='Hanzo'> Hanzo</option>
				<option value='Junkrat'> Junkrat</option>
				<option value='Lucio'> Lucio</option>
				<option value='McCree'>McCree </option>
				<option value='Mei'> Mei</option>
				<option value='Mercy'>Mercy</option>
				<option value="Orisa">Orisa</option>
				<option value='Pharah'> Pharah</option>
				<option value='Reaper'> Reaper</option>
				<option value='Reindhardt'> Reinhardt</option>
				<option value='Roadhog'> Roadhog</option>
				<option value='Soldier'>Soldier: 76</option>
				<option value='Sombra'> Sombra</option>
				<option value='Symmetra'>Symmetra </option>
				<option value='Torbjorn'>Torbjorn </option>
				<option value='Tracer'>Tracer </option>
				<option value='Widowmaker'>Widowmaker </option>
				<option value='Winston'> Winston</option>
				<option value='Zarya'> Zarya</option>
				<option value='Zenyatta'> Zenyatta</option>
			</select>
			
			<select class='owh2'>
				<option value='Ana'>Ana</option>
				<option value='Bastion'>Bastion</option>
				<option value='D.Va'> D.Va</option>
				<option value='Genji'> Genji</option>
				<option value='Hanzo'> Hanzo</option>
				<option value='Junkrat'> Junkrat</option>
				<option value='Lucio'> Lucio</option>
				<option value='McCree'>McCree </option>
				<option value='Mei'> Mei</option>
				<option value='Mercy'>Mercy</option>
				<option value="Orisa">Orisa</option>
				<option value='Pharah'> Pharah</option>
				<option value='Reaper'> Reaper</option>
				<option value='Reindhardt'> Reinhardt</option>
				<option value='Roadhog'> Roadhog</option>
				<option value='Soldier'>Soldier: 76</option>
				<option value='Sombra'> Sombra</option>
				<option value='Symmetra'>Symmetra </option>
				<option value='Torbjorn'>Torbjorn </option>
				<option value='Tracer'>Tracer </option>
				<option value='Widowmaker'>Widowmaker </option>
				<option value='Winston'> Winston</option>
				<option value='Zarya'> Zarya</option>
				<option value='Zenyatta'> Zenyatta</option>
			</select>
			
			<select class='owh3'>
				<option value='Ana'>Ana</option>
				<option value='Bastion'>Bastion</option>
				<option value='D.Va'> D.Va</option>
				<option value='Genji'> Genji</option>
				<option value='Hanzo'> Hanzo</option>
				<option value='Junkrat'> Junkrat</option>
				<option value='Lucio'> Lucio</option>
				<option value='McCree'>McCree </option>
				<option value='Mei'> Mei</option>
				<option value='Mercy'>Mercy</option>
				<option value="Orisa">Orisa</option>d
				<option value='Pharah'> Pharah</option>
				<option value='Reaper'> Reaper</option>
				<option value='Reindhardt'> Reinhardt</option>
				<option value='Roadhog'> Roadhog</option>
				<option value='Soldier'>Soldier: 76</option>
				<option value='Sombra'> Sombra</option>
				<option value='Symmetra'>Symmetra </option>
				<option value='Torbjorn'>Torbjorn </option>
				<option value='Tracer'>Tracer </option>
				<option value='Widowmaker'>Widowmaker </option>
				<option value='Winston'> Winston</option>
				<option value='Zarya'> Zarya</option>
				<option value='Zenyatta'> Zenyatta</option>
			</select>
		
			<div class ='btn' id='forButtonOW'>
				<input id ='btnHeroOW' type='button' value ='Next'> 
			</div>
		</div>
		
		<div class= 'dota mmr'>
			<h1> What is your MMR Bracket?</h1>
			<select id='mmrfield'>
				<option value='0-999MMR'> 0 - 999 MMR</option>
				<option value='1000-1999MMR'> 1000 - 1999 MMR</option>
				<option value='2000-2999MMR'> 2000 - 2999 MMR</option>
				<option value='3000-3999MMR'> 3000 - 3999 MMR</option>
				<option value='4000-4999MMR'> 4000 - 4999 MMR</option>
				<option value='5000-5999MMR'> 5000 - 5999 MMR</option>
				<option value='6000-6999MMR'> 6000 - 6999 MMR</option>
				<option value='7000-7999MMR'> 7000 - 7999 MMR</option>
				<option value='8000-8999MMR'> 8000 - 8999 MMR</option>
				<option value='9000-9999MMR'> 9000 - 9999 MMR</option>
				<option value='Not yet applicable'> I have no MMR yet</option>
			</select>
			
			<div class ='btn' id='done'>
				<input id ='btnMMR' type='button' value ='Done'>
			</div>
		</div>
		
		<div class = 'overwatch ranktier'>
			<h1 id='nametier'> What is your Tier? </h1>
			
			<img value ='Bronze' class='bronze rating' src='{{'css/images/owtiers/bronze.png'}}'>
			<img value ='Silver' class='silver rating' src='{{'css/images/owtiers/silver.png'}}'>
			<img value ='Gold' class='gold rating' src='{{'css/images/owtiers/gold.png'}}'>
			<img value='Platinum' class='plat rating' src='{{'css/images/owtiers/plat.png'}}'>
			<img value='Diamond' class='diamond rating' src='{{'css/images/owtiers/diamond.png'}}'>
			<img value='Master' class='master rating' src='{{'css/images/owtiers/master.png'}}'>
			<img value='Grandmaster' class='grandmaster rating' src='{{'css/images/owtiers/gm.png'}}'>
			
			<input id='notier' type='button' value ='I do not play competitive matches'>
		</div>
		
		 <div id='finish'>
			<h1> Do you want to edit your profile for the other game? </h1>
			<input id='continue' type='button' value ='Yes'>
			 <a href="{{route('/mainpage')}}"><input id='proceed' type='button' value ='No' ></a>
		</div> 
		<div id='game'>
			<h1> default </h1>
		</div>
	</body>
</html>