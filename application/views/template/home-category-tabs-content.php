<?
$Val = ($tabindex ==1 ) ? 'show active' : 'fade' ;
?>
<div class="tab-pane <?=$Val?>" id="tab-<?=$tabindex?>" role="tabpanel" aria-labelledby="tab-<?=$tabindex?>">
    <div class="row product-grid-4" >
      <div class="popular_products_category_content<?=$tabindex?>-cover arrow-center position-relative">
          <div class="slider-arrow slider-arrow-2 popular_products_category_content<?=$tabindex?>-arrow" id="popular_products_category_content<?=$tabindex?>-arrows"></div>
          <div class="carausel-arrow-center popular_products_category_content_slider" id="popular_products_category_content<?=$tabindex?>">
            <?=$tab_content_html?>
          </div>
      </div>

    </div>
    <!--End product-grid-4-->
</div>
