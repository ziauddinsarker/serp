<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Home Controller
 *
 * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
 * @date 25th Dec, 2017
 *
 */
class Items extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->genlib->checkLogin();

        $this->load->model(['product']);
    }



}