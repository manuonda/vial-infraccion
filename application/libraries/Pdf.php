<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}


//https://www.uno-de-piera.com/creacion-de-pdf-con-codeigniter-la-libreria-tcpdf/
//https://github.com/bcit-ci/CodeIgniter/wiki/TCPDF-Integration