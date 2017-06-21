$(document).ready(function() {
	/* this variables contain the input of
	 * the user, Ira */

	var loggedInUser = $('#username').html();
	var finalRoleOW;
	var firstHeroOW;
	var secondHeroOW;
	var thirdHeroOW;
	var mmrOW;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#dota2').mouseover(function() {
		
		var game = $('#game h1');
		
		game.html('DOTA 2');
		game.css('font-family','dota2font');
		game.fadeIn(400);
	});
	
	$('#dota2').mouseout(function() {
		
		var game = $('#game h1');
		game.fadeOut();
	});
	
	$('#ow').mouseover(function() {
		
		var game = $('#game h1');
		
		game.html('OVERWATCH');
		game.css('font-family','owfont');
		game.fadeIn(400);
	});
	
	$('#ow').mouseout(function() {
		
		var game = $('#game h1');
		game.fadeOut();
	});
	
	//before roles
	$('#dota2').click(function()
	{
		
		$('#game h1').css('display','none');
		$('.choose').fadeOut(200);
		$('.pos').fadeIn(800);
		$('#heading h1').fadeOut();
	});
	
	//before best heroes
	$('#roles li').click(function()
    {
		var pos = this.id;
		$.ajax
        (
            {
                type: 'POST',
                url: '/updategetstartedDota',
                data: {
                	username: loggedInUser,
                    detail: "role",
                    input1: pos,
                },
                success: function () {
                    $('.pos').fadeOut();
                    $('.heroes').fadeIn(800);
                }
            }
        );
	}); 
	
	//before mmr
	$('#btnHero').click(function()
	{
		var hero1 = $('.h1 :selected').val();
		var hero2 = $('.h2 :selected').val();
		var hero3 = $('.h3 :selected').val();
        $.ajax
        (
            {
                type: 'POST',
                url: '/updategetstartedDota',
                data: {
                    username: loggedInUser,
                    detail: "hero",
                    input1: hero1,
                    input2: hero2,
                    input3: hero3,
                },
                success: function () {
                    $('.heroes').fadeOut();
                    $('.mmr').fadeIn();
                }
            }
        );
	});
	
	//before done
	$('#btnMMR').click(function(){
		var mmrDota = $('#mmrfield :selected').val();
        $.ajax
        (
            {
                type: 'post',
                url: '/updategetstartedDota',
                data: {
                    username: loggedInUser,
                    detail: "mmr",
                    input1: mmrDota,
                },
                success: function () {
                    $('.mmr').fadeOut();
                    $('#finish').fadeIn();
                }
            }
        );
	}); 
	
	$('#continue').click(function() {
		$('#finish').fadeOut();
		$('.choose').fadeIn();
		$('#game').fadeIn();
		$('#heading h1').fadeIn();
	});
	
	$('#proceed').click(function() {

	});
	
	//before roles ow
	$('#ow').click(function() {
		$('#game h1').css('display','none');
		$('.choose').fadeOut(200);
		$('#heading h1').fadeOut()
		$('.step1').fadeIn(800);
	});
	
	//before heroes
	$('#rolesOW li').click(function() {
        var pos = this.id;
        $.ajax
        (
            {
                type: 'POST',
                url: '/updategetstartedOverwatch',
                data: {
                    username: loggedInUser,
                    detail: "role",
                    input1: pos,
                },
                success: function () {
                    $('.step1').fadeOut();
                    $('.heroesOW').fadeIn();
                }
            }
        );
	});
	
	//before tier
	$('#btnHeroOW').click(function() {
        var hero1 = $('.owh1 :selected').val();
        var hero2 = $('.owh2 :selected').val();
        var hero3 = $('.owh3 :selected').val();
        $.ajax
        (
            {
                type: 'POST',
                url: 'updategetstartedOverwatch',
                data: {
                    username: loggedInUser,
                    detail: "hero",
                    input1: hero1,
                    input2: hero2,
                    input3: hero3,
                },
                success: function () {
                    $('.heroesOW').fadeOut();
                    $('.ranktier').fadeIn();
                }
            }
        );
	});
	
	//hovering the tiers for OW
	$('.bronze').mouseover(function() {
		$('#nametier').html('Bronze');
	});
	
	$('.silver').mouseover(function() {
		$('#nametier').html('Silver');
	});
	
	$('.gold').mouseover(function() {
		$('#nametier').html('Gold');
	});
	
	$('.plat').mouseover(function() {
		$('#nametier').html('Platinum');
	});
	
	$('.diamond').mouseover(function() {
		$('#nametier').html('Diamond');
	});
	
	$('.master').mouseover(function() {
		$('#nametier').html('Master');
	});
	
	$('.grandmaster').mouseover(function() {
		$('#nametier').html('Grandmaster');
	});

	$('.rating').mouseout(function() {
		$('#nametier').html('What is your Tier?');
	});

	$('.rating').click(function() {
		var mmrOW = $(this).attr('value');
        $.ajax
        (
            {
                type: 'POST',
                url: '/updategetstartedOverwatch',
                data: {
                    username: loggedInUser,
                    detail: "mmr",
                    input1: mmrOW,
                },
                success: function () {
                    $('.ranktier').fadeOut();
                    $('#finish').fadeIn();
                }
            }
        );

		console.log(finalRoleOW);
		console.log(firstHeroOW);
		console.log(secondHeroOW);
		console.log(thirdHeroOW);
		console.log(mmrOW);
	});
});