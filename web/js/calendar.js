$(function(){
	$(document).on('click','.fc-day',function(){
		var date=$(this).attr('data-date');
		var titulo='Registro de Eventos';
		//console.log(this);
		$.get('index.php?r=evento%2Fcreate',{'date':date},function(data){
			$('#evento').text(titulo);
			$('#modalEvento').modal('show')
				.find('#modalContentEvento')
				.html(data);
		});

	});

	$(document).on('click','.fc-day-grid-event',function(){
		var id=$(this).attr('data-id');
		var titulo=$(this).attr('data-titulo');
		
		//console.log(titulo);
		$.get('index.php?r=evento%2Fanexo',{'id':id},function(data){
			$('#anexo').text(titulo);
			$('#modalAnexo').modal('show')
				.find('#modalContentAnexo')
				.html(data);
		});

	});
	$(document).on('click','#nuevoAnexo',function(){
		var id=$(this).attr('data-id');
		var titulo='Nuevo Anexo';
		//console.log(id);
		
		$.get('index.php?r=evento%2Fanexo',{'id':id,'n':'n'},function(data){
			$('#anexo').text(titulo);
			$('#modalAnexo').modal('show')
				.find('#modalContentAnexo')
				.html(data);
		});

	});
	$(document).on('click','#regresar',function(){
		var id=$(this).attr('data-id');
		var titulo='Visualizar contenido';
		//console.log(id);
		
		$.get('index.php?r=evento%2Fanexo',{'id':id,'n':'r'},function(data){
			$('#anexo').text(titulo);
			$('#modalAnexo').modal('show')
				.find('#modalContentAnexo')
				.html(data);
		});

	});
	$(document).on('click','#nuevoEventoModal',function () {
		var date=$(this).attr('data-date');
		var titulo='Crear Evento';

		$.get('index.php?r=evento%2Fcreate',{'date':date,'n':'ne'},function(data){
			$('#evento').text(titulo);
			$('#modalEvento').modal('show')
				.find('#modalContentEvento')
				.html(data);
		});
	})
	/*$(document).on('click','#guardarAnexoAjax',function(){
		var id=$(this).attr('data-id');
		var titulo='Visualizar contenido';
		//console.log(this);
		
		/*$.get('index.php?r=evento%2Fanexo',{'id':id,'n':'r'},function(data){
			$('#anexo').text(titulo);
			$('#modalAnexo').modal('show')
				.find('#modalContentAnexo')
				.html(data);
		});

	});*/

	/*$('form#w0').on('beforeSubmit',function(e){
		var $form = $(this);
		console.log($form);
		alert("antes del submit 1");
	});*/
	$(document).on('submit','#formulario',function(e){	
		e.preventDefault();
		var form=$(this);
		var id=$(this).attr('data-id');
		var titulo='Visualizar contenido';
        $.ajax({
            type: 'POST',
            url: form.attr("action")+"&id="+id+"&n=a",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            
            success: function(msg){
            	$('#anexo').text(titulo);
                //console.log(msg);
                $('#modalAnexo').modal('show')
				.find('#modalContentAnexo')
				.html(msg);
            }
        });
	});
	//$('#formulario').submit(function(event) {
/*	 $(document).on('submit','#formulario',function(){	
		var form=$(this);
		var id=$(this).attr('data-id');
		var formData = new FormData($(this));
		//console.log(formData);
		console.log($(this)[0]['faeventoanexo-image'].name);
		//formData.append($(this)[0]['faeventoanexo-image'].name,
		// $(this)[0]['faeventoanexo-image'].files[0]);
		// linea de ejemplo formData.append('dato','valor');
		console.log($(this)[0]['faeventoanexo-image'].files[0]);
		//console.log($(this));
		//alert("antes del submit 2");
		//console.log(formData.get($(this)[0]['faeventoanexo-image'].name));
		$.post(
				form.attr("action")+"&id="+id+"&n=v",
				[formData]
			).done(function(data){
					//console.log(result);
					$('#modalAnexo').modal('show')
					.find('#modalContentAnexo')
					.html(data);
				}
			);
		/*$.ajax(
			form.attr("action")+"&id="+id+"&n=v",
		   	form.serializeArray()+formData,
		   	'POST',
		   	function(data){
                console.log(data); 
            }
		);	--
		return false;	
	});																*/
	/*$(document).on('click','#guardarAnexoAjax',function(){
		console.log("has algo");
		alert('Estas un paso mas cerca de consegirlo');
	});*/
	/*$(document).ready(function($){
		$('.vi-form').submit(function(event){
			event.preventDefault();
			alert('algo');
		});
	});*/
});

/*jQuery(document).ready(function($) {
       $(".vi-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
            console.log(this);
            /*$.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
                if (response.data.success == true) {
                    alert("Wow you commented");
                }
            })
            .fail(function() {
                console.log("error");
            });
        
        });
    });*/
