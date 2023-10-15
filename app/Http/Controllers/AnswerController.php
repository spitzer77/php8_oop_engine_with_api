<?php

namespace App\Http\Controllers;

use App\Classes\Cleaner;
use App\Database\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

class AnswerController extends Controller
{
    use Cleaner;

    private DB $db;
    private ?array $form = [];

    public function __construct()
    {
        $this->db = new DB();

        $this->form = $_POST['form'] ?? [];
        if ($this->form) {
            $this->checkSpecialChars($this->form);
        }
    }

    public function index(int $vote): string
    {
        $query = "SELECT title FROM votes WHERE id=$vote AND vote_id=0";
        $title = $this->db->single($query);

        if (empty($title)) {
            Route::redirect("/votes");
            exit;
        }

        $rows = $this->getAnswerList($vote);

        return View::view2('answer.index', compact('rows', 'title', 'vote'));
    }

    private function getAnswerList(int $vote): array|null
    {
        $query = "SELECT vt2.id, vt2.vote_id, vt2.title, vt2.answers_count
                    FROM votes vt2 
                        INNER JOIN votes vt1 ON (vt2.vote_id = vt1.id)
                        INNER JOIN users u ON (vt1.user_id = u.id) 
                    WHERE vt1.id = $vote";
        $rows = $this->db->query($query);

        return $rows;
    }

    public function edit($vote, $answer): string
    {
        $rows = $this->getAnswerList($vote);
        $editRow = $this->arrayToIdKey($rows, 'id')[$answer];

        return View::view2('answer.edit', compact('rows', 'editRow', 'vote'));
    }

    public function update(int $vote, int $answer)
    {
        if ($this->isAnswerBelongToUserBeforeAction($vote, $answer)) {
            extract($this->form);
            $query = "UPDATE votes SET title='$title', answers_count=$answers_count WHERE id=$answer";
            $this->db->query($query);
            Route::redirect("/votes/$vote");
        } else {
            header('HTTP/1.1 401 Unauthorized');
            die;
        }
    }

    public function delete(int $vote, int $answer)
    {
        // MySQL all-in-one with userId check
//        $query = "DELETE vt2
//                    FROM votes vt2
//                        INNER JOIN votes vt1 ON (vt2.vote_id = vt1.id)
//                        INNER JOIN users u ON (vt1.user_id = u.id)
//                    WHERE vt2.id = $id AND u.id = $ownerId";

        if ($this->isAnswerBelongToUserBeforeAction($vote, $answer)) {
            $query = "DELETE FROM votes WHERE id=$answer";
            $this->db->query($query);
            Route::redirect("/votes/$vote");
        }
        else {
            header('HTTP/1.1 401 Unauthorized');
            die;
        }
    }

    private function isAnswerBelongToUserBeforeAction(int $vote, int $answer): array | null
    {
        $query = "SELECT vt1.id
                    FROM votes vt2 
                        INNER JOIN votes vt1 ON (vt2.vote_id = vt1.id)
                    WHERE vt1.user_id=" . $this->authId() . " AND vt1.id=$vote AND vt2.id=$answer";
        return $this->db->query($query);
    }

    public function create(int $vote)
    {
        $rows = $this->getAnswerList($vote);

        return View::view2('answer.create', compact('rows', 'vote'));
    }

    public function store($vote)
    {
        $currentTimestamp = $this->currentTimestamp();

        extract($this->form);
        $query = "INSERT into votes (title, answers_count, status, vote_id, user_id, created_at) 
                    VALUES ('$title', $answers_count, 0, $vote, ".$this->authId().", '$currentTimestamp')";
        $this->db->query($query);

        Route::redirect("/votes/$vote");
    }

}