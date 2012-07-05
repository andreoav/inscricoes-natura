$(function() {

    // Tradução do dataTable para portugues
    var dataTablePT = {
        "sProcessing":   "Processando...",
        "sLengthMenu":   "Mostrar _MENU_ registros",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
        "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Buscar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        }
    }

    $(document).ready(function() {

        $('#minhas_inscricoes').dataTable({
            "bJQueryUI": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"fl>t<"F"ip>',
            "sAjaxSource" : base_url + 'inscricoes/minhas_inscricoes.json',
            "aoColumns": [
                { "mDataProp": "id" },
                { "mDataProp": "etapa" },
                { "mDataProp": "campeonato" },
                { "mDataProp": "status" },
                { "mDataProp": "acoes" }
            ],
            "oLanguage": dataTablePT,
            "aoColumnDefs": [
                { "sClass": "center", "aTargets": [ 0, 3, 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 4 ] },
                { "sWidth": "10%", "aTargets": [ 3 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                reEnableJqueryContent();
            }
        });

        $('#etapas_cadastradas').dataTable( {
            "bJQueryUI": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"fl>t<"F"ip>',
            "sAjaxSource" : base_url + 'etapas/cadastradas.json',
            "aoColumns": [
                { "mDataProp": "id" },
                { "mDataProp": "nome" },
                { "mDataProp": "campeonato" },
                { "mDataProp": "localidade" },
                { "mDataProp": "status" },
                { "mDataProp": "acoes" }
            ],
            "oLanguage": dataTablePT,
            "aoColumnDefs": [
                { "bVisible": false, "aTargets": [ 0 ] },
                { "sClass": "center", "aTargets": [ 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                reEnableJqueryContent();
            }
        });

        // =============== INSCRICOES PENDENTES =================//
        // Inscrições pendente, parte administrativa
        var tPendentes = $('#admin_inscricoes_pendentes').dataTable({
            "bJQueryUI": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"fl>t<"F"ip>',
            "sAjaxSource" : base_url + 'admin/inscricoes/pendentes.json',
            "aoColumns": [
                { "mDataProp": "id" },
                { "mDataProp": "atleta" },
                { "mDataProp": "etapa" },
                { "mDataProp": "campeonato" },
                { "mDataProp": "status" },
                { "mDataProp": "acoes" }
            ],
            "oLanguage": dataTablePT,
            "aoColumnDefs": [
                { "sClass": "center", "aTargets": [ 0, 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            "bRetrieve": true,
            fnDrawCallback: function(){
                reEnableJqueryContent();
            }
        });

        // ============ ADMIN TODAS INSCRICOES ====================//
        // Inscrições Existentes, parte administrativa
        var tTodas = $('#admin_inscricoes_todas').dataTable({
            "bJQueryUI": false,
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "sDom": '<"H"fl>t<"F"ip>',
            "sAjaxSource" : base_url + 'admin/inscricoes/inscricoes.json',
            "aoColumns": [
                { "mDataProp": "id" },
                { "mDataProp": "atleta" },
                { "mDataProp": "etapa" },
                { "mDataProp": "campeonato" },
                { "mDataProp": "status" },
                { "mDataProp": "acoes" }
            ],
            "oLanguage": dataTablePT,
            "aoColumnDefs": [
                { "sClass": "center", "aTargets": [ 0, 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                reEnableJqueryContent();
            }
        });

    });

});