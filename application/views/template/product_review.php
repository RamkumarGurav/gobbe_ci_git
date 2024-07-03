
							
<?
//print_r($product_questions_list);
if(count($product_reviews_list)>0){
 ?>
                              <? $i=0;foreach($product_reviews_list as $prorow){?> 
                              
                              
<div class="row">
    <div class="col-sm-2">
        <div class="review-block-name"><a><? echo $prorow['customer_name'];?></a></div>
        <div class="review-block-date"><? echo date('M d Y', strtotime($prorow['added_on']));?><br><?=dateDiff($prorow['added_on'])?> </div>
        <span class="verfy_buyer"><i class="fa fa-check-square-o"></i>Verified Buyer</span>
    </div>
    <div class="col-sm-10">
    <input id="input-21b" value="<? echo $prorow['rating']?>" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="xs" required title="" disabled="disabled">
        
        <div class="review-block-title"><? echo $prorow['review_title'];?></div>
        <p class="main_paragf"><? echo $prorow['review'];?></p>
    </div>
</div>
<hr />
                              
                              <?php /*?><div class="clearfix paddT20 mainreviweContent">
                           <p><strong><? echo $prorow['review_title'];?></strong></p>
                           <ul class="">
                              <li><input id="input-21b" value="<? echo $prorow['rating']?>" type="text" class="rating" data-min=0 data-max=5 data-step=1 data-size="xs" required title="" disabled="disabled"> </li>
                              <li><? echo $prorow['customer_name'];?></li>
                              <li><? echo date('d/m/Y', strtotime($prorow['added_on']));?></li>
                           </ul>
                           <div class="clearfix mainreviweContenttext">
                              <p><? echo $prorow['review'];?></p>
                              <a class="ReadMoreReview"></a> 
                           </div>
                           <div class="clearfix">
                              <ul class="reviewhelpful">
                                 <li><a class="reviewhelpclick" data-target="#LoginModal" data-toggle="modal"><span class="fa fa-thumbs-up"></span>Helpful</a></li>
                              </ul>
                           </div>
                        </div><?php */?>
                              <? } ?>
<? }else{ ?> 
<div class="alert alert-info" role="alert">Be first to write the review</div>
<? } 

function dateDiff($date)
{
	$today = date('Y-m-d');
	$yesterday = date('Y-m-d' , strtotime('-1 day'));
	if($today == date('Y-m-d' , strtotime($date)))
	{
		$text = 'Today';
	}
	else if($yesterday == date('Y-m-d' , strtotime($date)))
	{
		$text = 'Yesterday';
	}
	else
	{
	    $startTimeStamp = strtotime($date);
    	$endTimeStamp = time();
    	
    	$timeDiff = abs($endTimeStamp - $startTimeStamp);
    	$numberDays = $timeDiff/86400;  // 86400 seconds in one day
    	//echo $startTimeStamp.' : '.$endTimeStamp.' : '.$timeDiff.' : '.$numberDays.'<br>';
    	
    	// and you might want to convert to integer
    	$numberDays = intval($numberDays);
    	//echo $numberDays;
		$text = $numberDays.' Days ago';
	}
	return $text;
}
?>
     
     

							