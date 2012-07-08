<?php
/**
* 
*/
class Controller_Admin_Etapas extends Controller_Admin_Painel
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->conteudo = View::forge('admin/etapas/index');
	}

	public function action_nova()
	{
		if(Model_Campeonato::count() < 1)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'nFailure',
				'msg_content' => 'Atualmente não existe uma campeonato cadastrado no sistema!'
			));

			Response::redirect('admin');
		}

		if(Input::method() == 'POST')
		{
			$_etapa_campeonato     = Model_Campeonato::find((int) Input::post('etapa_campeonato'));
			$_etapa_nome           = Input::post('etapa_nome');
			$_etapa_localidade     = Input::post('etapa_localidade');
			$_etapa_inicio         = Utils::data2unix(Input::post('etapa_inicio'));
			$_etapa_final          = Utils::data2unix(Input::post('etapa_final'));
			$_etapa_inscricoes_ate = Utils::data2unix(Input::post('etapa_inscricoes_ate') . ' 23:59:59');

			$_nova_etapa                = new Model_Etapa;
			$_nova_etapa->nome          = $_etapa_nome;
			$_nova_etapa->localidade    = $_etapa_localidade;
			$_nova_etapa->data_inicio   = $_etapa_inicio;
			$_nova_etapa->data_final    = $_etapa_final;
			$_nova_etapa->inscricao_ate = $_etapa_inscricoes_ate;
			$_nova_etapa->campeonato    = $_etapa_campeonato;

			if($_nova_etapa->save())
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'nSuccess',
					'msg_content' => 'Nova etapa cadastrada com sucesso.'
				));
			}
			else
			{
				Session::set_flash('flash_msg', array(
					'msg_type'    => 'nFailure',
					'msg_content' => 'Não foi possível cadastrar esta etapa.'
				));
			}

            $_arquivos_count = Input::post('arquivos_upload_count');
            if($_arquivos_count)
            {
                // Cria o diretorio caso ele não exista
                if(! file_exists(DOCROOT . Config::get('sysconfig.app.upload_root') . 'arquivos/' . Inflector::friendly_title(Str::lower($_nova_etapa->nome))))
                    File::create_dir(DOCROOT . Config::get('sysconfig.app.upload_root') . 'arquivos/', Inflector::friendly_title(Str::lower($_nova_etapa->nome)));

                for($_i = 0 ; $_i < $_arquivos_count ; $_i++)
                {
                    $_tmpName = Input::post('arquivos_upload_' . $_i . '_tmpname');
                    $_name    = Input::post('arquivos_upload_' . $_i . '_name');

                    // Move o boletin para este novo diretorio
                    File::rename(APPPATH . 'tmp/' . $_tmpName, DOCROOT . Config::get('sysconfig.app.upload_root') . 'arquivos/' . Inflector::friendly_title(Str::lower($_nova_etapa->nome)) . '/' . $_name);

                    list($insert_id, $rows_affected) = DB::insert('boletins')->set(array(
                        'nome'    =>    $_name,
                        'etapa_id' => $_nova_etapa->id
                    ))->execute();
                }
            }

            Response::redirect('admin');
		}

		$this->template->conteudo = View::forge('admin/etapas/nova');
        $this->template->conteudo->set('campeonatos', Model_Campeonato::find('all'));
	}

    /**
     * TODO: DOC
     * TODO: Maneira genérica de modelo onde o administrador pode escolher a ordem das colunas
     *
     * @param null $_etapa_id   ID da etapa que deseja-se obter a lista de atletas inscritos
     * @param int  $_formato    Modelo que será gerado o arquivo de atletas inscritos
     */
    public function action_inscritos($_etapa_id = null, $_formato = 1)
	{
		if($_etapa_id == null)
		{
			Session::set_flash('flash_msg', array(
				'msg_type'    => 'nFailure',
				'msg_content' => 'Não foi possível encontrar esta etapa.'
			));

			Response::redirect('admin/etapas');
		}
        else
        {
            $_etapa_info = Model_Etapa::find($_etapa_id, array(
                'related' => array(
                    'inscricoes' => array(
                        'where' => array('status' => Model_Inscricao::INSCRICAO_ACEITA)
                    )
                )
            ));

            if($_etapa_info != null)
            {
                switch($_formato)
                {
                    // Modelo da FGO
                    case Padrao_FGO::$myType:
                        $sheetModel = new Padrao_FGO($_etapa_info);
                    break;

                    // Modelo da CBO
                    case 2:
                        // TODO: Gerar modelo da CBO
                        $sheetModel = new Padrao_CBO($_etapa_info);
                    break;
                }

                $sheetModel->buildExcelFile();
            }
            else
            {
                Session::set_flash('flash_msg', array(
                    'msg_type'    => 'nFailure',
                    'msg_content' => 'Não foi efetuada nenhuma inscrição nesta estapa.'
                ));

                Response::redirect('etapas/visualizar/' . $_etapa_id);
            }
        }
	}

    public function action_upload()
    {
        if(Input::method() == 'POST')
        {
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");

            $targetDir = APPPATH . 'tmp';
            $cleanupTargetDir = true; // Remove old files
            $maxFileAge = 5 * 3600; // Temp file age in seconds

            // 5 minutes execution time
            @set_time_limit(5 * 60);
            // Get parameters
            $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
            $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
            // Clean the fileName for security reasons
            $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

            // Make sure the fileName is unique but only if chunking is disabled
            if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
                $ext = strrpos($fileName, '.');
                $fileName_a = substr($fileName, 0, $ext);
                $fileName_b = substr($fileName, $ext);

                $count = 1;
                while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                    $count++;

                $fileName = $fileName_a . '_' . $count . $fileName_b;
            }

            $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

            // Create target dir
            if (!file_exists($targetDir))
                @mkdir($targetDir);

            // Remove old temp files
            if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    // Remove temp file if it is older than the max age and is not the current file
                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }

                closedir($dir);
            } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');


            // Look for the content type header
            if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
                $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

            if (isset($_SERVER["CONTENT_TYPE"]))
                $contentType = $_SERVER["CONTENT_TYPE"];

            // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
            if (strpos($contentType, "multipart") !== false) {
                if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Open temp file
                    $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                    if ($out) {
                        // Read binary input stream and append it to temp file
                        $in = fopen($_FILES['file']['tmp_name'], "rb");

                        if ($in) {
                            while ($buff = fread($in, 4096))
                                fwrite($out, $buff);
                        } else
                            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                        fclose($in);
                        fclose($out);
                        @unlink($_FILES['file']['tmp_name']);
                    } else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            } else {
                // Open temp file
                $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = fopen("php://input", "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    } else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                    fclose($in);
                    fclose($out);
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            // Check if file has been uploaded
            if (!$chunks || $chunk == $chunks - 1) {
                // Strip the temp .part suffix off
                rename("{$filePath}.part", $filePath);
            }


            // Return JSON-RPC response
            die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
        }

        $this->template->conteudo = View::forge('admin/etapas/index');
    }


    // ============================================= REST ================================================== //

    /**
     * @param interger $_etapa_id ID da Etapa
     */
    public function post_excluir()
    {
        if(Input::method() == 'POST' and Input::is_ajax())
        {
            $_etapa_id = Input::post('etapa_id');
            if($_etapa_id == null or ($_etapa_info = Model_Etapa::find($_etapa_id)) == null)
            {
                $this->response(array('valid' => false, 'msg' => 'Não foi possível encontrar esta etapa.'));
            }
            else
            {
                // Deleta todas as inscricoes daquela etapa e seus respectivos comprovantes
                foreach($_etapa_info->inscricoes as $_inscricao)
                {
                    $_comprovante = $_inscricao->comprovante;
                    if($_comprovante)
                    {
                        File::delete(Config::get('sysconfig.app.upload_root') . $_comprovante);
                    }
                }

                // TODO: Deletar arquivos de boletins.
                DB::delete('boletins')->where('etapa_id', '=', $_etapa_id)->execute();

                if($_etapa_info->delete())
                {
                    $this->response(array('valid' => true, 'msg' => 'Etapa excluída com sucesso!'));
                }
                else
                {
                    $this->response(array('valid' => false, 'msg' => 'Nao foi possível excluir esta etapa.'));
                }
            }
        }
        else
        {
            $this->response(array('valid' => false, 'msg' => 'Não foi possível encontrar esta etapa.'));
        }
    }

}
// End of admin/etapas.php