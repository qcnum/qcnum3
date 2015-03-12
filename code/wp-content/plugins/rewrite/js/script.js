jQuery(document).ready(function($) {
	$("#rule-table tbody").sortable({
		helper: function(e, tr) {
			var $originals = tr.children();
			var $helper = tr.clone();
			$helper.children().each(function(index)
			{
			  $(this).width($originals.eq(index).width())
			});
			return $helper;
		},
		handle: ".reorder-handle",
	});
});