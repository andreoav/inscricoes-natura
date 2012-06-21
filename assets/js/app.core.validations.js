(function($){
	/* Table initialisation */
	$(document).ready(function() {

		// Default Options
		/*$.validator.setDefaults({
			errorClass: "help-inline",
			errorElement: "span",

		});*/

        $.validator.setDefaults({
            errorClass: "errormessage",
            onkeyup: false,
            errorClass: 'error',
            validClass: 'valid',
            highlight:function(element, errorClass, validClass)
            {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass)
            {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            errorPlacement: function(error, element)
            {
                // Set positioning based on the elements position in the form
                var elem = $(element),
                    corners = ['right center', 'left center'],
                    flipIt = elem.parents('span.left').length > 0;

                // Check we have a valid error message
                if(!error.is(':empty')) {
                    // Apply the tooltip only if it isn't valid
                    elem.filter(':not(.valid)').qtip({
                        overwrite: false,
                        content: error,
                        position: {
                            my: corners[ flipIt ? 0 : 1 ],
                            at: corners[ flipIt ? 1 : 0 ],
                            viewport: $(window)
                        },
                        show: {
                            event: false,
                            ready: true
                        },
                        hide: false,
                        style: {
                            classes: 'ui-tooltip-shadow ui-tooltip-red', // Make it red... the classic error colour!
                            height: "26px"
                        }
                    })

                        // If we have a tooltip on this element already, just update its content
                        .qtip('option', 'content.text', error);
                }

                // If the error is empty, remove the qTip
                else { elem.qtip('destroy'); }
            },
            success: $.noop // Odd workaround for errorPlacement not firing!
        });

		/**
		 * Validation para Data Brasileira
		 * @param  {[type]} value   [description]
		 * @param  {[type]} element [description]
		 * @return {[type]}         [description]
		 */
		$.validator.addMethod("dataBR", function(value, element) {
	    	if(value.length!=10)
	    		return false;

	    	var data        = value;
	    	var dia         = data.substr(0,2);
	    	var mes         = data.substr(3,2);
	    	var ano         = data.substr(6,4);
	    	if(data.length!=10 || isNaN(dia) || isNaN(mes) || isNaN(ano) || dia > 31 || mes > 12)
	    		return false;
	    	if((mes == 4|| mes == 6 || mes == 9 || mes == 11) && dia == 31)
	    		return false;
    		if(mes == 2 && ( dia > 29 || ( dia == 29 && ano % 4 != 0)))
    			return false;
    		return true;
			}, "Insira uma data válida"
		);

		function isCpf(cpf){
		    exp = /\.|-/g;
		    cpf = cpf.toString().replace(exp, "");
		    var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
		    var soma1=0, soma2=0;
		    var vlr =11;
		    for(i=0;i<9;i++){
		        soma1+=eval(cpf.charAt(i)*(vlr-1));
		        soma2+=eval(cpf.charAt(i)*vlr);
		        vlr--;
		    }
		    soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
		    soma2 = (((soma2+(2*soma1))*10)%11);

		    if(cpf == "11111111111" || cpf == "22222222222" || cpf ==
					"33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf ==
					"66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf ==
					"99999999999" || cpf == "00000000000" ){
				var digitoGerado = null;
		    }else{
		        var digitoGerado = (soma1*10) + soma2;
		    }

		    if(digitoGerado != digitoDigitado){
		       return false;
		    }
		    return true;
		}

		jQuery.validator.addMethod("cpfValido", function(value, element) {
		    value = value.replace('.','');
		    value = value.replace('.','');
		    cpf = value.replace('-','');
		    while(cpf.length < 11) cpf = "0"+ cpf;
		    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
		    var a = [];
		    var b = new Number;
		    var c = 11;
		    for (i=0; i<11; i++){
		        a[i] = cpf.charAt(i);
		        if (i < 9) b += (a[i] * --c);
		    }
		    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
		    b = 0;
		    c = 11;
		    for (y=0; y<10; y++) b += (a[y] * c--);
		    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
		    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
		    return true;
		}, "Insira um CPF válido."); // Mensagem padrão

		$('#nova_noticia_form').validate({
			rules: {
				noticia_titulo: {
					required: true
				}
			},
			messages: {
				noticia_titulo: {
					required: "Este campo é obrigatório."
				}
			}
		});

		$('#login-form').validate({
			rules: {
				username: {
					required: true
				},
				password: {
					required: true
				}
			},
			messages: {
				username: {
					required: "Este campo é obrigatório."
				},
				password: {
					required: "Este campo é obrigatório."
				}
			}
		});

		$('#cadastro_form').validate({
			rules: {
				cadastro_email: {
					required: true,
					email:    true
				},
				cadastro_usuario: {
					required: true
				},
				cadastro_senha: {
					required: true
				},
				cadastro_senha_verify: {
					required: true,
					equalTo: "#cadastro_senha"
				}
			},
			messages: {
				cadastro_email: {
					required: "Este campo é obrigatório.",
					email:    "Insira um email válido."
				},
				cadastro_usuario: {
					required: "Este campo é obrigatório."
				},
				cadastro_senha: {
					required: "Este campo é obrigatório."
				},
				cadastro_senha_verify: {
					required: "Este campo é obrigatório.",
					equalTo: "As senhas devem ser iguais."
				}
			}
		});

		$('#usuario_perfil_form').validate({
			rules: {
				usuario_nome: {
					required: true
				},
				usuario_identidade: {
					required: true
				},
				usuario_cpf: {
					required:  true,
					cpfValido: true
				},
				usuario_nascimento: {
					required: true,
					dataBR:   true
				},
                usuario_ncbo: {
                    required: true,
                    number:   true
                }
			},
			messages: {
				usuario_nome: {
					required: "Este campo é obrigatório."
				},
				usuario_identidade: {
					required: "Este campo é obrigatório."
				},
				usuario_cpf: {
					required: "Este campo é obrigatório."
				},
				usuario_nascimento: {
					required: "Este campo é obrigatório."
				},
                usuario_ncbo: {
                    required: "Este campo é obrigatório.",
                    number:   "Este campo só aceita números."
                }
			}
		});

		$('#nova_inscricao_form').validate({
			rules: {
				inscricao_comprovante: {
					required: true
				}
			},
			messages: {
				inscricao_comprovante: {
					required: "Este campo é obrigatório."
				}
			}
		});

		$('#inscricao_resposta_form').validate({
			rules: {
				inscricao_resposta: {
					required: true
				}
			},
			messages: {
				inscricao_resposta: {
					required: "Este campo é obrigatório."
				}
			}
		});

		/**
		 * Validação para novo campeonato
		 */
		$('#novo_campeonato_form').validate({
			rules: {
				campeonato_nome: {
					required: true
				}
			},
			messages: {
				campeonato_nome: {
					required: "Este campo é obrigatório."
				}
			}
		});

		$('#nova_etapa_form').validate({
			rules: {
				etapa_nome: {
					required: true
				},
				etapa_localidade: {
					required: true
				},
				etapa_inicio: {
					required: true,
					dataBR: true
				},
				etapa_final: {
					required: true,
					dataBR: true
				},
				etapa_inscricoes_ate: {
					required: true,
					dataBR: true
				}
			},
			messages: {
				etapa_nome: {
					required: "Este campo é obrigatório."
				},
				etapa_localidade: {
					required: "Este campo é obrigatório."
				},
				etapa_inicio: {
					required: "Este campo é obrigatório."
				},
				etapa_final: {
					required: "Este campo é obrigatório."
				},
				etapa_inscricoes_ate: {
					required: "Este campo é obrigatório."
				}
			}
		});
	});
})(jQuery);