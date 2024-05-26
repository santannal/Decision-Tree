<?

class Historico
{

    private $id;
    private $precoCompra;
    private $precoVenda;
    private $perda;
    private $vendaChuva;
    private $vendaSol;

    private $firebaseURL = 'https://appleonardobd-c3739-default-rtdb.firebaseio.com/';
    private $dadosJson;

    //get e set
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPrecoCompra()
    {
        return $this->precoCompra;
    }
    public function setPrecoCompra($precoCompra)
    {
        $this->precoCompra = $precoCompra;
    }
    public function getPrecoVenda()
    {
        return $this->precoVenda;
    }
    public function setPrecoVenda($precoVenda)
    {
        $this->precoVenda = $precoVenda;
    }

    public function getPerda()
    {
        return $this->perda;
    }

    public function setPerda($perda)
    {
        $this->perda = $perda;
    }
    public function getVendaChuva()
    {
        return $this->vendaChuva;
    }
    public function setVendaChuva($vendaChuva)
    {
        $this->vendaChuva = $vendaChuva;
    }
    public function getVendaSol()
    {
        return $this->vendaSol;
    }
    public function setVendaSol($vendaSol)
    {
        $this->vendaSol = $vendaSol;
    }

    public function getDadosJson()
    {
        return $this->dadosJson;
    }

    public function setDadosJson($dadosJson)
    {
        $this->dadosJson = $dadosJson;
    }

    public function salvarFirebase()
    {
        $tabela = curl_init($this->firebaseURL . 'historico.json');

        curl_setopt($tabela, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($tabela, CURLOPT_POSTFIELDS, $this->dadosJson);
        curl_setopt($tabela, CURLOPT_RETURNTRANSFER, true);

        $resposta = curl_exec($tabela);
        curl_close($tabela);
        return $resposta;
    }

    public function listarFirebase()
    {
        $tabela = curl_init($this->firebaseURL . 'historico.json');
        curl_setopt($tabela, CURLOPT_RETURNTRANSFER, true);
        $resposta = curl_exec($tabela);
        curl_close($tabela);
        return $dados = json_decode($resposta, true);
    }
}