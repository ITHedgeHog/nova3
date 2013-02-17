<script type="text/javascript" src="<?php echo Uri::base(false);?>nova/modules/assets/js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo Uri::base(false);?>nova/modules/assets/js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="<?php echo Uri::base(false);?>nova/modules/assets/js/jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="<?php echo Uri::base(false);?>nova/modules/assets/js/jquery.ui.sortable.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		// show the first tab
		$('.nav-tabs a:first').tab('show');

		// when creating a new field, we have next/previous buttons for moving between tabs
		$(document).on('click', '.next-tab', function(){
			$('.nav-tabs a[href="#html"]').tab('show');
			$(this).removeClass('next-tab').addClass('prev-tab').text('<?php echo ucfirst(lang("previous"));?>');

			return false;
		});

		// when creating a new field, we have next/previous buttons for moving between tabs
		$(document).on('click', '.prev-tab', function(){
			$('.nav-tabs a[href="#general"]').tab('show');
			$(this).removeClass('prev-tab').addClass('next-tab').text('<?php echo ucfirst(lang("next"));?>');

			return false;
		});

		// this fixes the issue where the row being dragged is compacted.
		var fixHelper = function(e, ui){
			ui.children().each(function(){
				$(this).width($(this).width());
			});
			
			return ui;
		};

		// makes the field list sortable and updates when the sort stops
		$('.sort-field tbody.sort-body').sortable({
			helper: fixHelper,
			stop: function(event, ui){
				
				$.ajax({
					type: 'POST',
					url: "<?php echo Uri::create('ajax/update/formfield_order');?>",
					data: $(this).sortable('serialize')
				});
			}
		}).disableSelection();

		// makes the value list sortable and updates when the sort stops
		$('.sort-value tbody.sort-body').sortable({
			helper: fixHelper,
			stop: function(event, ui){
				
				$.ajax({
					type: 'POST',
					url: "<?php echo Uri::create('ajax/update/formfieldvalue_order');?>",
					data: $(this).sortable('serialize')
				});
			}
		}).disableSelection();

		// what action to take when a field action is clicked
		$(document).on('click', '.field-action', function(){
			var doaction = $(this).data('action');
			var id = $(this).data('id');

			if (doaction == 'delete')
			{
				$('<div/>').dialog2({
					title: "<?php echo ucwords(lang('short.delete', lang('field')));?>",
					content: "<?php echo Uri::create('ajax/delete/formfield');?>/" + id
				});
			}

			return false;
		});

		// what action to take when a value action is clicked
		$(document).on('click', '.value-action', function(){
			var doaction = $(this).data('action');
			var id = $(this).data('id');
			var parent = $(this).closest('tr');

			if (doaction == 'delete')
			{
				$.ajax({
					type: 'POST',
					url: "<?php echo Uri::create('ajax/delete/formfield_value');?>",
					data: { id: id },
					success: function(){
						parent.fadeOut();
					}
				});
			}

			if (doaction == 'update')
			{
				$('<div/>').dialog2({
					title: "<?php echo ucwords(lang('short.edit', lang('value')));?>",
					content: "<?php echo Uri::create('ajax/update/formfield_value');?>/" + id
				});
			}

			if (doaction == 'add')
			{
				var send = {
					content: $('[name="value-add-content"]').val(),
					field: '<?php echo Uri::segment(5);?>'
				}

				if ($('.sort-value tbody tr').length == 1 && $('.sort-value tbody tr:nth-child(1) td').length == 1)
				{
					// there are no values in the database
					send.order = 1;
				}
				else if ($('.sort-value tbody tr').length == 1 && $('.sort-value tbody tr:nth-child(1) td').length > 1)
				{
					// there is already 1 value in the database
					send.order = 2;
				}
				else
				{
					// there's more than 1 value in the database
					send.order = $('.sort-value tbody tr').length + 1;
				}

				$.ajax({
					type: 'POST',
					url: "<?php echo Uri::create('ajax/add/formfield_value');?>",
					data: send,
					dataType: 'html',
					success: function(data){

						if ($('.sort-value tbody tr').length == 1 && $('.sort-value tbody tr:nth-child(1) td').length == 1)
						{
							// if there's only 1 record AND only one column in the row, replace everything
							$('.sort-value .sort-body').html(data);
						}
						else
						{
							// all other times, we'll append to the end of the table
							$('.sort-value .sort-body').append(data);
						}

						// finally, reset the add field to be blank
						$('[name="value-add-content"]').val('');
					}
				});
			}

			return false;
		});

		// determine the actions when the type dropdown changes
		$('[name="type"]').change(function(){

			// find the selected value
			var type = $('[name="type"] option:selected').val();

			if (type == 'text')
			{
				$('.field-rows').hide();
				$('.field-placeholder').show();
				$('.field-value').show();
				$('.help-values').hide();
			}

			if (type == 'textarea')
			{
				$('.field-rows').show();
				$('.field-placeholder').show();
				$('.field-value').show();
				$('.help-values').hide();
			}

			if (type == 'select')
			{
				$('.field-rows').hide();
				$('.field-placeholder').hide();
				$('.field-value').hide();
				$('.help-values').show();
			}
		});
	});
</script>