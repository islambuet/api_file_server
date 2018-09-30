<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Api_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function json_return($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
        exit();
    }
}
