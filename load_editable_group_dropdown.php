<?php
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include './Module/model/MemberModel.php';
$member = new Member();

$branch_id = $_REQUEST['branch_id'];
$center_id = $_REQUEST['center_id'];
$result = $member->getAllMemberGroupByCenter($branch_id, $center_id);
?>
<script src="dist/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script>

    $(function () {
        $('.dropdown-menu a').click(function () {
            $(this).closest('.dropdown').find('input.countrycode')
                    .val($(this).attr('data-value'));
        });
    });
</script>
<div class="input-group dropdown">
    <input type="text" class="form-control countrycode dropdown-toggle" >
    <ul class="dropdown-menu">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li><a href="#" data-value="<?= $row['group_number']; ?>"><?= $row['group_number']; ?></a></li>
        <?php } ?>
    </ul>
    <span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
</div>