<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$correcao = $_POST["correcao"];
$name = $_POST["name"] == null ? 'Erro' : $_POST["name"];
$inst =  $_POST["senha"] != null ? $_POST["senha"] :0;
$correcao = $_POST["correcao"] != null ? $_POST["correcao"] :0;
$abrangencia = $_POST["abrangencia"] != null ? $_POST["abrangencia"] :0;
$insercao = $_POST["insercao"] != null ? $_POST["insercao"] :0;
$pesoCorrecao = $_POST["pesoCorrecao"] != null ? $_POST["pesoCorrecao"] :0;
$pesoOrtografia = $_POST["pesoOrtografia"] != null ? $_POST["pesoOrtografia"] :0;
$thesaurus = $_POST["thesaurus"] != null ? $_POST["thesaurus"] :0;
$ontologia = $_POST["ontologia"] != null ? $_POST["ontologia"] :0;
$onlineSearch = $_POST["onlineSearch"] != null ? $_POST["onlineSearch"] :0;
$numConcepts = $_POST["numConcepts"] != null ? $_POST["numConcepts"] :0;
$pesoComp = $_POST["pesoComp"] != null ? $_POST["pesoComp"] :0;
$pesoBase = $_POST["pesoBase"] != null ? $_POST["pesoBase"] :0;


if ( $_POST["senha"] != "goSi" && $_POST["senha"] != "goJo" && $_POST["senha"] != "goDa"){
die("Senha inexistente!");
}

$endLine = "\n";

$fileName = "/home/bitnami/htdocs/config-repo/config-repo/mining-development.yml";
$myfile = fopen($fileName, "w") or die('Cannot open file: '.$fileName);
//fwrite($myfile, 'testando');
fwrite($myfile, 'user:'.$inst.$endLine);
fwrite($myfile, 'correcao:'.$correcao.$endLine);
fwrite($myfile, 'abrangencia:'.$abrangencia.$endLine);
fwrite($myfile, 'insercao:'.$insercao.$endLine);
fwrite($myfile, 'pesoCorrecao:'.$pesoCorrecao.$endLine);
fwrite($myfile, 'pesoOrtografia:'.$pesoOrtografia.$endLine);
fwrite($myfile, 'thesaurus:'.$thesaurus.$endLine);
fwrite($myfile, 'ontologia:'.$ontologia.$endLine);
fwrite($myfile, 'onlineSearch:'.$onlineSearch.$endLine);
fwrite($myfile, 'numConcepts:'.$numConcepts.$endLine);
fwrite($myfile, 'pesoBse:'.$pesoBase.$endLine);
fwrite($myfile, 'pesoComp:'.$pesoComp.$endLine);


fclose($myfile);
//echo ("tentando gravar...");
//chdir('/home/bitnami/htdocs/config-repo/config-repo/');
//$message=shell_exec('ls -la');
//echo $message;
//$out = shell_exec('./updateGit.sh');
///shell_exec("git add .");//
//shell_exec("git commit -m \"atualizando\"");
//shell_exec("git push");
//echo $out;
//echo $return_var;
//echo "<br>";

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
    )
);

//$context  = stream_context_create($opts);

//$resultRefresh = file_get_contents('http://gomining-env.uppk4f29t3.sa-east-1.elasticbeanstalk.com/actuator/refresh', false, $context);

//echo $resultRefresh;
echo "<br>";
//echo $name.$inst.$correcao;
}
?>

A similaridade final calculada será baseada em vários fatores. Entre eles:
<br><br>
1) Quantos conceitos do texto base o texto do aluno abrange: <br>
2) Quantos dos conceitos do texto do aluno também estão no texto base (ou seja, se 50% dos termos é comum, o valor sera 0.5) <br>
3) Qual o peso dos conceitos semelhantes em relação ao total do texto base (o peso de um conceito  é a sua frequencia. Então se os <br>
conceitos semelhantes forem os mais recorrentes, esse valor sobe. Se forem os menos recorrentes, é como se ele se ateve à um <br>
pedaço irrelevante do conteúdo)<br>
4) QUal o peso dos conceitos semelhantes em relacao ao texto do aluno (ou seja, os conceitos relevantes eram os mais relevantes tambem no texto do aluno?)
<br>
5) Qual o peso a ser dado para erros gramaticas <br>
<br>
<strong>A soma total dos pesos deverá ser 1. Então se a categoria 4 for a mais relevante, pode ser atribuido peso 0.8 para ela, por exemplo<br>
<strong>Notem que o peso é fração, 0. alguma coisa. Usem '.', não ','<br></strong>
É de responsabilidade de voces somarem os pesos para que sejam igual a 1 (pensem antes de atribuir pesos, por isso muda tudo)<br>
</strong>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

<br>
Peso dos conceitos em comum em relacao ao total de conceitos do texto base: <input type="text" name="abrangencia">
<br><br>
Peso dos conceitos em comum em relacao ao total de conceitos do texto do aluno: <input type="text" name="insercao">
<br><br>
Peso dos conceitos em comum em relacao ao total das frequencias do texto do aluno <br>(ou seja, quanta relevancia os 
termos em comum tem em relacao a todos os termos extraidos do texto do aluno): <input type="text" name="pesoComp">
<br><br>
Peso dos conceitos em comum em relacao ao total das frequencias do texto base <br>(ou seja, quanta relevancia os
termos em comum tem em relacao a todos os termos extraidos do texto base): <input type="text" name="pesoBase">

<br> <br>
Usar Corretor Ortografico: (Este processo é demorado e limitado. Nao colocar "verdadeiro" se nao for utilizar o resultado!)
<input type="radio" name="correcao" <?php if (isset($correcao) && $correcao=="true") echo "checked";?> value="true">Sim
<input type="radio" name="correcao" <?php if (isset($correcao) && $correcao=="false") echo "checked";?> value="false">Nao
<br>
Peso atribuido aos erros ortograficos: <input type="text" name="pesoOrtografia">
<br>
Numero de conceitos (deixe 0 para adaptativo): <input type="text" name="numConcepts">
<br><

<br>

Usar Theusaurs:
<input type="radio" name="thesaurus" <?php if (isset($thesaurus) && $thesaurus=="true") echo "checked";?> value="true">Sim
<input type="radio" name="thesaurus" <?php if (isset($thesaurus) && $thesaurus=="false") echo "checked";?> value="false">Nao
<br><br>
Usar Busca Online: (Irá melhorar o resultado atraves de consultas online - Não implementado)
<input type="radio" name="onlineSearch" <?php if (isset($onlineSearch) && $onlineSearch=="true") echo "checked";?> value="true">Sim
<input type="radio" name="onlineSearch" <?php if (isset($onlineSearch) && $onlineSearch=="false") echo "checked";?> value="false">Nao
<br><br>
Usar Ontologias: (Irá utilizar ontologias predefinidas para melhorar o resultado)
<input type="radio" name="ontologia" <?php if (isset($ontologia) && $ontologia=="true") echo "checked";?> value="true">Sim
<input type="radio" name="ontologia" <?php if (isset($ontologia) && $ontologia=="false") echo "checked";?> value="false">Nao
<br><br>


 Digite a senha da sua instituicao:
<input type="text" name="senha" /><br>

    <input type="submit" name="submit" value="Submit">

</form>

