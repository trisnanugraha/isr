<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('Template','database','form_validation','session','pagination','upload', 'Fungsi');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','form','text','myfunction_helper','html', 'date');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array();
$config['composer_autoload'] = "./vendor/autoload.php";
