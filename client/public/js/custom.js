/*!
 * Custom code javascript
 * Copyright 2018 haganicolau.
 */

jQuery(document).ready(function()
{

	if(jQuery('.fail').length)
	{
		swal({
		  	title: 'Ops...',
		  	text: 'Acesso não autorizado!',
		  	type: 'error'
		});
	}
	
	/*submit para salvar o certificado*/
	jQuery('#upload-form').submit(function(event) 
	{
	    event.preventDefault();

	    var frm = jQuery(this);

	    /*obtém o arquivo*/

	    var file = document.getElementById('certificate').files[0];

	    var reader = new FileReader();
	    reader.readAsText(file);
	    reader.onload = function(e) {
            
            // browser completed reading file
            data = e.target.result;
        	name = jQuery('#name').val();

		    jQuery.ajax({
		      type: frm.attr('method'),
		      url: 	'/create',
		      data: {'name': name,'file': data},
		      contentType: "application/x-www-form-urlencoded;charset=UTF-8"
		    }).done(function(data) {

		      	data = data.response;
		      	console.log(data);
		      	if(data.status == 'ok'){

		      		swal({
					  	title: 'Yeah!',
					  	text: data.message,
					  	type: 'success'
					}).then(function() {

						location.reload();
						
					}).catch(swal.noop);

		      	} else {
			      	swal({
					  	title: 'Ops...',
					  	text: data.message,
					  	type: 'error'
					});
		      	}
	 
		    }).fail(function(data) {
		      
		      	swal({
				  	title: data.status +' - '+ data.statusText,
				  	text: 'Não foi possivel processar sua solicitação.',
				  	type: 'error'
				});

		    });
		}

	});

	/*click para visualizar dados do certificado*/
	jQuery('.btn-view').click(function(event) 
	{
		event.preventDefault();
		var route = jQuery(this).attr("href");

   		/*requisição ajax para obter os detalhes do certificado*/
	    jQuery.ajax({
	      type: 'GET',
	      url: 	route,
	      dataType: 'json',
	      processData: false,
	    }).done(function(data) {

	    	if(data.status == 'ok'){
	    		/*monta a exibicão dos dados do certificado*/
				jQuery(".subject-dn").append('<b>Subject DN:</b> <em> '+data.data.subjectDn+' </em>');
	    		jQuery(".issuer-dn").append('<b>Issuer DN:</b> <em> '+data.data.issuerDn+' </em>');
	    		jQuery(".note-before").append('<b>Não antes de:</b> <em> '+data.data.notBefore+' </em>');
	    		jQuery(".note-after").append('<b>Não depois de:</b> <em> '+data.data.notAfter+' </em>');
	    		jQuery(".title").append('<b>'+data.data.name+'</b>');

	    		jQuery('#mdlView').modal({
			        show: 'true'
			    });

	    		/*ao fechar o modal todos os dados são zerados*/
			    jQuery('#mdlView').on('hide.bs.modal', function (event) {
					jQuery(".subject-dn b").remove();
			    	jQuery(".subject-dn em").remove();

			    	jQuery(".issuer-dn b").remove();
			    	jQuery(".issuer-dn em").remove();

			    	jQuery(".note-before b").remove();
			    	jQuery(".note-before em").remove();

			    	jQuery(".note-after b").remove();
			    	jQuery(".note-after em").remove();

			    	jQuery(".title b").remove();
				});

	      	} else {
		      	swal({
				  	title: 'Ops...',
				  	text: data.message,
				  	type: 'error'
				});
	      	}
	  
	    }).fail(function(data) {
	      
	      	swal({
			  	title: data.status +' - '+ data.statusText,
			  	text: 'Não foi possivel processar sua solicitação.',
			  	type: 'error'
			});

	    });

	});

	/*click para excluir certificado*/
	jQuery('.btn-delete').click(function(event)
	{
		event.preventDefault();
		var route = jQuery(this).attr("href");
		certificate = this;
		id = jQuery(this).attr('id')
		
		jQuery('#mdlDelete').modal({
	        show: 'true'
	    });

	    jQuery('#btn-delete').click(function(event){
	    	
	    	jQuery.ajax({
		      type: 'GET',
		      url: 	route,
		      dataType: 'json',
		    }).done(function(data) {

		      	if(data.status == 'ok'){

		      		swal({
					  	title: 'Yeah!',
					  	text: data.message,
					  	type: 'success'
					}).then(function() {

						jQuery("#element-"+id).remove();

						jQuery('#mdlDelete').modal('toggle');
						
					}).catch(swal.noop);

		      	} else {
			      	swal({
					  	title: 'Ops...',
					  	text: data.message,
					  	type: 'error'
					});
		      	}
	 
		    }).fail(function(data) {
		      
		      	swal({
				  	title: data.status +' - '+ data.statusText,
				  	text: 'Não foi possivel processar sua solicitação.',
				  	type: 'error'
				});

		    });

	    });
	});

	/*ação para alterar certificado*/
	jQuery('.btn-update').click(function(event) {
		console.log('update');
		event.preventDefault();

		var route = jQuery(this).attr("href");
		certificate = this;

		id = jQuery(this).attr('id')
		name = jQuery('#element-'+id+' .element-name').text();

		jQuery('#mdlUpdate').modal({
	        show: 'true'
	    });

	    jQuery('#mdlUpdate #name-update').val(name);

		jQuery('#mdlUpdate').submit(function(event) {
		    event.preventDefault();

		    /*obtém o arquivo*/
		    var file = document.getElementById('certificate-update').files[0];

		    var reader = new FileReader();
		    reader.readAsText(file);
		    reader.onload = function(e) {
	            
	            // browser completed reading file - display it
	            data = e.target.result;
	        	name = jQuery('#name-update').val();

			    jQuery.ajax({
			      type: 'POST',
			      url: 	route,
			      data: {'name': name,'file': data},
			      contentType: "application/x-www-form-urlencoded;charset=UTF-8"
			    }).done(function(data) {
			    	data = data.response;
			      	swal({
					  	title: 'Yeah!',
					  	text: data.message,
					  	type: 'success'
					}).then(function() {

						location.reload();
						
					}).catch(swal.noop);
		 
			    }).fail(function(data) {
			      
			      	swal({
					  	title: data.status +' - '+ data.statusText,
					  	text: 'Não foi possivel processar sua solicitação.',
					  	type: 'error'
					});

			    });
			}

		});

	});
});