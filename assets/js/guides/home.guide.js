(function($){
	/* Table initialisation */
	$(document).ready(function() {

		function cancelGuide()
		{
			guiders.hideAll();
			$.ajax({
				url: base_url + "usuario/cancelGuide",
				type: "POST",
				data: { 
					cancelGuide: true 
				},
			});
		}

		function redir2etapas()
		{
            $(window.document.location).attr("href", base_url + "etapas#guider=g6");
		}

        function redir2perfil()
        {
            $(window.document.location).attr("href", base_url + "usuario/perfil#guider=g7");
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
            description: "Aqui serão mostradas as últimas notícias do sistema.<br />Clique no botão <button class=\"btn btn-info btn-mini\">Leia Mais &raquo;</button> para ver a versão completa da notícia.",
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

        guiders.createGuider({
            attachTo: "#etapas_cadastradas",
            buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                      {name: "Próximo", onclick: redir2perfil}],
            description: "Esta tabela possui todas as etapas cadastradas no sistema. Nela você pode ver quais ainda estão com inscrições abertas, onde será realizada e à que campeonado pertence.<br /><br />Clicando em <button class=\"btn btn-mini btn-primary\">Visualizar</button> você levará você até as informações completas da etapa.",
            //position: 9,
            id: "g6",
            next: "g7",
            overlay: true,
            title: "4. Etapas"
        });

        guiders.createGuider({
            buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                {name: "Próximo", onclick: guiders.next}],
            description: "Para que seja possível realizar um inscrição, primeiro você deve cadastrar algumas informações necessárias em seu perfil. Essas informações só precisam ser cadastradas <strong>uma única vez</strong>, não sendo necessário digitá-las a cada inscrição.",
            id: "g7",
            next: "g8",
            overlay: true,
            title: "5. Perfil"
        });

        guiders.createGuider({
            attachTo: "#user_menu",
            buttons: [{name: "Finalizar guia", onclick: cancelGuide},
                {name: "Próximo", onclick: guiders.next}],
            description: "Para acessar o seu perfil, basta utilizar este botão.",
            position: 6,
            id: "g8",
            next: "g9",
            overlay: true,
            title: "5.1 Perfil"
        });

        guiders.createGuider({
            buttons: [{name: "Finalizar guia", onclick: cancelGuide}],
            description: "Parabéns, chegamos ao final do nosso guia. Clique em \"finalizar guia\" e já aproveite para preencher o seu perfil.",
            id: "g9",
            overlay: true,
            title: "6. Fim"
        });

	});
})(jQuery);