(function($){
	/* Table initialisation */
	$(document).ready(function() {

		// Default Options
		/*$.validator.setDefaults({
			errorClass: "help-inline",
			errorElement: "span",

		});*/

        // Default Options
        /*$.validator.setDefaults({

        });*/

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
            ignore: false,
			rules: {
				noticia_titulo: {
					required: true
				},
                noticia_conteudo: "required"
			}
		});

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
                cadastro_username: {
                    required: true,
                    email:    true
                },
                cadastro_password: "required",
                cadastro_password_2: {
                    equalTo: '#cadastro_password'
                }
            },
            ignore: false
        });

		$('#usuario_perfil_form').validate({
			rules: {
				usuario_nome: {
					required: true
				},
				usuario_identidade: {
					required: true
				},
				usuario_nascimento: {
					required: true,
					dataBR:   true
				},
                usuario_ncbo: {
                    required: true,
                    number:   true
                }
			}
		});

        /**
         * Validação de nova inscrição
         */
        $('form#nova_inscricao_form').validate({
            rules: {
                inscricao_etapa: "required",
                inscricao_categoria: "required",
                inscricao_comprovante: "required"
            },
            ignore: false
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

        $('#admin_email_form').validate({
            ignore: false,
            rules: {
                email_targets: "required",
                email_assunto: "required",
                email_content: "required"
            }
        });

	});
})(jQuery);