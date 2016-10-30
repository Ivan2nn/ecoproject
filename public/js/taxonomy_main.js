$(document).ready(function () { 
		$('#Animalia_jstree').jstree(
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
		$('#Bacteria_jstree').jstree(); 
		$('#Fungi_jstree').jstree(); 
		$('#Plantae_jstree').jstree(); 
		$('#Protista_jstree').jstree(); 
	});
