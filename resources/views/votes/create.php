<?php $this->layout('votes/index') ?>

<?php $this->start('action_content') ?>
<form method="post" id="storeVotes" action="/votes/store">
    <tr class="align-top">
        <td class="align-middle d-block" colspan="2">
            <div class="d-block">
                <input type="text" id="inputTitle" name="form[title]" style="width:400px;" class="p-1" value="">
            </div>
            <div class="d-block">
                <small id="errorTitle" class="form-text text-danger"></small>
            </div>
        </td>
        <td>
            <select name="form[status]" class="me-2 p-1">
                <?php
                foreach ($data['selectArray'] as $key => $value) { ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php
                } ?>
            </select>
        </td>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary">Store</button>
        </td>
        <td></td>
    </tr>
</form>

<?php $this->stop() ?>