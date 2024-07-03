<h3>Popular Products</h3>
<ul class="nav nav-tabs links" id="myTab" role="tablist">

  <?php
  $i = 1;
   foreach ($menu as $m ):
     $Val = ($i ==1 ) ? 'active' : '' ;
     ?>
    <li class="nav-item" role="presentation">
        <button class="nav-link <?=$Val?>" id="nav-tab-<?=$i?>" data-bs-toggle="tab" data-bs-target="#tab-<?=$i?>" type="button" role="tab" aria-controls="tab-<?=$i?>" aria-selected="true"><?=$m->name?></button>
    </li>
  <?php
   $i++;
 endforeach;
 ?>
</ul>
