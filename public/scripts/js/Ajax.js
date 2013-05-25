function getAjaxResponse(strurl, strcontainer) {
		dojo.xhrGet({
        	url: strurl,
        	handleAs: "text",
            sync:true,
        	load: function(data) {
          		dojo.byId(strcontainer).innerHTML = data;
        	}
    	});	
}

function getAjaxResponseBook(strurl, strcontainer) {
		document.getElementById('book_waiting').style.display='';
		dojo.xhrGet({
        	url: strurl,
        	handleAs: "text",
            sync:true,
        	load: function(data) {
          		dojo.byId(strcontainer).innerHTML = data;
				document.getElementById('book_waiting').style.display='none';				
        	}
    	});	
}

function getAjaxResponsePost(form, strurl, strcontainer) {
	dojo.xhrPost({
    	url: strurl,
    	form: dojo.byId(form),
    	handleAs: "text",
        sync:true,
    	load: function(data) {
      		dojo.byId(strcontainer).innerHTML = data;
    	}
	});

}

function getRadioValue(radio){	
	for(i=0; i <radio.length; i++){
		if(radio[i].checked){
			valorSeleccionado = radio[i].value;
			return valorSeleccionado;
		}
	}
	return;
}

function getAllRadiosValues(radio){
	valorSeleccionado=0;
	rooms=[];
	for(i=0; i <radio.length; i++){		
		if(radio[i].checked){			
			if(radio[i].id!="optionsset-extravalues-anulation" && 
			   radio[i].id!="optionsset-extravalues-ipeuros"){
					val = "/room/"+radio[i].value;
					valorSeleccionado = valorSeleccionado + val;
			}		
		}
	}
	return valorSeleccionado;
	
}


