<?php if (System\Src\Session::has('errors')) { ?>
<div class="alert alert-danger" role="alert">
    <?=System\Src\Session::getFlash('errors')?>
</div>
<?php } ?>


<?php if (System\Src\Session::has('success')) { ?>
<div class="alert alert-success" role="alert">
    <?=System\Src\Session::getFlash('success')?>
</div>
<?php } ?>
