<?php
#Caminhos absolutos
$diretorio = basename(realpath(dirname(__FILE__) . '/..')); //pega o nome do diretório atual para caminhos absolutos
define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$diretorio}");

$bar=(substr($_SERVER['DOCUMENT_ROOT'], -1)=='/')?"":"/";

define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$bar}{$diretorio}");

#Banco de Dados
define('HOST', 'localhost');
define('DB', 'sistema');
define('USER', 'root');
define('PASS', '');

#Incluir arquivos
include(DIRREQ.'/lib/composer/vendor/autoload.php');