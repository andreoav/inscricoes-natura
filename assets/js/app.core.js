(function($){

    /**
     * Jquery DataTable plugin to reload the table content with
     * an new Ajax Call.
     *
     * @param oSettings
     * @param sNewSource
     * @param fnCallback
     * @param bStandingRedraw
     */
    $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
    {
        if ( typeof sNewSource != 'undefined' && sNewSource != null )
        {
            oSettings.sAjaxSource = sNewSource;
        }
        this.oApi._fnProcessingDisplay( oSettings, true );
        var that = this;
        var iStart = oSettings._iDisplayStart;
        var aData = [];

        this.oApi._fnServerParams( oSettings, aData );

        oSettings.fnServerData( oSettings.sAjaxSource, aData, function(json) {
            /* Clear the old information from the table */
            that.oApi._fnClearTable( oSettings );

            /* Got the data - add it to the table */
            var aData =  (oSettings.sAjaxDataProp !== "") ?
                that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

            for ( var i=0 ; i<aData.length ; i++ )
            {
                that.oApi._fnAddData( oSettings, aData[i] );
            }

            oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
            that.fnDraw();

            if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
            {
                oSettings._iDisplayStart = iStart;
                that.fnDraw( false );
            }

            that.oApi._fnProcessingDisplay( oSettings, false );

            /* Callback user function - for event handlers etc */
            if ( typeof fnCallback == 'function' && fnCallback != null )
            {
                fnCallback( oSettings );
            }
        }, oSettings );
    };

    /* Table initialisation */
    $(document).ready(function() {

        function enableJqueryContent() {
            $('tbody td a').each(function(){
                $(this).tooltip();
            });
        }

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
                { "bSortable": false, "aTargets": [ 4 ] },
                { "sClass": "center", "aTargets": [ 0, 3, 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 4 ] },
                { "sWidth": "10%", "aTargets": [ 3 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                enableJqueryContent();
            }
        });

        // Inscrições pendente, parte administrativa
        var tPendentes = $('#admin_inscricoes_pendentes').dataTable({
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
                { "bSortable": false, "aTargets": [ 5 ] },
                { "sClass": "center", "aTargets": [ 0, 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            "bRetrieve": true,
            fnDrawCallback: function(){
                enableJqueryContent();
            }
        });

        // Atualiza a tabela de inscrições pendentes a cada 30 segundos
        if(! _.isEmpty(_.values(tPendentes)))
        {
            setInterval(function(){
                tPendentes.fnReloadAjax();
            }, 30000);
        }
        // Fim das inscrições pendentes

        // Inscrições Existentes, parte administrativa
        var tTodas = $('#admin_inscricoes_todas').dataTable({
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
                { "bSortable": false, "aTargets": [ 5 ] },
                { "sClass": "center", "aTargets": [ 0, 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 0, 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                enableJqueryContent();
            }
        });

        // Atualiza a tabela de inscrições existentes a cada 30 segundos
        if(! _.isEmpty(_.values(tTodas)))
        {
            setInterval(function(){
                tTodas.fnReloadAjax();
            }, 30000);
        }
        // Fim das inscricoes existentes

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
                { "bSortable": false, "aTargets": [ 5 ] },
                { "bVisible": false, "aTargets": [ 0 ] },
                { "sClass": "center", "aTargets": [ 4, 5 ] },
                { "sWidth": "10%", "aTargets": [ 4 ] },
                { "sWidth": "5%", "aTargets": [ 5 ] }
            ],
            "aaSorting" : [
                [ 0 , "desc" ]
            ],
            fnDrawCallback: function(){
                enableJqueryContent();
            }
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

        if(jQuery().pluploadQueue)
        {
            $("#arquivos_upload").pluploadQueue({
                // General settings
                runtimes : 'html5,html4,browserplus',
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

            noty({
                text: 'Atualizando inscrição, aguarde...',
                layout: 'center',
                speed: 200,
                modal: true,
                timeout: false,
                closeOnSelfClick: false
            });

            // faz a chamada ajax
            amplify.request({
                resourceId: 'inscricaoUpdate',
                data: dados,
                success: function(data, textStatus, XMLHttpRequest)
                {
                    $.noty.closeAll();
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
                        $('button.updateBtn').removeAttr('disabled');
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
                    $('button.updateBtn').removeAttr('disabled');
                    $.noty.closeAll();
                    noty({
                        text: 'Não foi possível atualizar esta inscrição.',
                        layout: 'bottom',
                        type: 'error'
                    });
                }
            });
        });

        /**
         * AJAX request para excluir uma inscrição
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
        });
        // Fim $('button#inscricaoExcluir').click();

        /**
         * Load More Button
         * Carrega mais notícias
         */
        amplify.request.define('loadMoreNoticias', 'ajax',{
            url: base_url + 'noticias/loadMore',
            dateType: 'json',
            type: 'POST'
        });

        var btnMore = $('button.more');
        btnMore.live('click', function(){
            var ID = $(this).attr('id');

            if(ID) {
                btnMore.button('loading');
                amplify.request({
                    resourceId: 'loadMoreNoticias',
                    data: {
                        last_id: ID
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        if(data.valid)
                        {
                            $.each(data.news, function(i, item){
                                var horario = new XDate(item.created_at * 1000, true).toString('dd/MM HH:mm');
                                $('div#newsContainer').append(
                                    '<div class="row hide" id="noticia"><div class="span1"><span class="label label-info">'+ horario +'</span></div>' +
                                    '<div class="span11"><p class="lead"><a href="' + base_url + 'noticias/' + item.id + '">' + item.titulo + '</a>' +
                                    '</p><p>' + item.conteudo + '</p></div></div><hr>'
                                );
                                $('div#newsContainer div.row').each(function(){
                                    if($(this).hasClass('hide')){
                                        $(this).slideDown('slow');
                                    }
                                });
                            });

                            if(data.last_id == null)
                            {
                                btnMore.attr('disabled', 'disabled');
                                btnMore.html('Ops, não temos mais notícias para exibir.');

                                noty({
                                    text: 'Todas as notícias do site foram carregadas.',
                                    type: 'information',
                                    layout: 'bottom',
                                    speed: 200
                                });

                            } else
                            {
                                btnMore.button('reset');
                                btnMore.attr('id', data.last_id);
                            }
                        }
                        else
                        {
                            noty({
                                text: data.msg,
                                type: 'error',
                                layout: 'bottomRight',
                                speed: 200
                            });

                            btnMore.button('reset');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        noty({
                            text: 'Ocorreu um erro ao carregar as notícias.',
                            type: 'error',
                            layout: 'bottomRight',
                            speed: 200
                        });

                        btnMore.button('reset');
                    }
                });
            }
            else {
                btnMore.attr('disabled', 'disabled');
                btnMore.html('Ops, não temos mais notícias para exibir.');
            }
        });
        /**
         * End Load More Button
         */

    });
})(jQuery);