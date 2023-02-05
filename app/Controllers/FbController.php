<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegisterModel;
use CodeIgniter\Files\File;
use Config\Services;

/**
 * Description of FbController
 *
 * @author brein
 */
class FbController extends BaseController {

    public function __construct() {
        $session = \Config\Services::session();
    }

    public function session() {

//          use here to store session variables so it will be easy to look for data to be restored or to use it in code
    }

    public function login() {
        return view('Views/pages/login');
    }

    public function add() {
        $user = new RegisterModel;
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'address' => $request->getPost('address'),
            'mobilenumber' => $request->getPost('mobilenumber'),
            'password' => $request->getPost('password')
        ];
        //            print_r($data['name']);
//        $user_email = $data['email'];
        $a = $user->getdetails($data);
        $uid = $a[0]->user_id;
        $user->insertNextTbl($uid);
        if ($data) {
//         $this->registrationEmail($user_email);
            $data = ["status" => 'success'];
            return $this->response->setJSON($data);
        }
    }

    public function loginUser() {
        $user = new RegisterModel;
        $request = \Config\Services::request();

        $data = [
            "email" => $request->getPost('email'),
            "password" => $request->getPost('password')
        ];
        $user->verifyLogin($data);
        $user->getInsertId($data);
        $data = ["status" => "success"];
        return $this->response->setJSON($data);
    }

    public function register() {

        return view('/pages/register');
    }

    public function home() {

        $details = new RegisterModel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $id = $session->get('user_id');
        $result = $details->displayprofile($id);
        if (count($result)) {
            $data['details'] = $result;
//                        return $this->response->setJSON($data);
            return view('pages/home_content', $data);
        } else {
            $dt = ['status' => 'success'];
            return $this->response->setJSON($dt);
        }

//        return view('pages/home_content');
    }

    public function admin() {

        return view('/pages/adminlogin');
    }

    public function adminhome() {

        return view('/pages/admin_home');
    }

    public function verifyAdminLogin() {
        $admin = new RegisterModel();
        $request = \Config\Services::request();
        $data = [
            'email' => $request->getPost('email'),
            'password' => $request->getPost('password')
        ];
        $result = $admin->verifyAdminLogin($data);

        if (count($result)) {
            $d = ['status' => 'success'];
        } else {
            $d = ['status' => 'sothappal'];
        }

        return $this->response->setJSON($d);
    }

    public function dashboard() {
        $admin = new RegisterModel();
        $request = \Config\Services::request();
        $data = [
            'id' => $request->getPost('user_id')
        ];
        $admin->verifyAdminLogin($data);
        $admin->getInsertId($data);
        $data = [
            'status' => 'success',
            'values' => $data
        ];
        return $this->response->setJSON($data);
    }

    //    ------------------------------new

    public function newlogin() {

        $user = new RegisterModel();
        $request = \Config\Services::request();
        $data = [
            "email" => $request->getPost('email'),
            "password" => $request->getPost('password')
        ];

        $result = $user->validatelogin($data);
        //        echo '<pre>';
//        print_r($result);
//        die;
        if (!empty($result)) {

            $session = \Config\Services::session();

//            to store in session    sessions


            $user_id = $result[0]->user_id;
            $name = $result[0]->name;
            $email = $result[0]->email;

            $session->set('name', $name);
            $session->set('user_id', $user_id);
            $session->set('email', $email);

            $f = [
                'status' => 'success',
                "details" => $result
            ];
            return $this->response->setJSON($f);
        } else {
//            $f = ["status" => "sothappal"];
//            return $this->response->setJSON($f);
            return redirect()->back()->with('status', 'Credentials you entered is incorrect !!!');
        }
    }

//    EMAIL on Registration
//    public function registrationEmail($user_email) {
//        
//        $subject = 'breinard';
//        $message = '<strong> Thanks for registering into my Website</strong><br><p>You are now all set to go !!!!!</p>';
//        
//        $email = \Config\Services::email();
//        
////        $email->setFrom('lightyagami9442@gmail.com');
//        $email->setTo($user_email);
//        $email->setSubject($subject);
//        $email->setMessage($message);
////        $email->setProtocol('smtp');
//        if($email->send()){
//            echo 'email success';
//        }else{
//            echo 'email failed';
//        }
//    }
//    LOGOUT


    public function logout() {

        $session = \Config\Services::session();
        $session->destroy();
        return 'success';
    }

    public function uploadCoverPicture() {

        $save = new RegisterModel();
        $request = \Config\Services::request();
        $image = \Config\Services::image();

        $a = ['cover_pic'];
        $validation = [
            'cover_pic' => [
                'rules' => 'uploaded[cover_pic]' .
                '|is_image[cover_pic]' .
                '|mime_in[cover_pic,image/jpg,image/png,image/jpeg]'
            ]
        ];

        if (!$this->validate($validation)) {
            return redirect()->to('/home')->with('status', 'File type not supoprted');
        }

        $file = $request->getFile('cover_pic');

        $id = session('user_id');
        $path = $file->store();
        // if ($file->isValid() && !$file->hasMoved()) {
        //     $imgName = $file->getRandomName('image');
        //     $file->move(WRITEPATH.$imgName);
        // }
        $data = [
            'user_id' => $id,
            'image' => $path,
        ];

        $result = $save->uploadCover($data);
        return redirect()->to('/home')->with('status', 'Image Updated Successfully !!!');
    }

    public function imgcheck() {

        $save = new RegisterModel();
        $img = $this->request->getPost('data');
        $id = session('user_id');
        $folderPath = "uploads/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';

        file_put_contents($file, $image_base64);

        if (file_put_contents($file, $image_base64)) {
            $data = [
                'user_id' => $id,
                'image' => $file
            ];
            $result = $save->uploadCover($data);
            return redirect()->to('/home')->with('status', 'Image Updated Successfully !!!!!');
        }
        return redirect()->to('/home')->with('status', 'Failed to upload image !!!!');
    }

    public function uploadPost() {

        $save = new RegisterModel();
        $img = $this->request->getPost('data');
        $id = session('user_id');
        $folderPath = "uploads/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';
        $desc = $this->request->getPost('desc');

        file_put_contents($file, $image_base64);

        if (file_put_contents($file, $image_base64)) {
            $data = [
                'user_id' => $id,
                'desc' => $desc,
                'post' => $file
            ];
            $result = $save->uploadPost($data);
            return redirect()->to('/home')->with('status', 'Image Updated Successfully !!!!!');
        }
        return redirect()->to('/home')->with('status', 'Failed to upload image !!!!');
    }

//    for lazy loading
//
//    function index() {
//        $this->load->view('scroll_pagination');
//    }

    function fetch() {

        $details = new RegisterModel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $id = $session->get('user_id');
        $limit = $this->request->getPost('limit');
        $start = $this->request->getPost('start');

        $output = '';
//        $result = $details->fetch_data($limit, $start, $id);
//        $this->load->model('scroll_pagination_model');
        $data = $details->fetch_data($limit, $start, $id);
        if ((count($data)) > 0) {
//            foreach ($data as $row) {
//                $output .= '
//    <div class="post_data">
//     <h3 class="text-danger">' . $row->post . '</h3>
//     <p>' . $row-> desc. '</p>';
//            }
        }
        return $this->response->setJSON($data);
    }

    function viewPost() {
        $postView = new RegisterModel();
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $id = $session->get('user_id');
        $post_id = $this->request->getPost('post_id');

        $result = $postView->viewParticularPost($id, $post_id);

        if (count($result)) {
//            $data['post'] = $result;
            return $this->response->setJSON($result);
//            return view('pages/home_content', $data);
        } else {
            $dt = ['status' => 'success'];
            return $this->response->setJSON($dt);
        }
    }

//    function sendEmail() {
//        $to = ;
//        $message =;
//    }
//    

    function forgotPasswordPage() {
        return view('/pages/forgotPassword');
    }

    function sendMail() {
        $req = \Config\Services::request();
        $mail = \Config\Services::email();
        
        $email = $this->request->getPost('email');
        $msg = $this->request->getPost('msg');
        $subject = $this->request->getPost('subject');
        
        $mail->setFrom('lightyagami9442@gmail.com');
        $mail->setTo($email);
        $mail->setSubject($subject);
        $mail->setMessage($msg);

        if ($mail->send()) {
            echo 'email sent successfully';
        } else {
            $data = $mail->printDebugger(['header']);
            print_r($data);
        }
    }

    function changePassword() {

        $req = \Config\Services::request();
        $change = new RegisterModel();

        $email = $this->request->getPost('email');
        $newPass = $this->request->getPost('newPass');

//        $result = $change->newPassword($email, $newPass);
        $result = $change->checkEmailForId($email,$newPass);
        
//        $qemail = $this->response->setJSON($result);
        if ($result) {
//            return $this->response->setJSON($result);
            return $result;
        }
    }

}
