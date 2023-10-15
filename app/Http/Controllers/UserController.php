<?php

namespace App\Http\Controllers;

use App\Classes\Cleaner;
use App\Classes\JSON;
use App\Database\Session;
use App\Classes\Hash;
use App\RMVC\Route\Route;
use App\RMVC\View\View;
use App\Database\DB;

class UserController extends Controller
{
    use Cleaner;
    private DB $db;
    private ? array $form = [];

    public function __construct()
    {
        $this->db = new DB();
        $this->form = $_POST['form'] ?? [];
        if ($this->form) $this->checkSpecialChars($this->form);
    }
    public function register()
    {
        return View::view2('user.register');
    }
    public function auth()
    {
        extract($this->form); // а почему бы и нет :)

        $query = "SELECT id, email, password FROM users WHERE email='$email'";
        $user = $this->db->row($query);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                Session::setSessionVar('USER_AUTH', $user,3600);
                return JSON::toJSONSuccess('Authentication successfully', $this->form, '/user/personal');
            }
            else {
                return JSON::toJSONError('Password invalid', $this->form, '#errorPassword');
            }
        }
        else {
            return JSON::toJSONError("User does not exist", $this->form, '#errorLogin');
        }
    }
    public function login()
    {
        return View::view2('user.login');
    }
    public function logout()
    {
        unset($_SESSION['USER_AUTH']);
        Route::redirect('/user/login');
    }
    public function personal()
    {
        return View::view2('user.personal');
    }

    public function store()
    {
        $email = $this->form['email'];
        $password = HASH::bcrypt($this->form['password']);

        $query = "SELECT id, email, password FROM users WHERE email='$email'";
        $user = $this->db->row($query);
        if ($user) {
            return JSON::toJSONError("User with this email already exists.", $this->form, '#errorEmail');
        }

        //sqlite CURRENT_TIMESTAMP not worked with actual timezone
        $currentTimestamp = $this->currentTimestamp();

        $insert = $this->db->query("INSERT INTO users(email,password, created_at) VALUES('$email','$password', '$currentTimestamp')");
        $lastInsertId = $this->db->lastInsertId();

        $addedUser = ['id' => $lastInsertId, 'email' => $email];

        if ($insert) {
            SESSION::setSessionVar('USER_AUTH', $addedUser, 3600);
            return JSON::toJSONSuccess('Authentication successfully', $this->form, '/user/personal');
        }
        else {
            return JSON::toJSONError("Error with database, try to register some later.", $this->form, '#errorPassword');
        }
    }
}