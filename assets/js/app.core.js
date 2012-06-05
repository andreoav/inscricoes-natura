(function($){
	/* Table initialisation */
	$(document).ready(function() {

		// Inscrições do atleta na página inicial
		$('#inscricoes_feitas').dataTable( {
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"sAjaxSource" : base_url + 'rest/inscricoes/minhas_inscricoes',
			"aoColumns": [
	            { "mDataProp": "id" },
	            { "mDataProp": "etapa" },
	            { "mDataProp": "campeonato" },
	            { "mDataProp": "status" },
	            { "mDataProp": "acoes" }
	        ],
			//"bFilter":  false,
			"oLanguage": {
	            "sUrl": base_url + "assets/js/dataTables.pt-BR.txt"
	        },
			"aoColumnDefs": [
				{ "sClass": "center", "aTargets": [ 3, 4 ] },
				{ "sWidth": "10%", "aTargets": [ 3 ] },
				{ "sWidth": "15%", "aTargets": [ 4 ] }
			]
		} );

		// Inscrições pendente, parte administrativa
		$('#admin_inscricoes_pendentes').dataTable( {
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"sAjaxSource" : base_url + 'rest/inscricoes/pendentes',
			"aoColumns": [
	            { "mDataProp": "id" },
	            { "mDataProp": "atleta" },
	            { "mDataProp": "etapa" },
	            { "mDataProp": "campeonato" },
	            { "mDataProp": "status" },
	            { "mDataProp": "acoes" }
	        ],
			//"bFilter":  false,
			"oLanguage": {
	            "sUrl": base_url + "/assets/js/dataTables.pt-BR.txt"
	        },
			"aoColumnDefs": [
				{ "sClass": "center", "aTargets": [ 4, 5 ] },
				{ "sWidth": "10%", "aTargets": [ 4 ] },
				{ "sWidth": "15%", "aTargets": [ 5 ] }
			]
		} );

		// Início Etapas Cadastradas
		$('#etapas_cadastradas').dataTable( {
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"sAjaxSource" : base_url + 'rest/etapas/cadastradas',
			"aoColumns": [
                { "mDataProp": "id" },
	            { "mDataProp": "nome" },
	            { "mDataProp": "campeonato" },
	            { "mDataProp": "localidade" },
	            { "mDataProp": "status" },
	            { "mDataProp": "acoes" }
	        ],
			"bFilter":  false,
			"oLanguage": {
	            "sUrl": base_url + "assets/js/dataTables.pt-BR.txt"
	        },
			"aoColumnDefs": [
                { "bVisible": false, "aTargets": [ 0 ] },
                { "sClass": "center", "aTargets": [ 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4, 5 ] }
			],
            "aaSorting" : [
                [ 0 , "asc" ]
            ]
		} );

		// Habilita tooltip nos links
		$("a[rel=tooltip]").tooltip();
		$("button[rel=tooltip]").tooltip();

		$("a[rel=popover]").popover();
		$("input[rel=popover]").popover();

		// Máscaras
		$('#usuario_cpf').mask('999.999.999-99');
		$('.dataBR').mask('99/99/9999');

		// Colorbox nos links
		$('a.thumbnail').colorbox();

		// Jquery chosen nos select box
		$(".chzn-select").chosen();

		$('#redactor_content').redactor({
			fixed:      true,
			autoresize: true
		});
	} );
})(jQuery);