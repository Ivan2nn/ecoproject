$(document).ready(function () { 
		$('#Animalia_jstree').jstree(
			{
				"core" : {
    				"animation" : 0,
    				"check_callback" : true,
    				"themes" : { "icons" : false }
    			},
				"checkbox" : {
      				"keep_selected_style" : false,
      				"three_state" : false,
        			"cascade" : 'down'
    			},
    			"plugins" : [ "checkbox" ]
			}
		); 
		$('#Bacteria_jstree').jstree(
			{
				"core" : {
    				"animation" : 0,
    				"check_callback" : true,
    				"themes" : { "icons" : false }
    			},
				"checkbox" : {
      				"keep_selected_style" : false
    			},
    			"plugins" : [ "checkbox" ]
			}
		); 
		$('#Fungi_jstree').jstree(
			{
				"core" : {
    				"animation" : 0,
    				"check_callback" : true,
    				"themes" : { "icons" : false }
    			},
				"checkbox" : {
      				"keep_selected_style" : false
    			},
    			"plugins" : [ "checkbox" ]
			}
		); 
		$('#Plantae_jstree').jstree(
			{
				"core" : {
    				"animation" : 0,
    				"check_callback" : true,
    				"themes" : { "icons" : false }
    			},
				"checkbox" : {
      				"keep_selected_style" : false
    			},
    			"plugins" : [ "checkbox" ]
			}
		); 
		$('#Protista_jstree').jstree(
		{
				"core" : {
    				"animation" : 0,
    				"check_callback" : true,
    				"themes" : { "icons" : false }
    			},
				"checkbox" : {
      				"keep_selected_style" : false
    			},
    			"plugins" : [ "checkbox" ]
			}
		); 
	});
