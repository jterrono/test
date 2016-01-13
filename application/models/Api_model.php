<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {


function get_product($id = null)
{
    $this->db
                ->select('*')
                ->from('products')
                ->where('id = "' . $id . '"')
                ->where('status = "1"')
                ->limit('1');

    $r = $this->db->get()->row_array();

    return $r;
}

function get_products()
{
    $this->db
                ->select('*')
                ->from('products')
                ->where('status = "1"');

    $r = $this->db->get()->result_array();

    return $r;
}


function delete_product($product_id = null)
{
    $this->db
                ->where("id = '$product_id'")
                ->update('products', array("status" => '0'));

    return true;
}


function update_product($product_id, $params = array())
{
    if(!empty($params['name']))
    {
        $d['name'] = $params['name'];
    }

    if(!empty($params['description']))
    {
        $d['description'] = $params['description'];
    }

    if(!empty($params['price']))
    {
        $d['price'] = $params['price'];
    }


    if(!empty($d))
    {
        $this->db
                    ->where('id = "' . $product_id . '"')
                    ->update('products', $d);
    }

    return true;
}

function update_product_image($product_id, $image_url)
{

        $type=substr($image_url,strrpos($image_url,'.')+1);

        $saveto = FCPATH . 'uploads/' . $product_id . '.' . $type;


        $ch = curl_init ($image_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $raw=curl_exec($ch);
        curl_close ($ch);
        if(file_exists($saveto)){
            unlink($saveto);
        }
        $fp = fopen($saveto,'x');
        fwrite($fp, $raw);
        fclose($fp);


        $d = array('image_url' => $image_url);

        if($this->db->where("id = '$product_id'")->update('products', $d) === FALSE)
        {
            return false;
        }

        return true;

}


function update_product_image1($product_id)
{
    $ext = explode('.', $_FILES['file']['name']);

    $image_url = FCPATH . '/uploads/' . $product_id . '.' . end($ext);
        //$rr = explode(';', $product['file']);

    move_uploaded_file($_FILES['file']['tmp_name'], $image_url);

    $d = array('image_url' => '/uploads/' . $product_id . '.' . end($ext));

    if($this->db->where("id = '$product_id'")->update('products', $d) === FALSE)
    {
        return false;
    }

    return true;
}

function insert_product($params = array())
{

    $d = array(
        'name' => $params['name'],
        'description' => $params['description'],
        'price' => $params['price']
      //  'image_url' => $params['image_url']
    );

    $this->db->insert('products', $d);

    $id = $this->db->insert_id();


    return $id;
}

function get_user_products($user_id)
{
    $this->db
                ->select('p.*')
                ->from('user_products up, products p')
                ->where('p.id = up.product_id')
                ->where("up.user_id = '$user_id'")
                ->where("up.status = '1'");

    $r = $this->db->get()->result_array();


    return $r;
}

function get_user_product($user_id, $product_id)
{
    $this->db
                ->select('p.*')
                ->from('user_products up, products p')
                ->where('p.id = up.product_id')
                ->where("up.product_id = '$product_id'")
                ->where("up.user_id = '$user_id'")
                ->where("up.status = '1'");

    $r = $this->db->get()->row_array();


    return $r;
}

function delete_user_product($user_id, $product_id)
{
    $this->db
                ->where("product_id = '$product_id'")
                ->where("user_id = '$user_id'")
                ->update('user_products', array("status" => '0'));

    return true;
}

function insert_user_product($user_id, $params = array())
{
    $d = array(
        'user_id' => $user_id,
        'product_id' => $params['product_id']
    );

    $this->db->insert('user_products', $d);

    $id = $this->db->insert_id();

    return $id;
}

function pre($str)
{
    echo '<pre>';
    print_r($str);
    echo '</pre>';
    die;
}

}
