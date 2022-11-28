<?php
namespace App\Models\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(), Table(name: 'arquivos')]
class Arquivo
{
    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    protected $id;

    #[Column(type: 'string')]
    protected $comprador;

    #[Column(type: 'string')]
    protected $descricao;

    #[Column(type: 'float')]
    protected $preco;
    
    #[Column(type: 'integer')]
    protected $quantidade;
    
    #[Column(type: 'string')]
    protected $endereco;
    
    #[Column(type: 'string')]
    protected $fornecedor;

    public function setComprador($comprador)
    {
        $this->comprador = $comprador;
        return $this;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
        return $this;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
        return $this;
    }
}
