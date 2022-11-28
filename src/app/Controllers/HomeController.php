<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Entity\Arquivo;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    private $uploadDirectory = __DIR__ . '/../../uploads';

    public function index(Request $request, Response $response)
    {
        return $this->render($response, 'index.html');
    }

    public function upload(Request $request, Response $response)
    {
        if ($fileName   = $this->uploadFile($request->getUploadedFiles()['arquivo'])) {
            if ($data = $this->parseData($fileName)) {
                if (!$this->saveData($data)) {
                    $this->flash->addMessage('error', 'Houve um erro na importação do arquivo! Procure o administrador do sistema');
                } else {
                    $this->flash->addMessage('success', 'Arquivo importado com sucesso');
                }
            }
        }
    
        return $this->render($response, 'index.html');
    }

    private function uploadFile($file)
    {
        if ($file->getError() === UPLOAD_ERR_OK) {
            $extension  = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
            if ($extension != 'txt') {
                $this->flash->addMessage('error', 'O arquivo dever ser no formato .txt');
                return false;
            }
            $basename   = bin2hex(random_bytes(8));
            $filename   = sprintf('%s.%0.8s', $basename, $extension);

            $file->moveTo($this->uploadDirectory . DIRECTORY_SEPARATOR . $filename);
            
            return $filename;
        }

        return false;
    }

    private function parseData($filename)
    {
        $file   = $this->uploadDirectory . DIRECTORY_SEPARATOR . $filename;
        $lines  = file($file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
        $count  = 0;
        $data   = [];
        $index  = [
            'comprador',
            'descricao',
            'preco',
            'quantidade',
            'endereco',
            'fornecedor'
        ];

        foreach ($lines as $line) {
            $count++;
            if ($count == 0) {
                continue;
            }

            $fileData = preg_split('/\t+/', $line);
            try {
                if (count($index) != count($fileData)) {
                    throw new Exception('Erro na linha: ' . $count);
                }

                array_push($data, (array_combine($index, $fileData)));
            } catch (Exception $e) {
                $this->flash->addMessage('error', 'Formado dos dados do arquivo é inválido!');
                $this->flash->addMessage('error', $e->getMessage());
                return false;
            }
        }

        return $data;
    }

    private function saveData($data)
    {
        //var_dump($data); die();
        foreach ($data as $value) {
            $arquivo = new Arquivo();
            $arquivo->setComprador($value['comprador']);
            $arquivo->setDescricao($value['descricao']);
            $arquivo->setPreco($value['preco']);
            $arquivo->setQuantidade($value['quantidade']);
            $arquivo->setEndereco($value['endereco']);
            $arquivo->setFornecedor($value['fornecedor']);

            try {
                $this->em->persist($arquivo);
                $this->em->flush();
            } catch (Exception $e) {
                $this->flash->addMessage('error', $e->getMessage());
                return false;
            }
        }

        return true;
    }
}
