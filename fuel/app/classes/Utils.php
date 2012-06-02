<?php

class Utils
{
	public static function criarBreadcrumb($location)
	{
		if(is_array($location))
		{
			$_i = 0; $_url = '';
			$_breadcrumb  = '<div class="span12"><ul class="breadcrumb">';
			$_breadcrumb .= '<li><a href="' . Uri::base() . '">Início</a></li> <span class="divider">/</span> ';
			foreach ($location as $segmento)
			{
				if($_i + 1 == count($location))
				{
					$_breadcrumb .= '<li class="active">' . Inflector::humanize($segmento) . '</li>';
				}
				else
				{
					$_breadcrumb .= '<li><a href="' . Uri::create($_url . $segmento) . '">' . Inflector::humanize($segmento) . '</a></li>';
					$_breadcrumb .= ' <span class="divider">/</span> ';
				}

				$_i++;
				$_url .= $segmento . '/';
			}

			return $_breadcrumb . '</ul></div>';
		}
		else
		{
			return '<div class="span12"><ul class="breadcrumb"><li><a href="' . Uri::base() . '">Início</a></li></ul></div>';
		}
	}

	public static function status2label($_status)
	{
		$_label = '';
		switch ($_status)
		{
			case Model_Inscricao::INSCRICAO_ACEITA:
				$_label .= '<span class="label label-success">Aprovada</span>';
			break;

			case Model_Inscricao::INSCRICAO_PENDENTE:
				$_label .= '<span class="label label-warning">Pendente</span>';
			break;

			case Model_Inscricao::INSCRICAO_REJEITADA:
				$_label .= '<span class="label label-important">Rejeitada</span>';
			break;
		}

		return $_label;
	}

	public static function getComprovanteSegments($_comprovante = null, $_file = true)
	{
		if($_comprovante != null)
		{
			if($_file)
			{
				$_segment = explode('/', $_comprovante);
				return $_segment[2];
			}
			else
			{
				$_segment = explode('/', $_comprovante);
				return $_segment[0] . '/' . $_segment[1];
			}
		}

		return null;
	}

	public static function data2unix($_data)
	{
		return strtotime(str_replace('/', '-', $_data));
	}

	public static function uploadComprovante($_path)
	{
		$_upload_config = array(
			'path'   =>	DOCROOT . Config::get('sysconfig.app.upload_root') . $_path,
			'prefix' => Str::lower(Inflector::friendly_title(Sentry::user()->get('metadata.nome'))) . '_'
		);

		// Upload do comprovante
		Upload::process($_upload_config);
		if(Upload::is_valid())
		{
			Upload::save();
			return true;
		}

		return false;
	}
}