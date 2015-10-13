$(document).ready(function(){
	$('.date').mask('00/00/0000');
	$('.time').mask('00:00:00');
	$('.time_short').mask('00:00');
	$('.date_time').mask('00/00/0000 00:00:00');
	$('.cep').mask('00000-000');
	$('.telefone_short').mask('0000-0000');
	$('.telefone').mask('(00)0000-0000');
	$('.phone_us').mask('(000) 000-0000');
	$('.mixed').mask('AAA-000-S0S');
	$('.placa').mask('AAA-0000');
	$('.number3').mask('000');
	$('.cnpj').mask('00.000.000/0000-00');
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$('.money').mask('000.000.000.000.000,00', {reverse: true});

	$('.defineDateTime').click(function() {
		var txt = $("[name='" + $(this).attr('target') + "']");
		var date = new Date();
		var valor = getFormatedDate(date);
		txt.val(valor);
	});

	$('#ComboCondominio').change(function(){
		$.get("/api/dropdown/condominio_blocos",
			{ option: $(this).val() },
			function(data) {
				var model = $('#ComboBloco');
				model.empty();

				$.each(data, function(index, element) {
					model.append("<option value='"+ element.id +"'>" + element.numero + "</option>");
				});
			});
	});

	$('#ComboBloco').change(function(){
		$.get("/api/dropdown/bloco_unidades",
			{ option: $(this).val() },
			function(data) {
				var model = $('#ComboUnidade');
				model.empty();

				$.each(data, function(index, element) {
					model.append("<option value='"+ element.id +"'>" + element.numero + "</option>");
				});
			});
	});

	$(".openDetails").click(function (event) {
		event.preventDefault();
		$("#details_" + $(this).data("id")).toggle();
		//$(this).toggleClass('glyphicon-minus');
	});

});

function getFormatedDate (date) {
	var day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
	var month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
	var year = date.getFullYear();
	var hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
	var minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
	var seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

	return day + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds;
}
