$(function() {

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

    function reEnableJqueryContent()
    {
        $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
        $('.tipS').tipsy({gravity: 's',fade: true, html:true});
        $('.tipW').tipsy({gravity: 'w',fade: true, html:true});
        $('.tipE').tipsy({gravity: 'e',fade: true, html:true});
    }

    //===== Validação Login =====//
    $('form#login').validate({
        rules: {
            username: {
                required: true,
                email:    true
            },
            password: "required"
        }
    });

    //===== Validação Cadastro =====//
    $('form#recover').validate({
        rules: {
            username: {
                required: true,
                email:    true
            },
            password: "required",
            password_2: {
                required: true,
                equalTo: '#password'
            }
        }
    });

    $('#minhas_inscricoes').dataTable({
        "bJQueryUI": false,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "sDom": '<"H"fl>t<"F"ip>',
        "sAjaxSource" : base_url + 'inscricoes/minhas_inscricoes',
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
});


