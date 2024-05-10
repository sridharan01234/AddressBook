function deleteAlert() {
    if(confirm('Are sure! you want delete contacts')) return true;
    return false;
}

$("#selectAll").click(function() {
	$("input[type=checkbox]").prop("checked", $(this).prop("checked"));
});

$("input[type=checkbox]").click(function() {
	if (!$(this).prop("checked")) {
		$("#selectAll").prop("checked", false);
	}
});