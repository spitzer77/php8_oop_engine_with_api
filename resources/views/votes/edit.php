<?php $this->layout('votes/index') ?>

<?php $this->start('action_content') ?>
<form method="post" id="editVotes">
    <input type="hidden" name="REQUEST_METHOD" value="PATCH">
    <tr class="align-top">
        <td class="align-middle d-block">
            <div class="d-block">
                <input type="text" id="inputTitle" name="form[title]" style="width:400px;" class="p-1" value="<?=$data['rowEdit']['title']?>">
            </div>
            <div class="d-block">
                <small id="errorTitle" class="form-text text-danger"></small>
            </div>
        </td>
        <td></td>
        <td>
            <select name="form[status]" class="me-2 p-1">
                <?php
                foreach ($data['selectArray'] as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php
                    if ($data['rowEdit']['status'] == $key){ ?>selected<?php
                    } ?>><?= $value ?></option>
                    <?php
                } ?>
            </select>
        </td>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary">Update</button>
        </td>
        <td></td>
    </tr>
</form>

<?php $this->stop() ?>
