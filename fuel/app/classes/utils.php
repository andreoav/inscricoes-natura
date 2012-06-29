<?php

class Utils
{
    public static $categorias = array(
        "D 10 N",
        "D 12 A",
        "D 12 B",
        "D 14 A",
        "D 14 B",
        "D 16 A",
        "D 16 B",
        "D 16 E",
        "D 16 N",
        "D 18 A",
        "D 18 B",
        "D 18 E",
        "D 18 N",
        "D 20 A",
        "D 20 B",
        "D 20 E",
        "D 20 N",
        "D 21 A",
        "D 21 B",
        "D 21 E",
        "D 21 N",
        "D 35 A",
        "D 35 B",
        "D 35 N",
        "D 40 A",
        "D 40 B",
        "D 45 A",
        "D 45 B",
        "D 50 A",
        "D 50 B",
        "D 50 N",
        "D 55 A",
        "D 55 B",
        "D 60 A",
        "D 65 A",
        "D 65 B",
        "D 70 A",
        "D 70 B",
        "D 75 A",
        "D 75 B",
        "D 80 A",
        "D 80 B",
        "D 85 A",
        "D 85 B",
        "D 90 A",
        "D 90 B",
        "D N 1" ,
        "D N 2" ,
        "D N 3" ,
        "D S N" ,
        "H 10 N",
        "H 12 A",
        "H 12 B",
        "H 14 N",
        "H 14 A",
        "H 14 B",
        "H 16 A",
        "H 16 B",
        "H 16 E",
        "H 16 N",
        "H 18 A",
        "H 18 B",
        "H 18 E",
        "H 18 N",
        "H 20 A",
        "H 20 B",
        "H 20 E",
        "H 20 N",
        "H 21 A",
        "H 21 B",
        "H 21 E",
        "H 21 N",
        "H 35 A",
        "H 35 B",
        "H 40 A",
        "H 40 B",
        "H 45 A",
        "H 45 B",
        "H 50 A",
        "H 50 B",
        "H 50 N",
        "H 55 A",
        "H 55 B",
        "H 60 A",
        "H 65 A",
        "H 65 B",
        "H 70 A",
        "H 70 B",
        "H 75 A",
        "H 75 B",
        "H 80 A",
        "H 80 B",
        "H 85 A",
        "H 85 B",
        "H 90 A",
        "H 90 B",
        "H N 1" ,
        "H N 2" ,
        "H N 3" ,
        "H S N" ,
        "ABERTO",
    );

	public static $image_types = array(
		'image/bmp',
		'image/gif',
		'image/jpeg',
		'image/png'
	);

	protected static $mimetypeIcon = array(
		'image/bmp'					                                              => 'image.png',
		'image/gif'					                                              => 'image.png',
		'image/jpeg' 				                                              => 'image.png',
		'image/png'					                                              => 'image.png',
		'application/vnd.ms-excel'	                                              => 'excel.png',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'       => 'excel.png',
		'application/msword'		                                              => 'word.png',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word.png',
		'application/pdf'			                                              => 'pdf.png',
		'application/zip'			                                              => 'compressed.png',
		'application/x-7z-compressed'                                             => 'compressed.png',
		'application/x-rar-compressed'                                            => 'compressed.png'
	);

    protected static $allowed_mimeTypes = array(
        'image/bmp',
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/pdf',
        'application/zip',
        'application/x-7z-compressed',
        'application/x-rar-compressed'
    );

	public static function isImage($_mimeType)
	{
		return in_arrayi($_mimeType, self::$image_types);
	}

	public static function get_mimeTypeIcon($_mimeType)
	{
		return 'mimetypes/' . self::$mimetypeIcon[$_mimeType];
	}

	public static function criarBreadcrumb($location)
	{
        /*<div class="breadLine">
            <div class="bc">
                <ul id="breadcrumbs" class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li class="current"><a href="#">Index</a></li>
                </ul>
            </div>
        </div>*/

		if(is_array($location))
		{
			$_i = 0; $_url = '';
			$_breadcrumb  = '<div class="breadLine"><div class="bc"><ul class="breadcrumbs">';
			$_breadcrumb .= '<li><a href="' . Uri::base() . '">Home</a></li>';

            if(count($location) > 2)
            {
                foreach ($location as $segmento)
                {
                    if($_i + 1 == count($location))
                    {
                        $_breadcrumb .= '<li class="current"><a href="#">' . Inflector::humanize($segmento) . '</a></li>';
                    }
                    else
                    {
                        $_breadcrumb .= '<li><a href="' . Uri::create($_url . $segmento) . '">' . ($segmento == 'inscricoes' ? 'Inscrições' : Inflector::humanize($segmento)) . '</a></li>';
                    }

                    $_i++;
                    $_url .= $segmento . '/';
                }
            }
            else
            {
                $_breadcrumb .= '<li class="current"><a href="#">' . ($location[0] == 'home' ? Inflector::humanize('index') : ($location[0] == 'inscricoes' ? 'Inscrições' : Inflector::humanize($location[0]))). '</a></li>';
            }

			return $_breadcrumb . '</ul></div></div>';
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
			'path'           =>	DOCROOT . Config::get('sysconfig.app.upload_root') . $_path,
			'prefix'         => Str::lower(Inflector::friendly_title(Sentry::user()->get('metadata.nome'))) . '_',
            'randomize'      => true,
            'mime_whitelist' => self::$allowed_mimeTypes
		);

		// Upload do comprovante
		Upload::process($_upload_config);
		if(Upload::is_valid())
		{
			Upload::save(); return true;
		}

		return false;
	}

    public static function etapaPopover($etapa)
    {
        $_info  = '<strong>Início: </strong>' . Date::forge($etapa->data_inicio)->format('%d/%m/%Y');
        $_info .= '<br /><strong>Final: </strong>' . Date::forge($etapa->data_final)->format('%d/%m/%Y');
        $_info .= '<br /><strong>Inscrições até: </strong>' . Date::forge($etapa->inscricao_ate)->format('%d/%m/%Y');

        return $_info;
    }
}