<?php
namespace test;

use Nyholm\Psr7\Request as Psr7Request;
use PHPUnit\Framework\TestCase;
use Slim\App;
use Slim\Psr7\Environment;
use Slim\Http
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Uri;

class UploadTest extends TestCase
{
    private $file;
    private $wrongFile;
    private $wrongExtension;


//        $this->wrongFile        = file('dados-errados.txt', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
//        $this->wrongExtension   = file('arquivo.cvs', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);


    public function testUploadFile()
    {
        $file = file(__DIR__ . '/dados.txt', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
        $env = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/',
            'QUERY_STRING' => '',
            'SERVER_NAME' => 'localhost',
            'CONTENT_TYPE' => 'multipart/form-data',
            'slim.files' => [
                'arquivo' => $file,
            ]
        ]);

        $uri = new Uri('', '', 80, '/');
        $handle = fopen('php://temp', 'w+');

        $stream = (new StreamFactory)->createStreamFromResource()
        Request::create

        $request = Psr7Requ

       
        var_dump($env); die(); 
    }

    /*
    public function testUploadWrongExtension()
    {
        return true;
    }

    public function testUploadWrongData()
    {
        return true;
    }
    */
}
