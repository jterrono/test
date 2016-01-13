<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'product_put' => array(
		array('field' => 'name', 'label' => 'Product Name', 'rules' => 'trim|required'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required|max_length[550]'),
		array('field' => 'price', 'label' => 'Price', 'rules' => 'trim|required'),
	),
    'product_post' => array(
		array('field' => 'name', 'label' => 'Product Name', 'rules' => 'trim'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|max_length[550]'),
		array('field' => 'price', 'label' => 'Price', 'rules' => 'trim'),
	),
	'user_product_put' => array(
		array('field' => 'product_id', 'label' => 'Product ID', 'rules' => 'trim|required')
	),
);

?>