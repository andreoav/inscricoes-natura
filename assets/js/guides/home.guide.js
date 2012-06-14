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

		function redir2etapas()
		{
			$(window.document.location).attr("href", base_url + "inscricoes#guider=g6");
		}

		guiders.createGuider({
		 	buttons: [{name: "Não, obrigado!", onclick: cancelGuide},
                	  {name: "Sim, desejo aprender!", onclick: guiders.next}],
		 	description: "Este é o novo sistema de inscrições do Natura Clube de Orientação. Se você desejar, este guia pode ensinar-lhe as funcionalidades presentes no sistema.",
		 	id: "g1",
		 	next: "g2",
		 	overlay: true,
		 	title: "Bem Vindo ao Sistema de Inscrições!"
		});

		guiders.createGuider({
			buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                	  {name: "Próximo", onclick: guiders.next}],
            description: "Esta é a página inicial do sistema, nesta tela você pode ver as últimas notícias inseridas pelo administrador assim como cada uma de suas inscrições.",
            id: "g2",
            next: "g3",
            overlay: true,
            title: "1. Página Inicial"
		});

		guiders.createGuider({
			attachTo: "#newsCarousel",
			buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                	  {name: "Próximo", onclick: guiders.next}],
            description: "Aqui serão mostradas as últimas notícias do sistema.</br >Clique no botão <button class=\"btn btn-info btn-mini\">Leia Mais &raquo;</button> para ver a versão completa da notícia.",
            position: 12,
            id: "g3",
            next: "g4",
            overlay: true,
            title: "2. Notícias"
		});

		guiders.createGuider({
			attachTo: "#inscricoes_feitas",
			buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                	  {name: "Próximo", onclick: guiders.next}],
            description: "Aqui uma tabela irá mostrar todas as suas inscrições, assim como o status de cada uma delas.",
            position: 12,
            id: "g4",
            next: "g5",
            overlay: true,
            title: "3. Inscrições"
		});

		guiders.createGuider({
			attachTo: "#navegacao",
			buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                	  {name: "Próximo", onclick: redir2etapas}],
            description: "Este menu possui os links que você precisa para acessar todos os recursos do sistema. Clicando em \"próximo\" redirecionaremos você para a lista de etapas disponíveis.",
            position: 3,
            id: "g5",
            next: "g6",
            overlay: true,
            title: "3. Navegação"
		});

	});
})(jQuery);