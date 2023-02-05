<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends model {

    //    public $Modal;
//
//    public function __construct() {
//        parent::__construct();
//    }

    public function getdetails($data) {


        $db = \Config\Database::connect();
        $tbl = $db->table('user_details');

        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $mobilenumber = $data['mobilenumber'];
        $password = $data['password'];

        $data = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'mobile_number' => $mobilenumber,
            'password' => $password
        ];

        $tbl->insert($data);
//        
//        $tbl->set('post', $image_name);
//        $tbl->where('user_id', $user_id);
//        $tbl->update();

        $query = $tbl->get();
        $result = $query->getResult();

//        ------------------------------
//        
        $builder = $db->table('user_details');

        $builder->select('user_id');
        $builder->where('name', $name);
        $builder->where('email', $email);
        $builder->where('password', $password);
        $query = $builder->get();

        $res = $query->getResult();
        return $res;

        //        $result = $query->getResult();
//        
//        return $result;
    }

    public function insertNextTbl($user_id) {
        $db = \Config\Database::connect();

        $tbl = $db->table('my_posts');

        $data = [
            'user_id' => $user_id
        ];

        $tbl->insert($data);
    }

    //    public function verifyLogin($data) {
//
//        $email = $data['email'];
//        $password = $data['password'];
//
//        $db = \Config\Database::connect();
//        $query = $db->query("SELECT 'id' FROM `user_details` WHERE email = '$email' and password = '$password'");
////        $result = $query->getResult();
////        return $result;
//    }

    public function verifyAdminLogin($data) {

        $email = $data['email'];
        $password = $data['password'];

        $db = \Config\Database::connect();
        $builder = $db->table('admin');

        $builder->select('id');
        $builder->where('email', $email);
        $builder->where('password', $password);
        $query = $builder->get();

        $res = $query->getResult();
        return $res;
    }

    public function getDashboardData($data) {

        $user_id = $data['user_id'];

        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM `user_details`");
    }

    //    ---------------------------------------- new

    public function validatelogin($data) {

        $email = $data['email'];
        $password = $data['password'];

        $db = \Config\Database::connect();
        $builder = $db->table('user_details');

        $builder->select('user_id,name,email');
        //        $builder->from('user_details');
        $builder->where('email', $email);
        $builder->where('password', $password);
        $query = $builder->get();

        //        $builder = db->select('user_id');
//        $this->db->from('user_details');
//        $this->db->where('email', $email);
//        $this->db->where('password', $password);
//        $query = $this->db->get();

        $res = $query->getResult();
        return $res;
    }

    public function uploadCover($data) {

        $image_name = $data['image'];
        $user_id = $data['user_id'];

        $db = \Config\Database::connect();
        $tbl = $db->table('user_details');

        $tbl->set('image', $image_name);
        $tbl->where('user_id', $user_id);
        $tbl->update();

        $query = $tbl->get();
        $result = $query->getResult();
//        return $result;
        if (isset($image_name)) {
            return print_r($query);
        } else {
            return 'nothing';
        }
    }

    public function uploadPost($data) {

        $image_name = $data['post'];
        $user_id = $data['user_id'];
        $desc = $data['desc'];

        $db = \Config\Database::connect();
        $tbl = $db->table('my_posts');

        $data = [
            'user_id' => $user_id,
            'post' => $image_name,
            'desc' => $desc
        ];

        $tbl->insert($data);
//        
//        $tbl->set('post', $image_name);
//        $tbl->where('user_id', $user_id);
//        $tbl->update();

        $query = $tbl->get();
        $result = $query->getResult();
//        return $result;
        if (isset($image_name)) {
            return print_r($query);
        } else {
            return 'nothing';
        }
    }

//    existing function for displaying my post

    public function displayprofile($id) {

        $db = \Config\Database::connect();
        $b = $db->table('user_details');

        $b->select('*');
        $b->where('user_id', $id);

        $query = $b->get();
        $res = $query->getResult();
        return $res;
    }

    //    for lazy loading 


    public function fetch_data($limit, $start, $id) {

        $db = \Config\Database::connect();
        $b = $db->table('user_details');

        $b->select('user_details.user_id,my_posts.post,my_posts.desc,my_posts.post_id ');
        $b->join('my_posts', 'my_posts.user_id = user_details.user_id');
        $b->where('user_details.user_id', $id);
        $b->orderBy("my_posts.post_id", "desc");
        $b->limit($limit, $start);

        $query = $b->get();
        $res = $query->getResult();
        return $res;
    }

    function viewParticularPost($id, $post_id) {

        $db = \Config\Database::connect();
        $b = $db->table('my_posts');

        $b->select('*');
        $b->where('post_id', $post_id);
        $b->where('user_id', $id);

        $query = $b->get();
        $res = $query->getResult();
        return $res;
    }

    function newPassword($user_id,$newPass) {

        $db = \Config\Database::connect();
        $cpass = $db->table('user_details');

        $cpass->set('password', $newPass);
        $cpass->where('user_id', $user_id);
        $cpass->update();
        
        $query = $cpass->get();
        $res = $query->getResult();
        
    }
    
    function checkEmailForId($email,$newPass){
        
        $d = \Config\Database::connect();
        $tb = $d->table('user_details');
        
        $tb->select('user_id,email');
        $tb->where('email', $email);
        
        $query = $tb->get();
        $result = $query->getResult();
        
        $user_id= $result[0]->user_id;
        $user_email = $result[0]->email;
 
        $this->newPassword($user_id,$newPass);
        
        return $user_email;
    }

}
