<!DOCTYPE html>
<html>
    <head>
        <meta charset=”utf-8”>
        <title>Aula Programação – Condicional Multipla</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 style="text-align:center">Cifra de César</h1>
            <div>
                <h4>Instruções: </h4>
                    <ol>
                        <li>
                            Informe a chave para a criptografia;
                        </li>
                        <li>
                            Informe o texto;
                        </li>
                        <li>
                            Informe o tipo de operação;
                        </li>
                        <li>
                            Clique no botão para visualizar o resultado.
                        </li>
                    </ol>
            </div>
            <form action="" method="post">
                <div class="row">
                    <div class="col col-md-2">
                        <label for="key">Chave</label>
                        <input type="number" class="form-control" name="key" id="key" min="1" value="7"></input>
                    </div>
                </div>
                <div class="form-group">
                    <label for="texto">Texto</label>
                    <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col col-md-2">
                        <label for="operacao">Operação</label>
                        <select class="form-control" id="operacao" name="operacao">
                            <option value="">Selecione...</option>
                            <option value="C" selected>Criptografar</option>
                            <option value="D">Descriptografar</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-2">
                        <label for="versao">Versão</label>
                        <select class="form-control" id="versao" name="versao">
                            <option value="">Selecione...</option>
                            <option value="0">Original</option>
                            <option value="1" selected>2AV</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2" style="margin-top:2%;">Enviar</button>
            </form>   

            <div style="margin-bottom:5%;">
                <h4  style="text-align:center">RESULTADO </h4>
                <div class="card">
                    <div class="card-body">
                    <?php
                        if($_POST){
                            $chave = $_POST["key"];
                            $texto = $_POST["texto"];
                            $operacao = $_POST["operacao"];
                            $versao = $_POST["versao"];
                            if($operacao == "C"){
                            echo criptografar($chave, strtoupper($texto), $versao);
                            }
                            else{
                                echo descriptografar($chave, strtoupper($texto), $versao);
                            }
                        }
                    ?> 
                    </div>
                </div>   
            </div>     
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>


<?php
    function criptografar ($key, $texto, $versao)
    {
        $txtcriptografado = "";
		$keyc= 0;
        $alfabeto = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L",
                        "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", 
                        "Y","Z"];
        $letra = "";
        $palavras = $texto;
        $tam = strlen($palavras);
        //padrao	
        if($versao == "0")
        {
            $limite = count($alfabeto);   
        }     
        else{
            //customizada
            $limite = 25;
        }
		$vazio = false;
		
		//criptografa
		for ($i = 0; $i < $tam; $i++) 
		{			
			$vazio = false;
			$letra = strtoupper($palavras[$i]);			
			$l;
			for($l = 0; $l < $limite; $l++)
			{					
				if($letra == $alfabeto[$l]) 
				{
					break;
				}	
				
				if($l == ($limite-1)) 
				{
					$vazio = true;
				}
			}
			if(!$vazio) 
			{
				$keyc = $l + $key;
				if($keyc > $limite) 
				{
					$keyc = $keyc - $limite;
                }
                if($keyc == $limite)
                {
                    $keyc = 0;
                }
				$txtcriptografado = $txtcriptografado . $alfabeto[$keyc];
			}
			else 
			{
				$txtcriptografado = $txtcriptografado . "#";
			}			
		}		
		
		return $txtcriptografado;
    }

    function descriptografar ($key, $texto, $versao)
    {
        $txtcriptografado = "";
		$keyc= 0;
        $alfabeto = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", 
                     "L", "M", "N", "O", "P", "Q", "R", "S", "T", 
                     "U", "V", "W", "X", "Y","Z"];
		$letra = "";
        $tam = strlen($texto);
        if($versao == 1){	
            $limite = 25;
        }
        else{
            $limite = count($alfabeto);
        }
		for ($i = 0; $i < $tam; $i++) 
		{			
			$letra = $texto[$i];	
			if($letra != "#")
			{		
				$l;
				for($l = 0; $l < $limite; $l++)
				{					
					if($letra == $alfabeto[$l]) 
					{
						break;
					}	
				}
				$keyc = $l - $key;
				if($keyc < 0) 
				{
					$keyc = $limite + $keyc;
				}
				$txtcriptografado = $txtcriptografado . $alfabeto[$keyc];			
			}
			else{
				$txtcriptografado = $txtcriptografado . " ";
			}
		}				
		return $txtcriptografado;		
    }
?>