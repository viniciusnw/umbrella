<?php

/*==============================================================================
 * 
 * Configurações php
 */
#Formatacao
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 

#Fuso horario
date_default_timezone_set('America/Sao_Paulo');

#Memoria php
ini_set('memory_limit', '1024M');

#Exibicao de erros na tela
ini_set( 'display_errors', true );

#Tempo de execucao
set_time_limit(0);

/*==============================================================================
 * Constantes
 */
#Caminho relativo 
define ( 'RAIZ', '/' . basename( __DIR__ ) . '/' );

#Caminho absoluto Site
define ( 'SITE_PATH', realpath( dirname(__FILE__) ) );

#Url do site
define('URL', '');

/*==============================================================================
 * Controllador, metodo e parametros default
 * Caso um controller/metodo não seja passado pela url, o padrao é chamado
 */
#Classe Default
$controller_ = 'Home';

#Metodo Default
$method      = 'index';

#Parametros default para o metodo
$parans      =  null;

/*==============================================================================
 * Globais
 */
global $url, $applicationDirs;

#Url Solicitada (classe / metodo)
$GLOBALS['url'] = [$controller_, $method];

#Diretorios para serem exluidos da busca do autoload
#$GLOBALS['exludeDirs'] = ['.', '..', 'view', 'nbproject'];

#Pastas para autoload da aplicacao
$GLOBALS['applicationDirs'] = [ 'controller', 'services/sendGrid', 'application' ];
