(function($){
	/* Table initialisation */
	$(document).ready(function() {

		function cancelGuide()
		{
			guiders.hideAll();
			$.ajax({
				url: "usuario/cancelGuide",
				type: "POST",
				data: { 
					cancelGuide: true 
				},
			});
		}

		guiders.createGuider({
		 	buttons: [{name: "Não, obrigado!", onclick: cancelGuide},
                	  {name: "Sim, desejo aprender!", onclick: guiders.next}],
		 	description: "Este é o novo sistema de inscrições do Natura Clube de Orientação. Se você desejar, este guia pode ensinar-lhe as funcionalidades presentes no sistema.",
		 	id: "first",
		 	next: "second",
		 	overlay: true,
		 	title: "Bem Vindo ao Sistema de Inscrições!"
		}).show();

		guiders.createGuider({
			buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                	  {name: "Próximo", onclick: guiders.next}],
            description: "Esta é a página inicial do sistema, ....",
            id: "second",
            next: "third",
            overlay: true,
            title: "1: Página Inicial"
		});

	});
})(jQuery);