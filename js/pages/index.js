$(document).ready(function() {
	if ($('#mainTable thead th').length == 5) {
		var dtObj = {
			"ajax": '/web/sites.php',
			"columnDefs": [
				{
					"targets": -1,
					"data": null,
					"defaultContent": '<img src="https://www.bluegeneration.com/Content/images/shared/deleteBtn.jpg">',
					"bSortable": false
				}
			],
			"fnDrawCallback": function() {
				$('#mainTable img').click(function() {
					$.get('/web/delete.php?id=' + table.row($(this).parents('tr')).data()[0], function(data) {
						table.ajax.reload();
					});
				});
			},
			stateSave: true
		};
	} else {
		var dtObj = {
			"ajax": '/web/sites.php',
			"fnDrawCallback": function() {
				$('#mainTable img').click(function() {
					$.get('/web/delete.php?id=' + table.row($(this).parents('tr')).data()[0], function(data) {
						table.ajax.reload();
					});
				});
			},
			stateSave: true
		};
	}

	var table = $('#mainTable').DataTable(dtObj);
	var colors = [];

	$('#addForm').ajaxForm(function() {
		$('#url').val("");
	});

	var nextId = 1;

	setInterval(function() {
		table.ajax.reload(resetCSS);
	},
	1000);

	$.get("/web/check.php?id=" + nextId, onData);

	function onData(data) {
		if (data == false) {
			nextId = 0;
			setTimeout(function() {
				onData(true);
			},
			15000);
		} else {
			$.getJSON("/web/get.php?id=" + nextId, onJSON);

			nextId++;
			setTimeout(function() {
				$.get("/web/check.php?id=" + nextId, onData);
			},
			1000);
		}
	}
	function onJSON(data) {
		var id = data[0].id;
		var color = '#2a2'; //green

		if (data[0].last_sha1 == '' && data[0].current_header == '') {
			color = '#a22'; //red
		} else if (data[0].last_sha1 == '' && data[0].current_sha1 != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
			color = '#aa2'; //yellow
		}

		table.row(id - 1).nodes().to$().css('background-color', color);
		colors[id - 1] = color;
	}
	function resetCSS(data) {
		table.rows().every(function(index, tableLoop, rowLoop) {
			index = this.index();
			
			if (colors[index] != undefined) {
				this.nodes().to$().css('background-color', colors[index]);
			}
		});
	}
});