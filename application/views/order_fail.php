<? //echo "<pre>";print_r($orders);echo "</pre>";
//$orders=$this->data['orders'][0];
?>
<style type="text/css">
body{
	overflow-x: hidden;
}
	table tr td,table tr td{
		text-align: center;
	}
	@media only screen and (max-width: 500px) {

	/* table,head,tbody,th,td,tr {
		display: block;
	}*/
	/*thead tr {
	display: none;
	}*/
	tr {
	 border: 1px solid #ccc;
	}
	td {
	border: none;
	border-bottom: 1px solid #eee;
	position: relative;
	padding-left: 50%;
	white-space: normal;
	text-align:left;
	min-height: 30px;
	overflow: hidden;
	word-break:break-all;
	}
	td:before {
	position: absolute;
	top: 6px;
	left: 6px;
	width: 45%;
	padding-right: 10px;
	text-align:left;
	font-weight: bold;
	}
	td:before { content: attr(data-title); }
}
</style>
<div class="orders_page order_cnfrm">
	<div class="container">
		<div class="orders_detl">
      <h4>Order Failed;</h4>
    </div>
    </div>
    </div>
