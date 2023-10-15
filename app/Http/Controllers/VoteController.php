<?php

namespace App\Http\Controllers;

use App\Classes\Cleaner;
use App\Database\DB;
use App\RMVC\Route\Route;
use App\RMVC\View\View;
use http\Encoding\Stream\Debrotli;

class VoteController extends Controller
{
    use Cleaner;

    private DB $db;
    private ? array $form = [];
    private array $selectArray = [0 => 'Unpublished', 1 => 'Published'];

    public function __construct()
    {
        $this->db = new DB();
        $this->form = $_POST['form'] ?? [];
        if ($this->form) $this->checkSpecialChars($this->form);
    }
    public function index(): string
    {
//        $query = "SELECT vt1.id, vt1.title, vt1.status, COUNT(vt2.id) AS answers_count
//                    FROM votes AS vt1 INNER JOIN users ON (vt1.user_id = users.id)
//                        LEFT JOIN votes AS vt2 ON (vt2.vote_id = vt1.id)
//                    WHERE users.id = ". $this->authId()."
//                        AND vt1.vote_id = 0
//                    GROUP BY vt1.id";
//
//        $rows = $this->db->query($query);
        $rows = $this->getVotes();
        $selectArray = $this->selectArray;

        return View::view2('votes.index', compact('rows', 'selectArray'));
    }

    private function getVotes(): array | null {
        $query = "SELECT vt1.id, vt1.title, vt1.status, COUNT(vt2.id) AS answers_count, vt1.created_at
                    FROM votes AS vt1 INNER JOIN users ON (vt1.user_id = users.id)
                        LEFT JOIN votes AS vt2 ON (vt2.vote_id = vt1.id)
                    WHERE users.id = ". $this->authId()."
                        AND vt1.vote_id = 0
                    GROUP BY vt1.id";

        $rows = $this->db->query($query);
        return $rows;
    }

    public function edit(int $vote)
    {
        $rows = $this->getVotes();
        $selectArray = $this->selectArray;

        $result = array_reduce($rows, function($array, $item) {
            $array[$item['id']] = $item;
            return $array;
        }, []);

        $rowEdit = $result[$vote];

        return View::view2('votes.edit', compact('rows', 'selectArray', 'rowEdit'));
    }

    public function update(int $vote)
    {
        $form = $this->form;
        $currentTimestamp = $this->currentTimestamp();

        $query = "UPDATE votes 
                    SET title='".$form['title']."', 
                        status=".(int)$form['status'].",
                        updated_at='$currentTimestamp' 
                    WHERE id=".(int)$vote."
        ";

        $this->db->query($query);
        Route::redirect("/votes");
    }

    public function delete($vote)
    {
        $query = "DELETE FROM votes WHERE vote_id=$vote OR id=$vote";
        $this->db->query($query);
        Route::redirect("/votes");
    }

    public function create()
    {
        $rows = $this->getVotes();
        $selectArray = $this->selectArray;

        return View::view2('votes.create', compact('rows', 'selectArray'));
    }

    public function store()
    {
        $title = $this->form['title'];
        $currentTimestamp = $this->currentTimestamp();

        $query = "INSERT INTO votes (title, status, vote_id, user_id, created_at) 
                            VALUES ('$title', 0, 0, ".$this->authId().", '$currentTimestamp')";
        $this->db->query($query);
        Route::redirect("/votes");
    }
}