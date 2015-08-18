$(document).ready(function(){
	var nextId = 1;
	var timeout;

	$('#spacer').css('height', ($(window).height() / 2) + 15);

	$.get("/web/check.php?id=" + nextId, onData);

	function onData(data) {
		if (data == false) {
			nextId = 0;
			setTimeout(function() {
				onData(true);
			},
			1000);
		} else {
			$.getJSON("/web/get.php?id=" + nextId, onJSON);
		}
	}
	function onJSON(data) {
		var url = data[0].url;
		var latency = data[0].latency;
		var color = '#2a2'; //green

		if (data[0].last_sha1 == '' && data[0].current_header == '') {
			color = '#a22'; //red
		} else if (data[0].last_sha1 == '' && data[0].current_sha1 != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
			color = '#aa2'; //yellow
		}

		$('#slideIn').html(url + ' - ' + latency + ' s <br><iframe id="siteView" src="' + url + '" width="' + ($(document).width() / 2) + '" height="' + ($(document).height() / 2) + '"></iframe>');
		$('#slideIn').css('background-color', color);

		clearTimeout(timeout);
		timeout = setTimeout(function() {
			$('#siteView').load(function() {});
			getNext();
		},
		15000);
		$('#siteView').load(getNext(), 3000);
		$('#siteView').muted = true;

		$('#slideOut').stop().animate({left: '0px'}, {duration: 600, queue: false});
		$('#slideOut').fadeOut(600);

		$('#slideIn').stop().animate({left: '50%'}, {duration: 600, queue: false, complete: function() {
			$('#slideOut').html(url + ' - ' + latency + ' s <br><iframe id="siteView" src="' + url + '" width="' + ($(document).width() / 2) + '" height="' + ($(document).height() / 2) + '"></iframe>');
			$('#slideOut').css('background-color', color);
			$('#slideOut').css('display', 'block');
			$('#slideOut').css('left', '50%');

			$('#slideIn').css('left', '100%');
			$('#slideIn').css('display', 'none');
		}});
		$('#slideIn').fadeIn(600);
	}

	function getNext() {
		nextId++;
		setTimeout(function() {
			$.get("/web/check.php?id=" + nextId, onData);
		},
		3000);
	}
});