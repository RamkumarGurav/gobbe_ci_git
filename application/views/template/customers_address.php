 <?=$message?>
 <div class="col-lg-6">
   <div class="card mb-3 mb-lg-0">
       <div class="card-header">
           <h3 class="mb-0">Billing Address</h3>
       </div>
       <? foreach($customer_address_data->address as $address){
         if ($address->billing_status == 1) {
           ?>
           <div class="card-body">
               <ul class="contact-infor">
    <li><img src="<?=IMAGE?>theme/icons/icon-user.svg" alt=""><strong>Name: </strong> <span><?=$address->name?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-contact.svg" alt=""><strong>Call Us:</strong><span><?=$address->number?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-location.svg" alt=""><strong>Address: </strong> <span><?=$address->address?>,<?=$address->city_name?>, <?=$address->state_name?> - <?=$address->zipcode?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-location.svg" alt=""><strong>Address Type: </strong> <span><?=$address->address_type?></span></li>

    </ul><br>
    <button type="button" class="btn btn-primary manageAddress" data-id="<?=$address->customers_address_id?>"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: max-content !important;">
Edit
</button>           </div>
           <?
         }
          ?>

     <? }?>
   </div>
</div>
<div class="col-lg-6">
   <div class="card">
       <div class="card-header">
           <h5 class="mb-0">Shipping Address</h5>
       </div>
       <? foreach($customer_address_data->address as $address){
         if ($address->delivery_status == 1) {
           ?>
           <div class="card-body">
               <ul class="contact-infor">
    <li><img src="<?=IMAGE?>theme/icons/icon-user.svg" alt=""><strong>Name: </strong> <span><?=$address->name?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-contact.svg" alt=""><strong>Call Us:</strong><span><?=$address->number?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-location.svg" alt=""><strong>Address: </strong> <span><?=$address->address?>,<?=$address->city_name?>, <?=$address->state_name?> - <?=$address->zipcode?></span></li>
    <li><img src="<?=IMAGE?>theme/icons/icon-location.svg" alt=""><strong>Address Type: </strong> <span><?=$address->address_type?></span></li>

    </ul><br>
    <button type="button" class="btn btn-primary manageAddress" data-id="<?=$address->customers_address_id?>"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: max-content !important;">
Edit
</button>
           </div>
           <?
         }
          ?>

     <? }?>
   </div>
</div>
