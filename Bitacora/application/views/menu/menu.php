<?php
$json = json_decode($dat);
$miMenu = $_POST['menu'];
$active = $_POST['active'];
$menu = $json->{$miMenu};
?>


<div class="col-sm-12 col-md-12">
    <div class="col-md-2">
        <img src="<?= $menu->icono ?>" class="img-responsive" style="max-height: 130px;">
    </div>

    <section class="content-header">
        <h2><?= strtoupper( $menu->label) ?></h2>        
    </section>
    <div class="col-xs-9 nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <?php
            foreach ($menu->items as $item){?>
                 <li role="presentation" <?= (strtoupper($item->item) == strtoupper($active) ? 'class="active"':"")  ?>>
                     <a class="text-uppercase" href="<?= $item->url?>" aria-controls="binnacle" role="tab" <?= (isset($item->data_toggle)? 'data-toggle="tab"':"")  ?>><?= $item->item ?></a>
                 </li>
            <?php
            };
            ?>
        </ul>
    </div>
</div>



