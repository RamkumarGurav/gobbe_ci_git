
<script>
var options = {
  key: '<?php echo $data['key']?>',
  amount: '<?php echo $data['amount']?>',
  name: 'Gobbe India Private Limited',
  currency: 'INR',
  description: '<?php echo $data['description']?>',
  image: '<?php echo $data['image']?>',
  order_id: '<?php echo $data['order_id']?>',
  notes: {shopping_order_id : '<?php echo $data['prefill']['invoice_id']?>'},
  prefill: {name : '<?php echo $data['prefill']['name']?>' , email: '<?php echo $data['prefill']['email']?>',contact: '<?php echo $data['prefill']['contact']?>'},
  handler: demoSuccessHandler,
  modal: {
    handleback: true
  }
}</script><script>window.r = new Razorpay(options);

 r.open()
document.getElementById('paybtn').onclick = function(){
  r.open()
  $('#optinchat-container').hide();
}
</script>
