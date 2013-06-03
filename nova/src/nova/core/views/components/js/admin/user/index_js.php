<script type="text/javascript">
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	$(document).ready(function(){
		
		$('[rel="change_user_view"]').click(function(){
			
			// get the view
			var view = $(this).attr('id');

			// clear the search field
			$('#user-search').val('').text('');
			
			if (view == 'show_all')
			{
				$('#actives').fadeOut('fast', function(){
					$('#all').fadeIn('fast');
				});
			}
			else
			{
				$('#all').fadeOut('fast', function(){
					$('#actives').fadeIn('fast');
				});
			}
			
			return false;
		});

		$("#user-search").keyup(function(){
			delay(function(){
				$.ajax({
					beforeSend: function(){
						$('#no-results').hide();
						$('#results').hide();
						
						$('#results-name').hide();
						$('#results-name ul').empty();
						
						$('#results-email').hide();
						$('#results-email ul').empty();
						
						$('#results-characters').hide();
						$('#results-characters ul').empty();

						$('#actives').fadeOut('fast', function(){
							$('#all').fadeIn('fast');
						});
					},
					url: '<?php echo Uri::create("ajax/get/user_search");?>',
					type: 'GET',
					dataType: 'json',
					data: { query: $('#user-search').val() },
					success: function(data){

						console.log(data);

						// build the URL ahead of time
						var url = '<?php echo Uri::create("admin/user/edit");?>/';
						
						if ( ! $.isEmptyObject(data))
						{
							if ( ! $.isEmptyObject(data.name))
							{
								$.each(data.name, function(key, value){
									$('#results-name ul').append('<li><a href="' + url + value.id + '" class="btn btn-mini"><div class="icn icn-50" data-icon="p"></div></a>&nbsp;&nbsp;' + value.name + '</li>');
								});
								
								$('#results-name').show();
							}
							
							if ( ! $.isEmptyObject(data.email))
							{
								$.each(data.email, function(key, value){
									$('#results-email ul').append('<li><a href="' + url + value.id + '" class="btn btn-mini"><div class="icn icn-50" data-icon="p"></div></a>&nbsp;&nbsp;' + value.name + ' (' + value.email + ')' + '</li>');
								});
								
								$('#results-email').show();
							}
							
							if ( ! $.isEmptyObject(data.characters))
							{
								$.each(data.characters, function(key, value){
									$('#results-characters ul').append('<li><a href="' + url + value.id + '" class="btn btn-mini"><div class="icn icn-50" data-icon="p"></div></a>&nbsp;&nbsp;' + value.name + ' (' + value.fname + ' ' + value.lname + ')' + '</li>');
								});
								
								$('#results-characters').show();
							}
							
							$('#results').show();
						}
						else
						{
							$('#no-results').show();
						}
					}
				});
			}, 500);
		});
	});

	// what action to take when a rank group action is clicked
	$('.user-action').on('click', function(){
		var doaction = $(this).data('action');
		var id = $(this).data('id');

		if (doaction == 'delete')
		{
			$('<div/>').dialog2({
				title: "<?php echo ucwords(lang('short.delete', lang('user')));?>",
				content: "<?php echo Uri::create('ajax/delete/user');?>/" + id
			});
		}

		if (doaction == 'create')
		{
			$('<div/>').dialog2({
				title: "<?php echo ucwords(lang('short.create', lang('user')));?>",
				content: "<?php echo Uri::create('ajax/add/user');?>"
			});
		}

		if (doaction == 'link')
		{
			$('<div/>').dialog2({
				title: "<?php echo ucwords(langConcat('action.link character to user'));?>",
				content: "<?php echo Uri::create('ajax/update/link_character');?>"
			});
		}

		return false;
	});
</script>