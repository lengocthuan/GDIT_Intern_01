$(document).ready(function(){
	var vals = '';
	var checkboxes = '';
	var a = '';

	function getData(){
		checkboxes = document.getElementsByName('post[]');
		for (var i=0, n=checkboxes.length;i<n;i++) 
		{
			if (checkboxes[i].checked) 
			{
				vals += ","+checkboxes[i].value;
			}
		}
		if (vals) vals = vals.substring(1);
		a = vals;
		return a;
	}

	$('#public-post').click(function(){
		getData();
		alert(a);
		return false;
	});

});
