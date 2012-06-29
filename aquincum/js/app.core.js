$(function() {

    $.jGrowl.defaults.position = 'bottom-right';

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

    // ========= Atualizar Inscrição  ========= //
    amplify.request.define('inscricaoUpdate', 'ajax', {
        url: base_url + 'admin/inscricoes/update',
        dateType: 'json',
        type: 'POST'
    });

    $('a.updateBtn').click(function(event) {
        var dados = {
            inscricao_id: $(this).data('inscricao-id'),
            update_type:  $(this).data('update-type') == 'aprovar' ? 1 : 0
        }

        // faz a chamada ajax
        amplify.request({
            resourceId: 'inscricaoUpdate',
            data: dados,
            success: function(data, textStatus, XMLHttpRequest)
            {
                if(data.valid)
                {
                    if(dados.update_type == 1)
                    {
                        $('#inscricaoStatus').html('<strong>Status: </strong><span class="label label-success">Aprovada</span>');
                        $.jGrowl(data.msg, { header: 'Atualização Concluída' });
                    }
                    else
                    {
                        $('#inscricaoStatus').html('<strong>Status: </strong><span class="label label-important">Rejeitada</span>');
                        $.jGrowl(data.msg, { header: 'Atualização Concluída' });
                    }

                }
                else
                {
                    $.jGrowl(data.msg, { header: 'Ops!' });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $.jGrowl('Ocorreu um erro durante a atualização.', { header: 'Ops!' });
            }
        });

        return false;
    });
    // ========= Atualizar Inscrição  ========= //




    // TODO: Seperar JQUERY
    $('#inscricao_resposta_form').validate({
        rules: {
            inscricao_resposta: "required"
        }
        /*submitHandler: function( form ) {
            var dados = $(form).serialize();

            $.ajax({
                type: "POST",
                url:  base_url + 'inscricoes/responder/' + dados.inscricaoID,
                data: dados,
                success: function(data, textStatus, XMLHttpRequest) {

                }
            });

            return false;
        }*/
    });

});


