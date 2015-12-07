$(function(){
	
	var note = $('#note'),
		ts = new Date(2015, 9, 27),
		newYear = false;
	
	if((new Date()) > ts){
		// Задаем точку отсчета для примера. Пусть будет очередной Новый год или дата через 10 дней.
		// Обратите внимание на *1000 в конце - время должно задаваться в миллисекундах
		ts = new Date(2016,0,1);/*).getTime() + 10*24*60*60*1000;*/
		newYear = true;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += "Дней: " + days +", ";
			message += "часов: " + hours + ", ";
			message += "минут: " + minutes + " и ";
			message += "секунд: " + seconds + " <br />";
			
			if(newYear){
				message += "осталось до Нового года!";
			}
			else {
				message += "осталось до 27 октября дней:часов:минту:секунд!";
			}
			
			note.html(message);
		}
	});
	
});
