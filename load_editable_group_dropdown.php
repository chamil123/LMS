<?php
error_reporting(E_ERROR||E_WARNING);
$branch_id=$_REQUEST['branch_id'];
$center_id=$_REQUEST['center_id'];
?>
<div class="input-group dropdown">
    <input type="text" class="form-control countrycode dropdown-toggle" >
    <ul class="dropdown-menu">
        <li><a value="asasas" data-value="+47">Chamil (+47)</a></li>
        <li><a href="#" data-value="+1">Chamil (+1)</a></li>
        <li><a href="#" data-value="+55">Chamil (+55)</a></li>
    </ul>
    <span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
</div>