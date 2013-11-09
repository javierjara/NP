$Core.inviteContactimpoter =
	{
		iEnabled : 0,
		localSelector: function(sValue)
		{
			$('.checkbox').each(function(){
				if (sValue == "none")
				{
					$(this).attr('checked', false);
					$('#js_action_selector_1').attr('disabled', 'disabled');
				}
				if (sValue == "all")
				{
					
					$(this).attr('checked', true);
					$('#js_action_selector_1').removeAttr('disabled', '');
				}
			});
		},

		enableDelete: function(oObj)
		{
			if ($(oObj).attr('checked') == true || $(oObj).attr('checked')  == "checked")
			{
				
				$('#js_action_selector_1').removeAttr('disabled', '');
				$Core.inviteContactimpoter.iEnabled++;
			}
			else
			{
				$Core.inviteContactimpoter.iEnabled--;
				if ($Core.inviteContactimpoter.iEnabled < 1)
				{
					$('#js_action_selector_1').attr('disabled', 'disabled');
				}
			}
		},

		doAction: function(sAction)
		{
			if (sAction == "delete")
			{
				$('#js_form').submit();
			}
			if(sAction == "resendallselected")
			{
				
				var html = '<input type="hidden" value="resendallselected" name="resendallselected">';
				$('#js_form').append(html);
				$('#js_form').submit();
			}
			if(sAction == "resendall")
			{
				
				var html = '<input type="hidden" value="resendall" name="resendall">';
				$('#js_form').append(html);
				$('#js_form').submit();
			}
			return true;
		}
	}


