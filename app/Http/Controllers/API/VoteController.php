<?php

namespace App\Http\Controllers\API;

use App\Database\DB;
use App\Database\Session;
use App\Http\Controllers\Controller;
use App\Classes\JSON;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->db = new DB();
    }

    public function index(): string
    {
        $query = "SELECT vt1.id, vt1.title, vt1.status
                    FROM votes vt1
                    WHERE vt1.vote_id=0 
                    ORDER BY RANDOM()
                    LIMIT 1";

        $randomVote = $this->db->row($query);
        $randomVoteId = (int)$randomVote['id'];

        $query = "SELECT title, answers_count FROM votes vt2 
                    WHERE vt2.vote_id=$randomVoteId ";
        $votes = $this->db->query($query);

        $randomVote['votes'] = $votes;

        return JSON::toJson($randomVote);
    }

    public function index_auth()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT id, email, password FROM users WHERE email='$email'";
        $user = $this->db->row($query);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                unset($user['password']);

                $query = "SELECT vt1.id, vt1.title, vt1.status
                    FROM votes vt1
                    WHERE vt1.vote_id=0 AND vt1.user_id=".$user['id']." 
                    ORDER BY RANDOM()
                    LIMIT 1";

                $randomVote = $this->db->row($query);

                if (!isset($randomVote)) {
                    return JSON::toJSONError('You haven`t any personal created vote', $_POST);
                }

                $randomVoteId = (int)$randomVote['id'];

                $query = "SELECT title, answers_count FROM votes vt2  WHERE vt2.vote_id=$randomVoteId ORDER BY answers_count DESC";
                $votes = $this->db->query($query);

                $randomVote['votes'] = empty($votes) ? null : $votes;

                //return JSON::toJSONSuccess('Show random vote', );
                return JSON::toJson($randomVote);
            }
            else {
                return JSON::toJSONError('This password incorrect', $_POST);
            }
        }
        else {
            return JSON::toJSONError("User $email does not exist", $_POST);
        }
    }
}