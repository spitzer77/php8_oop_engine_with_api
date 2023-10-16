<?php $this->layout('layouts/main') ?>

<?php $this->start('page_content') ?>
    <script src="/js/tablesort.js"></script>
    <style>
        .arrow {
            color: #808080;
        }
    </style>
    <div>
        <h3>Votes page</h3>
        <table class="table table-striped" id="tableSort">
            <thead>
            <tr>
                <th scope="col" onclick="sortTable(0)" style="cursor: pointer">Опрос <span class="arrow"></span></th>
                <th scope="col" onclick="sortTable(1)" style="cursor: pointer; width: 100px;">Ответов <span class="arrow"></span></th>
                <th scope="col" onclick="sortTable(2)" style="cursor: pointer">Статус <span class="arrow"></span></th>
                <th scope="col" onclick="sortTable(3)" style="cursor: pointer">Дата <span class="arrow"></span></th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data['rows'] as $row) { ?>
                <tr class="align-middle">
                    <td style="width:450px;"><a href="/votes/<?= $row['id'] ?>/"><?= $row['title'] ?></a></td>
                    <td><div><?= $row['answers_count'] ?></div></td>
                    <td class="align-middle"><?=$data['selectArray'][$row['status']];?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <form method="post" action="/votes/<?=$row['id'] ?>/edit">
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                            </svg>
                            Edit
                        </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/votes/<?=$row['id']?>/delete">
                            <input type="hidden" name="REQUEST_METHOD" value="DELETE">
                            <div>
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>

        <table class="table table-striped">
        <tbody>
            <tr>
                <td>
                    <form method="post" action="/votes/create">
                        <button type="submit" class="btn btn-primary">New vote</button>
                    </form>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?=$this->section('action_content') ?>
            </tbody>
        </table>
    </div>
<?php $this->stop() ?>