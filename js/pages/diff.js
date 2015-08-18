$(document).ready(function() {
	var nextId = parseInt(getUrlParameter('id'));

	if (nextId == undefined || nextId == NaN || nextId < 1) {
		nextId = 1;
	}

	$.get("/web/check.php?id=" + nextId, onData);

	function onData(data) {
		if (data == false) {
			nextId = 1;
			$.get("/web/check.php?id=" + nextId, onData);
		} else {
			$.getJSON("/web/diff.php?id=" + nextId, onJSON);
		}
	}
	function onJSON(data) {
		var url = data[0][0].url;
		var latency = data[0][0].latency;
		var left_content = data[0][0].last_sha1 + '\n\n' + data[0][0].last_header + '\n\n' + data[0][0].last_body;
		var right_content = data[0][0].current_sha1 + '\n\n' + data[0][0].current_header + '\n\n' + data[0][0].current_body;
		var bottom_content = data[1][0].data;

		$('#top').html(url + " - " + latency + " s");
		$('#preview').attr('src', url);
		$('#leftContent').html(left_content);
		$('#rightContent').html(right_content);
		$('#bottomContent').html(bottom_content);

		$('#spacer').css('height', $('#content').height() + 15);
	}

	$('#leftArrow').click(function() {
		clearAll();

		nextId--;
		if (nextId <= 1) {
			nextId = 1;
		}
		$.get("/web/check.php?id=" + nextId, onData);
	});
	$('#rightArrow').click(function() {
		clearAll();

		nextId++;
		$.get("/web/check.php?id=" + nextId, onData);
	});

	$('#leftContent').on('scroll', function() {
		$('#rightContent').scrollTop($(this).scrollTop());
	});
	$('#rightContent').on('scroll', function() {
		$('#leftContent').scrollTop($(this).scrollTop());
	});

	function clearAll() {
		$('#top').html('');
		$('#preview').attr('src', '');
		$('#leftContent').html('');
		$('#rightContent').html('');
		$('#bottomContent').html('');

		$('#spacer').css('height', $('#content').height() + 15);
	}
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};