<?php
#Caminhos absolutos
$diretorio = basename(realpath(dirname(__FILE__) . '/..')); //pega o nome do diretório atual para caminhos absolutos
define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$diretorio}"); //pega a url da aplicação

$bar=(substr($_SERVER['DOCUMENT_ROOT'], -1)=='/')?"":"/";

define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$bar}{$diretorio}"); //pega o local da pasta

#Banco de Dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');

#Incluir arquivos
include(DIRREQ.'/lib/composer/vendor/autoload.php');