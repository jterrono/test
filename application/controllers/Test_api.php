<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

    private $url;
    private $username;
    private $password;

	function __construct() {
		parent::__construct();

        $this->url = 'http://jimmyterrono.com/lawline/api';
        $this->username = 'michelleb@gmail.com';
        $this->password = 'michelle123';
	}


    /**
     * List ALL Products
     *
     */
    function list_products()
    {
        $url = $this->url . '/products';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }


    /**
     * Get Product
     *
     */
    function get_product()
    {
        $url = $this->url . '/product/5';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }

    /**
     * Add New Product
     */
    function add_product()
    {
        $url = $this->url . '/product';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");


        $args = array(
            'name' => 'Sweatshirt',
            'description' => 'This is my sweatshirt',
            'price' => '19.99'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }

    /**
     * Update Product
     */
    function update_product()
    {
        $url = $this->url . '/product/5';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");


        $args = array(
            'name' => 'Sweatshirt',
            'description' => 'This is my UPDATE sweatshirt',
            'price' => '19.99'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }

    /**
     * Upload product image
     */
    function upload_product_image()
    {

        $url = $this->url . '/product_image/11';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");

        $args = array(

            'image_url' => 'http://jimmyterrono.com/lawline/assets/t-shirt.jpg'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';




    }

    // Helper function courtesy of https://github.com/guzzle/guzzle/blob/3a0787217e6c0246b457e637ddd33332efea1d2a/src/Guzzle/Http/Message/PostFile.php#L90
      function getCurlValue($filename, $contentType, $postname)
      {
          // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
          // See: https://wiki.php.net/rfc/curl-file-upload
          if (function_exists('curl_file_create')) {
              return curl_file_create($filename, $contentType, $postname);
          }

          // Use the old style if using an older version of PHP
          $value = "@{$filename};filename=" . $postname;
          if ($contentType) {
              $value .= ';type=' . $contentType;
          }

          return $value;
      }

     /**
     * Upload product image
     */
    function upload_product_image1()
    {

        $url = $this->url . '/product_image1/1';

        $headers = array("API-USERNAME: $this->username", "API-KEY: $this->password");

        $filename = FCPATH . 'assets/t-shirt.jpg';


        $args = array(

            'file' => '@' . $filename
        );


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, ($args));

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';




    }

    /**
     * Delete Product
     */
    function delete_product()
    {
        $url = $this->url . '/product/6';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }


    /**
     * Add Product to User
     */
    function add_user_product()
    {
        $url = $this->url . '/user_product/5';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");

        $args = array(
            'product_id' => '5'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }

    /**
     * Delete Product from User
     */
    function delete_user_product()
    {
        $url = $this->url . '/user_product/5';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }

    /**
     * List ALL User Products
     *
     */
    function list_user_products()
    {
        $url = $this->url . '/user_products';

        $headers = array("Content-Type: application/json; charset=utf-8", "API-USERNAME: $this->username", "API-KEY: $this->password");


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($result));
        echo '</pre>';
    }





}