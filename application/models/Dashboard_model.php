
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Description of Admin Model
 *
 * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
 * @date 25th Dec, 2017
 *
 */
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return array
     */
    function get_all_product()
    {
        $this->db->select('*');
        $this->db->select('serp_company.company_name as product_company_name');
        $this->db->from('serp_product');
        $this->db->join('serp_company','serp_product.product_company = serp_company.company_id');
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_product_stock()
    {
        $this->db->select('serp_product_stock.stock_id,serp_product.product_name AS stock_product_name,serp_product_stock.stock_quantity AS stock_quantity,serp_product_stock.stock_date AS stock_date');
        $this->db->from('serp_product');
        $this->db->join('serp_product_stock','serp_product_stock.stock_product_id = serp_product.product_id');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return array
     */
    function get_product_name()
    {
        $this->db->select('product_id,product_name');
        $this->db->from('serp_product');
        $this->db->order_by('product_name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $product_name_id = array('');
        $product_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($product_name_id, $result[$i]->product_id);
            array_push($product_name, $result[$i]->product_name);
        }
        return $doc_specility_result = array_combine($product_name_id, $product_name);
    }

    /**
     *
     *
     *
     * ****************Shop********************
     *
     */
    /**
     * @return array
     */
    function get_all_shop()
    {
        $this->db->select('*');
        $this->db->from('serp_shop');
        $query = $this->db->get();
        return $query->result();
    }

 /**
     *
     *
     *
     * ****************Company********************
     *
     */
    /**
     * @return array
     */
    function get_all_company()
    {
        $this->db->select('*');
        $this->db->from('serp_company');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return array
     */
    function get_company_name()
    {
        $this->db->select('company_id,company_name');
        $this->db->from('serp_company');
        $this->db->order_by('company_name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $company_id = array('');
        $company_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($company_id, $result[$i]->company_id);
            array_push($company_name, $result[$i]->company_name);
        }
        return $doc_specility_result = array_combine($company_id, $company_name);
    }



}