<?php
namespace App\Controllers;

use App\Core\Controller;
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
        $fileName = $this->uploadFile($request->getUploadedFiles()['arquivo']);
        
        if ($fileName) {
            
        }
        
        var_dump($uploadedFile['arquivo']);die();
        return $this->render($response, 'index.html');
    }

    private function uploadFile($file)
    {
        if ($file->getError() === UPLOAD_ERR_OK) {
            $extension  = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
            $basename   = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
            $filename   = sprintf('%s.%0.8s', $basename, $extension);

            $file->moveTo($this->uploadDirectory . DIRECTORY_SEPARATOR . $filename);
            
            return $filename;
        }

        return false;
    }
}
