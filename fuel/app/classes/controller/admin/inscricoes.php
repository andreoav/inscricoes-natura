<?php

/**
*
*/
class Controller_Admin_Inscricoes extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->conteudo = View::forge('admin/inscricoes/index');
	}

	/**
	 * [action_aprovar description]
	 * @param  [type] $_inscricao_id [description]
	 * @return [type]                [description]
	 */
	public function action_aprovar($_inscricao_id = null)
	{
		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta inscrição.'
			));
		}
		else
		{
			$_inscricao->status = Model_Inscricao::INSCRICAO_ACEITA;
			if($_inscricao->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Inscrição aprovada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível aprovar esta inscrição.'
				));
			}

			Response::redirect('inscricoes/visualizar/' . $_inscricao_id);
		}

		Response::redirect('admin/inscricoes');
	}

	/**
	 * [action_reprovar description]
	 * @param  [type] $_inscricao_id [description]
	 * @return [type]                [description]
	 */
	public function action_rejeitar($_inscricao_id = null)
	{
		if(($_inscricao = Model_Inscricao::find($_inscricao_id)) == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'alert-error',
				'msg_content' => 'Não foi possível encontrar esta inscrição.'
			));
		}
		else
		{
			$_inscricao->status = Model_Inscricao::INSCRICAO_REJEITADA;
			if($_inscricao->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-success',
					'msg_content' => 'Inscrição rejeitada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'alert-error',
					'msg_content' => 'Não foi possível rejeitar esta inscrição.'
				));
			}

			Response::redirect('inscricoes/visualizar/' . $_inscricao_id);
		}

		Response::redirect('admin/inscricoes');
	}
}