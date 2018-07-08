<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Product Model
 *
 * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
 * @date 25th Dec, 2017
 *
 */
class Product extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getAll($orderBy, $orderFormat, $start = 0, $limit = '')
    {
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);

        $run_q = $this->db->get('product');

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }


}