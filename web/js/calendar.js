$(function(){
	$(document).on('click','.fc-day',function(){
		var date=$(this).attr('data-date');

		$.get('index.php?r=evento%2Fcreate',{'date':date},function(data){
			$('#modal').modal('show')
				.find('#modalContent')
				.html(data);
		});

	});
});