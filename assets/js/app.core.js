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
            "oLanguage": {
                "sUrl": base_url + "assets/js/dataTables.pt-BR.txt"
            },
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
        /*$('#noticiaVisualizar').find('#toolbar-actions').hide();
        $('#noticiaVisualizar').mouseenter(function(){
            $(this).find('#toolbar-actions').stop().fadeIn('fast');
        }).mouseleave(function(){
                $(this).find('#toolbar-actions').stop().fadeOut('fast');
        });*/

        $('#lastNews a.btn').each(function() {
            $(this).hide();
        });

        $('#lastNews td').mouseenter(function(){
            $(this).find('a.btn').show();
        }).mouseleave(function(){
                $(this).find('a.btn').hide();
        });

        // Fecha o modal ao seleciona um tipo de formato de arquivo
        $('#btnFGO, #btnCBO').click(function() {
            $('#exportModal').modal('hide');
        });

        // Tooltips and popover using bootstrap
        $('a[rel=tooltip], button[rel=tooltip], input[rel=tooltip]').tooltip();
        $('a[rel=popover], button[rel=popover], input[rel=popover]').popover();

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
            $('a.comprovanteMiniatura').colorbox();
        }

        if(jQuery().chosen)
        {
            // Jquery chosen nos select box
            $(".chzn-select").chosen();
        }

        if(jQuery().redactor)
        {
            $('#inscricao_resposta').redactor({
                autoresize: true,
                focus: false,
                autoformat: false,
                toolbar: 'mini',
                lang: 'pt_br',
                css: 'wym.css'
            });

            $('.redactor_content').redactor({
                autoresize: true,
                focus: false,
                lang: 'pt_br',
                css: 'wym.css'
            });
        }

        /**
         * Trata os eventos de aprovar e desaprovar um inscrição
         *
         */
        amplify.request.define('inscricaoUpdate', 'ajax', {
            url: base_url + 'admin/inscricoes/update',
            dateType: 'json',
            type: 'POST'
        });
        $('button.updateBtn').click(function(event) {
            // Desabilita o botao
            $.noty.closeAll();
            $('button.updateBtn').tooltip('hide');
            $('button.updateBtn').attr('disabled', 'disabled');

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
                            $('button.updateBtn').next('button').removeAttr('disabled');

                        }
                        else
                        {
                            $('#inscricaoStatus').html('<strong>Status: </strong><span class="label label-important">Rejeitada</span>');
                            $('button.updateBtn').prev('button').removeAttr('disabled');
                        }

                    }
                    else
                    {
                        $('button.updateBtn').remoteAttr('disabled');
                    }

                    noty({
                        text: data.msg,
                        layout: 'bottom',
                        type: data.valid ? 'success' : 'error',
                        speed: 200
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $('button.updateBtn').remoteAttr('disabled');
                    noty({
                        text: 'Não foi possível atualizar esta inscrição.',
                        layout: 'bottom',
                        type: 'error'
                    });
                }
            });
        });

        /**
         *
         */
        amplify.request.define('inscricaoDelete', 'ajax', {
            url: base_url + 'inscricoes/excluir',
            dateType: 'json',
            type: 'POST'
        });
        $('button#inscricaoExcluir').click(function(event){
            event.preventDefault();
            noty({
                text: 'Você realmente deseja excluir esta inscrição?',
                layout: 'center',
                buttons: [{
                    type: 'btn btn-mini btn-primary',
                    text: 'Sim',
                    click: function($noty) {
                        var dados = {
                            inscricao_id: $('button#inscricaoExcluir').data('inscricao-id')
                        }
                        $noty.close();
                        amplify.request({
                            resourceId: 'inscricaoDelete',
                            data: dados,
                            success: function(data, textStatus, XMLHttpRequest) {
                                if(data.valid){
                                    noty({
                                        timeout: 1000,
                                        text: data.msg,
                                        layout: 'bottom',
                                        type: 'success',
                                        onClose: function(){
                                            document.location.href = base_url;
                                        }
                                    });
                                }
                                else {
                                    noty({
                                        text: data.msg,
                                        layout: 'bottom',
                                        type: 'error'
                                    });
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                noty({
                                    text: 'Não foi possível excluir esta inscrição.',
                                    layout: 'bottom',
                                    type: 'error'
                                });
                            }
                        });
                    }
                },{
                    type: 'btn btn-mini btn-danger',
                    text: 'Não',
                    click: function($noty) {
                        $noty.close();
                    }
                }],
                closable: false,
                timeout: false,
                modal: true
            });
        })
    });
})(jQuery);