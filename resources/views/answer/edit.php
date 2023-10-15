<?php $this->layout('answer/index') ?>

<?php $this->start('action_content') ?>
<form method="post" id="editAnswer">
    <input type="hidden" name="REQUEST_METHOD" value="PATCH">
    <tr class="align-top">
        <td>
            <div>
                <input type="text" id="inputTitle" name="form[title]" class="p-1" style="width:550px;"
                       value="<?=$data['editRow']['title']?>">
            </div>
            <div>
                <small id="errorTitle" class="form-text text-danger"></small>
            </div>
        </td>
        <td>
            <div>
                <input type="text" id="inputAnswer" name="form[answers_count]" class="p-1" style="width:60px;"
                       value="<?=$data['editRow']['answers_count']?>">
            </div>
            <div>
                <small id="errorAnswer" class="form-text text-danger"></small>
            </div>
        </td>
        <td>
            <button type="submit" class="btn btn-primary">Update</button>
        </td>
        <td></td>
    </tr>
</form>

<?php $this->stop() ?>
