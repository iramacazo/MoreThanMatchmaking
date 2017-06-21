$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache:false
    });

	var loggedInUser = $('#username').html();

    var postCount;
    var notifCount;

    $(".reportButton").click(function()
    {
        $.ajax(
            {
                type: 'POST',
                url: 'report',
                data:{
                    username: $('.profileusername').text()
                },
                success: function()
                {
                    console.log("REPORTED");
                }
            }
        )
    });

    $("#chatField").keypress(function(e) {
        if(e.which === 13) {
            var chat = this.value;

            if(chat !== "")
            {
                $.ajax(
                    {
                        type:"POST",
                        url:"sendChat",
                        data:{
                            username: $(".chatUsername").text(),
                            body: chat
                        },
                        success: function()
                        {
                            $(".chatArea").prepend("<div class=\"sentMessage\">" + chat +"</div>");
                            document.getElementById('chatField').value = "";
                        }
                    }
                )
            }
        }
    });

    function loadChat()
    {
        var margin = $('.chat').css('margin-bottom');
        $(".chatArea").empty();
        if(margin === "0px")
        {
            $.ajax(
                {
                    type:"POST",
                    url: "loadChatBox",
                    data:{
                        username: $(".chatUsername").text()
                    },
                    success: function(data)
                    {
                        console.log(data);
                        $(".chatArea").prepend(data);
                    }
                }
            )
        }
    }

    setInterval(loadChat, 5000);

    function loadChatUsers()
    {
        $.ajax(
            {
                type:"POST",
                url: "loadChatUsers",
                success: function(data)
                {
                    $('.usersChat').append(data);
                }
            }
        )
    }

    loadChatUsers();

    function loadTeams()
    {
        $.ajax(
            {
                type:"POST",
                url:"loadTeams",
                success: function(data)
                {
                    $(".pangalanNgTeam").prepend(data);
                }
            }
        )
    }
    loadTeams();

    function notificationInterval()
    {
        $(".notificationarea").empty();
        startNotif();
        loadTeamInvites();
    }


    function startNotif()
    {
        $.ajax(
            {
                type:'POST',
                url: 'getNotifCount',
                success: function(data)
                {
                    console.log(data);
                    notifCount = data - 1;
                    loadFriendRequests(notifCount);
                }
            }
        )
    }
    setInterval(notificationInterval, 60000);
    notificationInterval();

    function populateCreateTeam()
    {
        $.ajax(
            {
                type:"POST",
                url: 'friends',
                success: function(data)
                {
                    $("#teamFriends").append(data);
                }
            }
        )
    }

    populateCreateTeam();

    function populateTeamInvite()
    {
        $.ajax({
            type:"POST",
            url:'populateTeamInvites',
            success: function(data)
            {
                $("#teamsInvite").append(data);
            }
        })
    }

    populateTeamInvite();

    function loadFriendRequests(count)
    {
        notifCount = count;
        while(notifCount >= 0)
        {
        $.ajax(
            {
                type: 'POST',
                url: 'echoFriendRequest',
                data:{
                    notifCount: notifCount
                },
                success: function(data)
                {
                    $(".notificationarea").prepend(data);
                }
            }

        );
            notifCount = notifCount - 1;
        }
    }

    function loadTeamInvites()
    {
        $.ajax(
            {
                type: 'POST',
                url: 'loadTeamInvites',
                success:function(data)
                {
                    $(".notificationarea").prepend(data);
                }
            }
        )
    }

    function getcount()
	{
		$.ajax
  		(
      		{
            	type: 'POST',
            	url: '/getpostcount',
            	data:{
            	    username:loggedInUser
			    },
                success: function(data2)
                {
            	    postCount = data2;
            	    postCount = postCount - 1;
            	    console.log(postCount);
            	    echoStuff(postCount)
                }
            }
        )
	}

    getcount();

    $("#navSearch").click(function()
        {
            $('.searchBox').fadeIn();
            $(".everything").css("-webkit-filter", "brightness(25%)");
        }
    );

    $("#submitOverwatchTier").click(function()
    {
        $(".searchResultArea").empty();
        var role = $('#tierDDlist :selected').val();
        $.ajax(
            {
                type: 'POST',
                url: 'searchButton',
                data:{
                    search: "OverwatchTier",
                    item: role
                },
                success: function(data)
                {
                    $(".searchResultArea").append(data);
                }
            }
        )
    });

    $("#submitOverwatchRole").click(function()
    {
        $(".searchResultArea").empty();
        var role = $('#roleOWDDlist :selected').val();
        $.ajax(
            {
                type: 'POST',
                url: 'searchButton',
                data:{
                    search: "OverwatchRole",
                    item: role
                },
                success: function(data)
                {
                    $(".searchResultArea").append(data);
                }
            }
        )
    });

    $("#submitDotaMMR").click(function()
    {
        $(".searchResultArea").empty();
        var role = $('#mmrDDlist :selected').val();
        $.ajax(
            {
                type: 'POST',
                url: 'searchButton',
                data:{
                    search: "DotaMMR",
                    item: role
                },
                success: function(data)
                {
                    $(".searchResultArea").append(data);
                }
            }
        )
    });

    $("#submitDotaRole").click(function()
    {
        $(".searchResultArea").empty();
        var role = $('#roleDDlist :selected').val();
        $.ajax(
            {
                type: 'POST',
                url: 'searchButton',
                data:{
                    search: "DotaRole",
                    item: role
                },
                success: function(data)
                {
                    $(".searchResultArea").append(data);
                }
            }
        )
    });

    function echoStuff(param1)
    {
        postCount = param1;
        while(postCount >= 0)
        {
            $.ajax
            (
                {
                    type: 'POST',
                    url: '/echopost',
                    data:{
                        postCount: postCount,
                        username: loggedInUser
                    },
                    success: function(data)
                    {
                        $('#postSpace').prepend(data);
                    }
                }
            );
            postCount = postCount - 1;
        }
    }

    $('#submitUsername').click(function()
        {
            var usersearched = $("#searchBar").val();
            $.ajax(
                {
                    type: "POST",
                    url: "searchUsername",
                    data:{
                        username: usersearched
                    },
                    success:function(data)
                    {
                        $(".searchResultArea").html(data);
                    }
                }
            )
        }
    );

    $(".addfriend").click(function()
        {
            var toAdd = $(".profileusername").html();
            $.ajax
            (
                {
                    type: "POST",
                    url: 'addFriend',
                    data:{
                        tobeadded: toAdd
                    },
                    success: function(data)
                    {
                        $("#wordPare").html(data);
                        $("#addedchuchu").fadeIn();

                        var fade_out = function() {
                            $("#addedchuchu").fadeOut();
                        };

                        setTimeout(fade_out, 5000);
                    }
                }
            )
        }
    );

    $(".checkProfile").click(function()
    {
        console.log($(this).html());
        $.ajax(
            {
                type: "POST",
                url: "/stuffforprofile",
                data:{
                    username: $(this).html()
                },
                success:function(data)
                {
                    var result = $.parseJSON(data);
                    console.log(result);
                    $("#imgform").show();
                    $(".everything").css("-webkit-filter", "brightness(25%)");
                    if(result[11] === null)
                    {
                        $(".owdetailspace").hide();
                        $(".owlogo").css("-webkit-filter", "brightness(25%)");
                    }
                    else
                    {
                        $(".owdetailspace").show();
                        $(".owlogo").css("-webkit-filter", "");
                        $("#ow1").attr("src", "css/images/" + result[7]);
                        $("#ow2").attr("src", "css/images/" + result[8]);
                        $("#ow3").attr("src", "css/images/" + result[9]);
                        $(".owrole").text(result[10]);
                        $("#owtier").attr("src", "css/images/" + result[11]);
                    }

                    if(result[6] === null)
                    {
                        $(".dotadetailspace").hide();
                        $(".dota2logo").css("-webkit-filter", "brightness(25%)");
                    }
                    else
                    {
                        $(".dotadetailspace").show();
                        $(".dota2logo").css("-webkit-filter", "");
                        $("#dota1").attr('src', "css/images/" + result[2]);
                        $("#dota2").attr('src', "css/images/" + result[3]);
                        $("#dota3").attr('src', "css/images/" + result[4]);
                        $(".mmr").text(result[6] + " " + result[5]);
                    }

                    if(result[12] > 0)
                    {
                        $(".addfriend").hide();
                    }
                    else
                    {
                        $(".addfriend").show();
                    }

                    if(result[0] === $("#username").text())
                    {
                        $(".teamInviteButton").hide();
                    }
                    else
                    {
                        $(".teamInviteButton").show();
                    }


                    $(".profileusername").text(result[0]);
                    $(".userprofileimg").attr('src', "css/images/" + result[1]);
                    $(".userprofile").fadeIn();
                    $(".teampopup").css("-webkit-filter","brightness(25%)");
                }
            }
        )
    });

    $(".x").click(function()
        {
            $(".teampopup").css("-webkit-filter","");
            $(".userprofile").fadeOut();
            $("#imgform").hide();
            $(".everything").css("-webkit-filter", "");
        }
    );

    $(".teamx").click(function()
        {
            $(".teampopup").fadeOut();
            $(".everything").css("-webkit-filter", "");
        }
    );

    $(".notifications").click(function()
    {
       $(this).hide();
       $(".notifproper").show();
    });

    $('.searchBoxX').click(function() {
        $('.searchBox').fadeOut();
        $(".everything").css("-webkit-filter", "");
    });

    $(".notifX").click(function()
    {
        $(".notifproper").hide();
        $(".notifications").show();
    });




    //STUFF NI PAOLO BELOW THIS


	$("#joinaTeam p").click(function(){
		$("#createTeam").fadeIn();
        $(".everything").css("-webkit-filter", "brightness(25%)");
		$("body").css("overflow-y", "hidden");
	});
	
	$("#LookingforPlayers .panglanNgTeam .teamName p").click(function(){
		$("#LPInfo").fadeIn();
	});
	
	$("#LPInfo .exit p, #LPInfo #LPInfoMid #JoinTeam p").click(function(){
		$("#LPInfo").fadeOut();
        $(".everything").css("-webkit-filter", "");
	});
	
	$("#createTeam .exit p").click(function(){
		$("#createTeam").fadeOut();
        $(".everything").css("-webkit-filter", "");
		$("body").css("overflow-y", "auto");
	});

    $(".wordChat").click(function()
    {
        var margin = $('.chatChuchu').css('margin-bottom');
        if(margin === "-250px")
            $(".chatChuchu").animate({ "margin-bottom": 0 }, "slow");
        else
            $(".chatChuchu").animate({ "margin-bottom": -250 }, "slow");
    });

    $(".chatUsername").click(function()
    {
        var margin = $('.chat').css('margin-bottom');
        if(margin === "-225px")
        {
            $(".chatArea").empty();
            loadChat();
            $(".chat").animate({ "margin-bottom": 0 }, "slow");
        }
        else
            $(".chat").animate({ "margin-bottom": -225 }, "slow");
    });

    $("#submitInvite input").click(function(){
       var selected = [];
        $('#teamsInvite input:checked').each(function() {
            selected.push($(this).attr('name'));
        });

        $.ajax({
            type:'POST',
            url:'inviteToTeam',
            data: {
                username: $(".profileusername").text(),
                teams: selected
            },
            success: function()
            {
                $("#inviteTo").fadeOut();
                $(".userprofile").css("-webkit-filter", "");
            }
        })
    });

	$("#teamSubmit input").click(function(){
		$("body").css("overflow-y", "auto");
        var selected = [];
        $('#teamFriends input:checked').each(function() {
            selected.push($(this).attr('name'));
        });


        var teamNameTaken;
        var teamName = document.getElementById("tnInput").value;
        console.log(teamName);
        var teamNameError = $("#teamNameError");
        $.ajax
        (
            {
                type:'POST',
                url:'checkTeamName',
                data:
                    {
                        teamname: teamName
                    },
                success: function(data)
                {
                    teamNameTaken = data;

                    console.log(teamNameTaken);

                    if(teamNameTaken === "no" && teamName !== "")
                    {
                        $.ajax
                        (
                            {
                                type:'POST',
                                url:'sendTeamInvites',
                                data:
                                    {
                                        toInvite: selected,
                                        teamname: teamName
                                    },
                                success: function(data)
                                {
                                    console.log(data);
                                    $(".pangalanNgTeam").prepend(data);
                                    $("#createTeam").fadeOut();
                                    $(".everything").css("-webkit-filter", "");
                                }
                            }
                        )
                    }
                    else if(teamNameTaken==="yes")
                    {

                        teamNameError.html("Team name is taken");
                        teamNameError.fadeIn();

                        var fade_out = function() {
                            teamNameError.fadeOut();
                        };

                        setTimeout(fade_out, 5000);
                    }
                    else if(teamName === "")
                    {
                        teamNameError.html("Please enter a team name");
                        teamNameError.fadeIn();

                        var fade_out = function() {
                            teamNameError.fadeOut();
                        };

                        setTimeout(fade_out, 5000);
                    }
                }

            }
        );


	});

	$(".teamInviteButton").click(function()
    {
       $("#inviteTo").fadeIn();
        $(".userprofile").css("-webkit-filter", "brightness(25%)");
    });

    $(".exitTeamInvite").click(function()
    {
        $("#inviteTo").fadeOut();
        $(".userprofile").css("-webkit-filter", "");
    });

});