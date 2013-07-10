<script type="text/javascript" src="{{ SRCURL }}assets/js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{{ SRCURL }}assets/js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="{{ SRCURL }}assets/js/jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="{{ SRCURL }}assets/js/jquery.ui.sortable.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		// Activate the first tab
		$('.nav-tabs a:first').tab('show');

		// This fixes the issue where the row being dragged is compacted.
		var fixHelper = function(e, ui){
			ui.children().each(function(){
				$(this).width($(this).width());
			});
			
			return ui;
		};

		// Makes the section list sortable and updates when the sort stops
		$('#sortableSections').sortable({
			helper: fixHelper,
			stop: function(event, ui){
				$.ajax({
					type: 'POST',
					url: "{{ URL::to('ajax/update/form_section_order') }}",
					data: $(this).sortable('serialize')
				});
			}
		}).disableSelection();
	});

	// What action to take when a section action is clicked
	$(document).on('click', '.js-section-action', function(e){
		var action = $(this).data('action');
		var id = $(this).data('id');

		if (action == 'delete')
		{
			$('#deleteSection').modal({
				remote: "{{ URL::to('ajax/delete/form_section') }}/" + id
			}).modal('show');
		}

		e.preventDefault();
	});
	
</script>