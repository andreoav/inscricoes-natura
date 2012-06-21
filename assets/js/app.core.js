(function($){
    /* Table initialisation */
    $(document).ready(function() {

        // Inscrições do atleta na página inicial
        $('#inscricoes_feitas').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "sAjaxSource" : base_url + 'inscricoes/minhas_inscricoes',
            "aoColumns": [
                { "mDataProp": "id" },
                { "mDataProp": "etapa" },
                { "mDataProp": "campeonato" },
                { "mDataProp": "status" },
                { "mDataProp": "acoes" }
            ],
            //"bFilter":  false,
            /*"oLanguage": {
                "sUrl": base_url + "assets/js/dataTables.pt-BR.txt"
            },*/
            "aoColumnDefs": [
                { "sClass": "center", "aTargets": [ 0, 3, 4 ] },
                { "sWidth": "5%", "aTargets": [ 0 ] },
                { "sWidth": "10%", "aTargets": [ 3 ] },
                { "sWidth": "15%", "aTargets": [ 4 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ]
        });

        // Inscrições pendente, parte administrativa
        $('#admin_inscricoes_pendentes').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "sAjaxSource" : base_url + 'admin/inscricoes/pendentes',
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
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ]
        });

        // Inscrições pendente, parte administrativa
        $('#admin_inscricoes_todas').dataTable({
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "sAjaxSource" : base_url + 'admin/inscricoes/inscricoes',
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
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ]
        });

        // Início Etapas Cadastradas
        $('#etapas_cadastradas').dataTable( {
            "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "sAjaxSource" : base_url + 'etapas/cadastradas',
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
                [ 0 , "desc" ]
            ]
        });

        // Botões com mouseover
        $('#noticiaVisualizar').find('#toolbar-actions').hide();
        $('#noticiaVisualizar').mouseenter(function(){
            $(this).find('#toolbar-actions').stop().fadeIn('fast');
        }).mouseleave(function(){
                $(this).find('#toolbar-actions').stop().fadeOut('fast');
        });

        // Fecha o modal ao seleciona um tipo de formato de arquivo
        $('#btnFGO, #btnCBO').click(function() {
            $('#exportModal').modal('hide');
        });

        $('.carousel').carousel();
        $('a[title], button[title]').qtip({
            position: {
                at: 'top center',
                my: 'bottom center'
            },
            show: {
                delay: 0
            },
            style: {
                classes: 'ui-tooltip-shadow ui-tooltip-tipsy'
            }
        });

        $("input[rel=popover]").popover();

        // Datepicker
        $('.datepicker').datepicker({
            'format': 'dd/mm/yyyy'
        });

        // Máscaras
        if(jQuery().mask)
        {
            $('#usuario_cpf').mask('999.999.999-99');
            $('.dataBR').mask('99/99/9999');
        }

        // Colorbox nos links
        if(jQuery().colorbox)
        {
            $('a.thumbnail').colorbox();
        }

        if(jQuery().chosen)
        {
            // Jquery chosen nos select box
            $(".chzn-select").chosen();
        }

        if(jQuery().redactor)
        {
            $('.redactor_content').redactor({
                autoresize: true,
                css: 'wym.css'
            });
        }
    });
})(jQuery);