$(document).ready(function() {

	var i=4;
	const images= ['third.jpg','fifth.jpg','fourth.png',
				   'second.png','seventh.png',
				   'mainWall.png','ogre.jpg','qop.jpg'];
	const image = $('body');

	setInterval(function()
	{
		image.css('background-image','url(./css/wps/'+images[i++]+')');
		if (i==images.length) i=0;
	}, 15000);
});