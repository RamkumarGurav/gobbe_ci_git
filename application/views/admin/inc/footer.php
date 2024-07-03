</div>
</div>
</section>
<footer>

  <?
  if(!empty($page_type))
  {
  	if($page_type=="list")
  	{
  		$this->load->view('admin/inc/files/footer-list', $this->data);
  	}
  }
  else
  {
  	$this->load->view('admin/inc/files/footer', $this->data);
  }
  ?>
</footer>

</body>
</html>
