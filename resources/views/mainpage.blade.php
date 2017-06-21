<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href ='{{asset('css/mainpage.css')}}'>
		<title> Main Page </title>
		<link rel='icon' href='{{asset('css/images/logo.png')}}'>
		<script src ='{{asset('js/jquery-3.1.1.min.js')}}'></script>
		<script src ='{{asset('js/mainpage.js')}}'></script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<ul id="navi">
			<li><a href="{{route('/mainpage')}}"><img src="{{asset('css/images/LogoWord.png')}}" height="35px"></a></li>
			<li><a href="{{route('logout')}}" id="logout">Logout</a></li>
			<li><a id="username" class="checkProfile">{{Auth::user()->username}}</a></li>
			<li><button id="navSearch">Search</button></li>
			<meta name="csrf-token" content="{{ csrf_token() }}">
		</ul>

		<div class="everything">
		<div id="container">
			<div id="rightside">
				<div id="postaPost">
					<div id="postTitle">
					<p>What's on your mind?</p>
					</div>
					<form>
					<div id="postInput">
					<textarea id="whatpost" placeholder="Tell me what you're thinking..."></textarea>
					</div>
					<div id="postSubmit">
					<input type="button" value="Post">
					</div>
					</form>
				</div>
                <div id="postSpace">
                </div>
				<h1 id="nothing"> No more posts </h1>
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('#postSubmit').click(function()
                    {
                        var loggedInUser = $('#username').html();
                        var content = document.getElementById("whatpost").value;
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: '/createpost',
                                data:{
                                    username: loggedInUser,
                                    body: content
                                },
                                success: function(data)
                                {
                                    $('#postSpace').prepend(data);
                                    document.getElementById("whatpost").value = "";
                                }
                            }
                        );
                    });
                </script>


			<div id="leftside">
				<div id="teams">
					<div id="leftTitle">
						<p>TEAMS</p>
					</div>
					<div id="yourTeams">
						<p>YOUR TEAMS</p>
					</div>
					<div class="pangalanNgTeam">

					</div>
					<div id="joinaTeam">
						<p>Create a Team!</p>
					</div>
				</div>
			</div>

				</div>

				<div id="LPInfo">
					<div class="exit">
						<p>X</p>
					</div>
					<div id="LPInfoTop">
						<p> NRG </p>
					</div>
					<div id="LPInfoMid">
						<div id="LPInfoMidTitle">
							<p> Team Players </p>
						</div>
						<div id="LPInfoMidInfo">
							<p> seagull - Offense </p>
							<p> iddqd - Offense </p>
							<p> ajax - Support </p>
							<p> numlocked - Tank </p>
							<p> dummy - Support </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
							<p> harbleu - Tank </p>
						</div>
						<div id="JoinTeam">
							<p> Join Team </p>
						</div>
					</div>
				</div>
		    </div>
		</div>

        <div id="createTeam">
            <div class="exit">
                <p>X</p>
            </div>
            <div id="createTeamTop">
                <p> Create a Team </p>
            </div>
            <form>
                <div id="createTeamInputs">
                    <div id="createTeamName">
                        <label> Teamname: </label>
                        <input type="text" name="teamname" id="tnInput">
						<p id="teamNameError" hidden>WHAT</p>
                    </div>
                    <div id="createTeamMembers">
                        <p> Friends </p>
                        <div id="teamFriends">
                        </div>
                        <div id="teamSubmit">
                            <input type="button" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>

		<div class="searchBox" hidden>
			<p class="searchBoxX">X</p>
			<p class="searchHead">Search</p>
			<input class="searchByUsername" placeholder="By Username..." id="searchBar">
			<button type="button" id="submitUsername" class="searchbutt">Search</button>
			<table class="buttonTable">
				<tr>
					<td><img src="{{asset('css/images/dota2logo.png')}}" class="dota2logosasearch"></td>
					<td class="charot">
						<select class="dropdownlist" id="roleDDlist">
							<option value='Carry'>Carry</option>
							<option value='Midlaner'>Midlaner</option>
							<option value='Offlaner'>Offlaner</option>
							<option value='Roaming Support'>Roaming Support</option>
							<option value='Hard Support'>Hard Support</option>
							<option value='Jungler'>Jungler</option>
						</select>
						<button type="button" id="submitDotaRole" class="searchbutt">By Role</button>
					</td>
					<td class="charot">
						<select class="dropdownlist" id="mmrDDlist">
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
							<option value='Not yet applicable'>No MMR</option>
						</select>
						<button type="button" id="submitDotaMMR" class="searchbutt">By MMR</button>
					</td>
				</tr>
				<tr>
					<td><img src="{{asset('css/images/owlogo.png')}}" class="owlogosasearch"></td>
					<td class="charot">
						<select class="dropdownlist" id="roleOWDDlist">
							<option value='Offense'>Offense</option>
							<option value='Defense'>Defense</option>
							<option value='Support'>Support</option>
							<option value='Tank'>Tank</option>
						</select>
						<button type="button" id="submitOverwatchRole" class="searchbutt">By Role</button>
					</td>
					<td class="charot">
						<select class="dropdownlist" id="tierDDlist">
							<option value='Bronze'>Bronze</option>
							<option value='Silver'>Silver</option>
							<option value='Gold'>Gold</option>
							<option value='Platinum'>Platinum</option>
							<option value='Diamond'>Diamond</option>
							<option value='Master'>Master</option>
							<option value='Grandmaster'>Grandmaster</option>
							<option value ='I do not play competitive matches'>No rank</option>
						</select>
						<button type="button" id="submitOverwatchTier" class="searchbutt">By Tier</button>
					</td>
				</tr>
			</table>
			<div class="searchResultArea">
			</div>
		</div>

        <div class="teampopup" hidden>
            <p class="teamx">X</p>
            <p id="teamName" >Team Name</p>
            <p id="admin" class="checkProfile">Admin</p>
            <p id="labelTeamMembers">Team Members</p>
            <div class="teamMembers">
            </div>
        </div>

		<div class="userprofile">
			<div class="userProfileLeft">
				<p class="profileusername">{{Auth::user()->username}}</p>
                <img src="{{('css/images/report.png')}}" class="reportButton">
                <img src="{{('css/images/teaminvite.png')}}" class="teamInviteButton">
				<p class="x">X</p>
				<img src="{{asset('css/images/defaultDP.png')}}" class="userprofileimg">
				<img src="{{asset('css/images/addfriend.png')}}" class="addfriend">
                <img src="{{asset('css/images/dota2logo.png')}}" class="dota2logo">
                <ul class="dotadetailspace">
                    <li><img src="{{('css/images/dota/axe.png')}}" class="heropic" id="dota1"></li>
                    <li><img src="{{('css/images/dota/bane.png')}}" class="heropic" id="dota2"></li>
                    <li><img src="{{('css/images/dota/batrider.png')}}" class="heropic" id="dota3"></li>
                    <li><p class="mmr">9000-9999 MMR Support</p></li>
                </ul>
                <img src="{{asset('css/images/owlogo.png')}}" class="owlogo">
                <ul class="owdetailspace">
                    <li><img src="{{('css/images/ow/zombra.png')}}" class="heropic" id="ow1"></li>
                    <li><img src="{{('css/images/ow/zenyatta.png')}}" class="heropic" id="ow2"></li>
                    <li><img src="{{('css/images/ow/genji.png')}}" class="heropic" id="ow3"></li>
                    <li><img src="{{('css/images/owtiers/gm.png')}}" class="heropic" id="owtier"></li>
                    <li><p class="owrole">Support</p></li>
                </ul>
				<form id="imgform" enctype="multipart/form-data" action="updatepic" method="POST" hidden>
					<input type="file" name="avatar" id="uploadimg">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="submit" id="submitimg">
					<a href="{{route('/getstarted')}}"><button type="button" id="chgd" >Change Details</button></a>
				</form>
			</div>
		</div>

        <div id="inviteTo" hidden>
            <div class="exitTeamInvite">
                <p>X</p>
            </div>
            <div id="createTeamTop">
                <p> Invite to team </p>
            </div>
            <form>
                <div id="createTeamInputs">
                    <div id="createTeamMembers">
                        <p> Teams </p>
                        <div id="teamsInvite">
                        </div>
                        <div id="submitInvite">
                            <input type="button" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id="addedchuchu" hidden>
            <p id="wordPare"></p>
        </div>

		<div class="notifications">
			<img src="{{('css/images/notificationbar.png')}}" class="arrow">
		</div>

        <div class="chatChuchu">
            <p class="wordChat">Chat</p>
            <div class="usersChat">
            </div>
        </div>

        <div class="chat" hidden>
            <p class="chatUsername">Bigatrice</p>
            <div class="chatArea">
            </div>
            <input type="text" class="chatInput" id="chatField" placeholder="Type a message...">
        </div>

		<div class="notifproper" hidden>
			<p class="wordnotication">Notifications</p>
			<p class="notifX">X</p>
			<div class="notificationarea">
				<div class="notif">
					<div class="imagecontainer"><img src="{{('css/images/defaultDP.png')}}" class="img-circle"></div>
						<p class="notifHeader">Somebody</p>
						<p class="notifBody">Has sent you a friend request</p>
						<input type="button" value="Accept" class="notifConf">
						<input type="button" value="Decline" class="notifConf">
				</div>
			</div>
		</div>
	</body>
</html>