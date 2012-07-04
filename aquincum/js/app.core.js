$(function() {

    $.jGrowl.defaults.position = 'bottom-right';
    function reEnableJqueryContent()
    {
        $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
        $('.tipS').tipsy({gravity: 's',fade: true, html:true});
        $('.tipW').tipsy({gravity: 'w',fade: true, html:true});
        $('.tipE').tipsy({gravity: 'e',fade: true, html:true});
    }

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

    $('#etapas_cadastradas').dataTable( {
        "bJQueryUI": false,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "sDom": '<"H"fl>t<"F"ip>',
        "sAjaxSource" : base_url + 'etapas/cadastradas',
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
        "sAjaxSource" : base_url + 'admin/inscricoes/pendentes',
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
        "sAjaxSource" : base_url + 'admin/inscricoes/inscricoes',
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
    })

    $("#arquivos_upload").pluploadQueue({
        // General settings
        runtimes : 'html5,html4',
        url : base_url + 'admin/etapas/upload',
        max_file_size : '10mb',
        chunk_size : '1mb',
        unique_names : true,

        // Resize images on clientside if we can
        resize : {width : 320, height : 240, quality : 90},

        // Specify what files to browse for
        filters : [
            {title : "Arquivos de Imagem", extensions : "jpg,gif,png"},
            {title: "Arquivos PDF", extensions: "pdf"},
            {title: "Arquivos do Word", extensions: "doc, docx"}
        ]
    });

    // WYSIWYG Editor
    $('.wysiwyg').cleditor({
        width:"100%",
        height:"250px",
        bodyStyle: "margin: 10px; font: 12px Arial,Verdana; cursor:text",
        useCSS:true
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

        loading_modal.dialog('open');
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

                loading_modal.dialog('close');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $.jGrowl('Ocorreu um erro durante a atualização.', { header: 'Ops!' });
                loading_modal.dialog('close');
            }
        });

        return false;
    });
    // ========= Atualizar Inscrição ========= //

    // ========= Inscrição Resposta ========= //
    var loading_modal = $('<div id="loading_dialog"></div>')
        .html('<p><img src=' + base_url + 'aquincum/images/elements/loaders/10s.gif' + '> Sua requisição está sendo processada.</p>')
        .dialog({
            height: 85,
            title: 'Aguarde...',
            closeOnEscape: false,
            autoOpen: false,
            modal: true
        });

    var resposta_form = $('#inscricao_resposta_form').validate({
        rules: {
            inscricao_resposta: "required"
        },
        submitHandler: function( form ) {
            var dados = $(form).serialize();

            loading_modal.dialog('open');

            $.ajax({
                type: "POST",
                url:  base_url + 'inscricoes/responder',
                data: dados,
                success: function(data, textStatus, XMLHttpRequest) {
                    loading_modal.dialog('close');
                    $.jGrowl(data.msg, { header: 'Nova Resposta!' });

                    if(data.valid)
                    {
                        var dataAtual = new XDate();
                        if($('div#inscricao_mensagens ul.messagesTwo').length == 0) {
                            $('div#inscricao_mensagens').append('<div class="widget"><div class="whead"><h6>Respostas</h6>' +
                                '<div class="clear"></div></div><ul class="messagesTwo"></ul></div>'
                            );
                        }

                        $('ul.messagesTwo').append('<li class="by_me"><a href="#"><img width="37" height="37" src="' + base_url + 'aquincum/images/icons/color/user.png' +
                            '"></a><div class="messageArea"><div class="infoRow"><span class="name"><strong>' +
                            $('input#inscricaoUSER').val() + '</strong>  postou:</span><span class="time">' +
                            dataAtual.toString("dd/MM/yyyy 'às' HH:mm:ss") + '</span><span class="clear"></span></div>' +
                            $('input#inscricao_resposta').val() + '</div></li>');

                        $('ul.messagesTwo li.by_me:last').hide();
                        $('ul.messagesTwo li.by_me:last').slideDown('slow');
                        resposta_form.resetForm();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    loading_modal.dialog('close');
                    resposta_form.resetForm();
                }
            });

            return false;
        }
    });
    // ========= Inscrição Resposta FIm ========= //


    // ========= Excluir Inscrição ========= //
    amplify.request.define('inscricaoDelete', 'ajax', {
        url: base_url + 'inscricoes/excluir',
        dateType: 'json',
        type: 'POST'
    });

    var excluir_inscricao_modal = $('<div id="excluir_inscricao_modal"></div>')
        .html('Deseja realmente excluir esta inscrição?')
        .dialog({
            height: 140,
            title: 'Confirmar exclusão',
            closeOnEscape: false,
            autoOpen: false,
            modal: true,
            buttons: {
                'Sim': function() {
                    $(this).dialog('close');
                    var dados = {
                        inscricao_id: $('a#inscricaoExcluir').data('inscricao-id')
                    }
                    amplify.request({
                        resourceId: 'inscricaoDelete',
                        data: dados,
                        success: function(data, textStatus, XMLHttpRequest) {
                            if(data.valid) {
                                $.jGrowl(data.msg, {
                                    life: 1000,
                                    header: 'Inscrição Excluída!',
                                    beforeClose: function() {
                                        document.location.href = base_url;
                                    }
                                });
                            }
                            else {
                                $.jGrowl(data.msg, { header: 'Ops!' });
                            }
                        }
                    });
                },
                'Não': function()
                {
                    $(this).dialog('close');
                }
            }
        });

    $('a#inscricaoExcluir').click(function(event){
        event.preventDefault();
        excluir_inscricao_modal.dialog('open');
    });
    // ========= Excluir Inscrição FIM ========= //


    // ================= NOVA INSCRICAO INICIO ========================//
    amplify.request.define('informacaoEtapa', 'ajax', {
        url: base_url + 'etapas/informacaoEtapa',
        dateType: 'json',
        type: 'POST'
    });

    var previous_etapa = -1;
    $('div#informacao_etapa_container').hide();
    $('select#inscricao_etapa').bind("change", function() {
        if(previous_etapa != $(this).val())
        {
            previous_etapa = $(this).val();

            $('div#informacao_etapa_container').fadeOut();
            amplify.request({
                resourceId: 'informacaoEtapa',
                data: {
                    etapa_id: $(this).val()
                },
                success: function(data, textStatus, XMLHttpRequest) {
                    if(data.valid)
                    {
                        $('div#informacao_etapa').html('<ul class="liInfo">' +
                            '<li><strong>Localidade: </strong>' + data.localidade + '</li>' +
                            '<li><strong>Data de Início: </strong>' + XDate(data.inicio * 1000).toString('dd/MM/yyyy') + '</li>' +
                            '<li><strong>Data de Encerramento: </strong>' + XDate(data.fim * 1000).toString('dd/MM/yyyy') + '</li>' +
                            '<li><strong>Inscrições até: </strong>' + XDate(data.ate * 1000).toString('dd/MM/yyyy') + '</li>' +
                            '</ul>'
                        );

                        $('div#informacao_etapa_container').fadeIn();
                    }
                }
            });
        }
    });
    // ================= NOVA INSCRICAO FINAL ========================//

    $('#usuario_cpf').mask('999.999.999-99');


    $('#inscritos_modal').dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Padrão CBO": function() {
                $(this).dialog('close');
                document.location.href = base_url + 'admin/etapas/inscritos/' + $('a#lista_inscritos').data('etapa-id') + '/2/'
            },
            "Padrão FGO": function() {
                $(this).dialog('close')
                document.location.href = base_url + 'admin/etapas/inscritos/' + $('a#lista_inscritos').data('etapa-id') + '/1/'
            }
        }
    });

    $('a#lista_inscritos').click(function(event) {
        event.preventDefault();
        $('#inscritos_modal').dialog('open');
    });








    // ======================= FIM CARREGAR MAIS =============================/
    amplify.request.define('loadMoreNoticias', 'ajax', {
        url: base_url + 'noticias/loadMore',
        dateType: 'json',
        type: 'POST'
    });

    var btnMore = $('a#noticias_carregar_mais');
    btnMore.live('click', function(event) {
        event.preventDefault();
        var ID = $('ul.updates').data('last-id');

        $('span.headLoad').html('<img src="' + base_url + 'aquincum/images/elements/loaders/1s.gif" />');

        if(ID) {

            amplify.request({
                resourceId: 'loadMoreNoticias',
                data: {
                    last_id: ID
                },
                success: function(data, textStatus, XMLHttpRequest) {
                    if(data.valid)
                    {
                        $.each(data.news, function(i, item){

                            $('ul.updates').append(
                                '<li class="hide" style="display: none;"><span class="uNotice"><a title="Clique aqui para ler mais" class="tipS" href="'
                                + base_url + 'noticias/' + item.id + '">' + item.titulo + '</a><span>'+ item.conteudo.substring(0, 90) + '...</span></span>' +
                                '<span class="uDate"><span>' + XDate(item.created_at * 1000, true).toString('dd') + '</span>' +
                                XDate(item.created_at * 1000, true).toString('MMM')+ '</span>' +
                                '<span class="clear"></span></li>'
                            );

                            $('ul.updates li').each(function(){
                                if($(this).hasClass('hide')) {
                                    $(this).fadeIn(1000);
                                }
                            });

                        });

                        if(data.last_id == null)
                        {
                            $.jGrowl('Não há mais notícias para carregar!', { header: 'Notícias carregadas!' });
                            btnMore.hide();
                        }
                        else
                        {
                            $('ul.updates').data('last-id', data.last_id)
                        }

                        $('span.headLoad').html('');
                        reEnableJqueryContent();
                    }
                    else
                    {
                        $.jGrowl('Não há mais notícias para carregar!', { header: 'Notícias carregadas!' });
                        btnMore.hide();
                    }
                }
            });
        }
        else
        {
            btnMore.hide();
        }
    });
    // ======================= FIM CARREGAR MAIS =============================/

});


