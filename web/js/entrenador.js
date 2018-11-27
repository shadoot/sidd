$(function(){
	$(document).on('click','#registar-entrenador',function(){
		var data=$(this).attr('data');

		$.get('index.php?r=entrenador%2Fcreate',{'data':data},function(data){
			$('#modal').modal('show')
				.find('#modalContent')
				.html(data);
		});

	});
});