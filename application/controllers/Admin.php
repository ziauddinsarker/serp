<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    /**
     * Description of Admin Controller
     *
     * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
     * @date 25th Dec, 2017
     *
     */

    public function __construct()
    {

        parent::__construct();

        $this->genlib->checkLogin();

        $this->genlib->superOnly();

        $this->load->model(['admin']);

    }

    /**
     *
     */


}