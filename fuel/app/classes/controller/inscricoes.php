<?php

class Controller_Inscricoes extends Controller_Auth
{
	public $template = 'template';

	public function before()
	{
		parent::before();

		// Diretorio para guardar os comprovantes
		Asset::add_path('uploads/');

		if($this->request->action == 'nova')
		{
			if( ! Model_User::validate_profile() )
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Você não possui permissão para realizar uma inscrição, preencha seu perfil primeiro.'
				));

				Response::redirect('home');
			}
		}
	}

	/**
	 * [action_index description]
	 * @return [type] [description]
	 */
	public function action_index()
	{
		$this->template->conteudo = View::forge('shared/minhas_inscricoes', array('breadcrumbs' => true));
	}

	public function action_visualizar($_inscricao_id = null)
	{
		if($_inscricao_id == null)
		{
			Response::redirect('home');
		}

		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Não foi possível encontrar uma inscrição com o ID <strong>' . $_inscricao_id . '</strong>.'
			));

			Response::redirect('home');
		}

		// Verifica se o usuário é admin ou se a inscrição a ser vista não foi feita por ele
		if( ! Sentry::user()->is_admin() && $_inscricao->user->id != Sentry::user()->get('id'))
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Não foi possível encontrar esta inscrição.'
			));

			Response::redirect('home');
		}

		$data = array();
		$data['inscricao_info'] = $_inscricao;
		$this->template->conteudo = View::forge('inscricoes/visualizar', $data);
	}

	public function action_buscar()
	{
		if(Input::method() == 'POST')
		{
			if(($_inscricao = Model_Inscricao::find((int) Input::post('inscricao_numero'))) != null)
			{
				Response::redirect('inscricoes/visualizar/' . $_inscricao->id);
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Não foi possível encontrar uma inscrição com o ID <strong>' . Input::post('inscricao_numero') . '</strong>.'
				));
			}
		}

		Response::redirect('home');
	}

	/**
	 * Realiza uma nova inscrição em uma etapa anteriormente cadastrada
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Andreo Vieira <andreoav@gmail.com>
	 */
	public function action_nova($_etapa_id = null)
	{
		// Verifica se a requisição foi feita usando o método alternativo de inscrição
		// que está disponível ao visualizar uma etapa cadastrada e disponível para novas inscrições
		if($_etapa_id != null && Input::method() == 'POST')
		{
			if($_etapa_id == (int) Input::post('etapa_id_verify'))
			{
				$_etapa = Model_Etapa::find($_etapa_id);
				$_path  = self::criarUploadPath($_etapa);

				if(Utils::uploadComprovante($_path))
				{
					self::salvaInscricao($_etapa, $_path);
				}
				else
				{
					// Não conseguiu realizar o upload do comprovante
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'alert-error',
						'msg_content' => '<strong>Erro!</strong> Não foi possível realizar esta inscrição! Erro ao enviar comprovante.'
					));
				}
			}
			else
			{
				Response::redirect('etapas/visualizar/' . $_etapa_id);
			}

			Response::redirect('inscricoes/nova');
		}
		else
		{
			// Neste ponto é o método normal de nova inscroção, invocando diretamente a action
			// Verifica se existe uma etapa disponível para realização de inscrições
			if(Model_Etapa::count(array('where' => array(array('inscricao_ate', '>=', time())))) < 1)
			{
				// não possui, manda uma mensagem e redireciona
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Atualmente não existe uma etapa disponível para inscrição no sistema!'
				));

				Response::redirect('home');
			}

			// Formulário de inscrição em uma etapa foi enviado
			// Faz as validações e realiza a nova inscrição
			if(Input::method() == 'POST')
			{
				// Pega apenas a etapa por hora
				$_insc_etapa_id   = Input::post('inscricao_etapa');

				// Verifica se usuário já não está inscrito na etapa inserida
				$_insc_existente = Model_Inscricao::find('first', array(
					'where' => array(
						array('user_id'  => Sentry::user()->get('id')),
						array('etapa_id' => $_insc_etapa_id)
					)
				));

				// Verifica se usuário já não está inscrito na etapa inserida
				if($_insc_existente != null)
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'alert-error',
						'msg_content' => '<strong>Ops!</strong> Não foi possível realizar esta inscrição! Você já está cadastrado nesta etapa.'
					));
				}
				else
				{
					// O usuário ainda não está inscrito
					// Faz o upload do comprovante e realiza a inscrição
					$_etapa = Model_Etapa::find($_insc_etapa_id);
					$_path  = self::criarUploadPath($_etapa);

					if(Utils::uploadComprovante($_path))
					{
						self::salvaInscricao($_etapa, $_path);
					}
					else
					{
						// Não conseguiu realizar o upload do comprovante
						Session::set_flash('flash_msg', array(
							'msg_type'    => 'alert-error',
							'msg_content' => '<strong>Erro!</strong> Não foi possível realizar esta inscrição! Erro ao enviar comprovante.'
						));
					}
				}

				Response::redirect('inscricoes/nova');
			}

			$data = array();
			$data['etapas'] = Model_Etapa::find('all', array(
				'where' => array(
					array('inscricao_ate', '>=', time())
				),
				'order_by' => array('data_inicio' => 'asc')
			));

			// Renderiza o formulário de inscrição
			$this->template->conteudo = View::forge('inscricoes/nova', $data);
		}
	}

	/**
	 * Action responsável por excluir uma inscrição
	 * Se o usuário é o criador da inscrição de id $_inscricao_id ou é administrador do sistema a inscrição é removida
	 *
	 * @author  Andreo Vieira <andreoav@gmail.com>
	 * @version 1.0
	 * @since   1.0
	 * @param   int $_inscricao_id ID da inscrição a ser excluída
	 */
	public function action_excluir($_inscricao_id = null)
	{
		// Verifica se existe uma inscrição com id $_inscricao_id
		if($_inscricao_id == null || ($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Response::redirect('home');
		}

		if(Input::method() == 'POST')
		{
			// Verifica se o usuário é admin do sistema ou dono da inscrição a ser excluída
			if(! Sentry::user()->is_admin() && ($_inscricao->user->id != Sentry::user()->get('id')))
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Você não pode excluir uma inscrição feita por outra pessoa!'
				));

				Response::redirect('home');
			}

			// Deleta o comprovante
			if($_inscricao->comprovante)
			{
				File::delete(Config::get('sysconfig.app.upload_root') . $_inscricao->comprovante);
			}

			if($_inscricao->delete())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => '<strong>Parabéns!</strong> Inscrição excluída com sucesso.'
				));

				Response::redirect('home');
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => '<strong>Erro!</strong> Não foi possível excluir esta inscrição!'
				));
			}
		}
		else
		{
			$this->template->conteudo = View::forge('inscricoes/excluir', array('inscricao_info' => $_inscricao));
		}
	}

	public function action_responder($_inscricao_id = null)
	{
		if(Input::method() == 'POST' && $_inscricao_id != null)
		{
			$_inscricao = Model_Inscricao::find($_inscricao_id);
			if($_inscricao != null)
			{
				$_nova_resposta = new Model_Resposta;
				$_nova_resposta->conteudo  = Input::post('inscricao_resposta');
				$_nova_resposta->user      = Model_User::find(Sentry::user()->get('id'));
				$_nova_resposta->inscricao = $_inscricao;

				if($_nova_resposta->save())
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'alert-success',
						'msg_content' => '<strong>Parabéns!</strong> Sua resposta foi enviada com sucesso.'
					));

					Response::redirect('inscricoes/visualizar/' . $_inscricao_id);
				}
				else
				{
					Session::set_flash('flash_msg', array(
						'msg_type'    => 'alert-error',
						'msg_content' => '<strong>Erro!</strong> Não foi possível enviar a sua resposta.'
					));
				}
			}
		}

		Response::redirect('home');
	}

	/**
	 * [action_download_comprovante description]
	 * @param  [type] $_inscricao_id [description]
	 * @return [type]                [description]
	 */
	public function action_download_comprovante($_inscricao_id = null)
	{
		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Response::redirect('home');
		}

		// Verifica se o usuário é admin do sistema ou dono da inscrição a ser excluída
		if(! Sentry::user()->is_admin() && ($_inscricao->user->id != Sentry::user()->get('id')))
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Você não pode fazer download do comprovante de uma inscrição feita por outra pessoa.'
			));

			Response::redirect('home');
		}

		File::download(DOCROOT . Config::get('sysconfig.app.upload_root') . $_inscricao->comprovante);
	}

	/**
	 * [criarUploadPath description]
	 * @param  Model_Etapa $_etapa [description]
	 * @return [type]              [description]
	 */
	public static function criarUploadPath(Model_Etapa $_etapa)
	{
		$_path  = Str::lower(Inflector::friendly_title($_etapa->campeonato->nome)) . '/';
		$_path .= Str::lower(Inflector::friendly_title($_etapa->nome)) . '/';

		return $_path;
	}

	private static function salvaInscricao(Model_Etapa $_etapa, $_path)
	{
		// Upload realizado com sucesso, realiza o resto da inscrição
		$_comprovante = Arr::get(Upload::get_files(), 0);

		$_nova_inscricao = new Model_Inscricao;
		$_nova_inscricao->etapa       = $_etapa;
		$_nova_inscricao->categoria   = Input::post('inscricao_categoria');
		$_nova_inscricao->observacao  = Input::post('inscricao_observacao');
		$_nova_inscricao->status      = Model_Inscricao::INSCRICAO_PENDENTE;
		$_nova_inscricao->comprovante = $_path . Arr::get($_comprovante, 'saved_as');
		$_nova_inscricao->user        = Model_User::find(Sentry::user()->get('id'));

		// Salva a inscrição no banco de dados
		if($_nova_inscricao->save())
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-success',
				'msg_content' => '<strong>Parabéns!</strong> Seu pedido de inscrição foi enviado com sucesso.'
			));

			Response::redirect('home');
		}
		else
		{
			// Não conseguiu salvar a inscrição, envia uma mensagem e redireciona
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => '<strong>Erro!</strong> Não foi possível realizar esta inscrição!'
			));
		}
	}
}