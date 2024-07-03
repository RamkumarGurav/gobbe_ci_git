<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<?php if (!empty($js)) { foreach ($js as $j) { echo '<script src="' . ADMINJS . $j . '" type="text/javascript"></script>'; } } ?>

<script src="<?=_admin_files_?>js/script.js"></script>
<!-- DataTables -->
<script src="<?=_lte_files_?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=_lte_files_?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=_lte_files_?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=_lte_files_?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=_lte_files_?>plugins/toastr/toastr.min.js"></script>
<!-- <script src="<?=_lte_files_?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> -->



<script type="text/javascript">
  window.addEventListener('load' , function(){
$(document).on("click",".tpc-cancel",function() {
$(".tpi-add-attr").removeClass("tpi-add-attr-b");  });
$(document).on("click",".tpa-conp-close",function() {
$(".tpi-add-attr").removeClass("tpi-add-attr-b");
});
});

function editModule(module_name,id) {
  $.ajax({
    url: module_name+'/edit/'+id,
    type: 'post',
    dataType: "json",
    success: function( response ) {
      $(".module_data").html( response.module_data );
      $(".tpi-add-attr").toggleClass("tpi-add-attr-b");

    },
    error: function (request, error) {
      toastrDefaultErrorFunc("Unknown Error. Please Try Again");
      $("#quick_view_model").html( 'Unknown Error. Please Try Again' );
    }
  });
}

		function editCombination(module_name,comb_id,id,seo) {
		$.ajax({
			url: module_name+'/combination_edit/'+comb_id+'/'+id,

			type: 'post',
			dataType: "json",
			success: function( response ) {
				$(".apc-conp").html( response.module_data );
				$(".apc-conp").toggleClass("apc-conp-b");
        $('#product_display_name').focus()
        if(seo == 1){
      
          var popup = document.getElementById('comb_data');
           //popup.style.display = 'block';
           popup.scrollTop = popup.scrollHeight;
        }
			},
			error: function (request, error) {
				toastrDefaultErrorFunc("Unknown Error. Please Try Again");
				//$("#quick_view_model").html( 'Unknown Error. Please Try Again' );
			}
		});
}
function saveModule(form)
{
	event.preventDefault();
	$("#err_message").html('');
  var form_id = $(form).attr('id');
  if ($('#long_description').length > 0) {
    var description = CKEDITOR.instances.long_description.getData().replace(/(\r\n|\n|\r)/gm,"");
    document.getElementById('long_description').value = description;
  }
  $('button[name="save"]').prepend('<i class="fa fa-spinner fa-spin"></i>  ');
  $('button[name="save"]').attr('disabled', true);
  var formData = new FormData(document.getElementById(form_id));
	$.ajax({
		type: "POST",
		//url:$('.siteUrl').html()+'products/loadMoreProduct',
		url:$(form).attr('action'),
		dataType : "json",
		data : formData,
    cache:false,
    contentType: false,
    processData: false,
		success : function(result){
			//$('#profile_setting').html(result);
      console.log(result);
      $('button[name="save"]').attr('disabled', false);
      $('button[name="save"]').html('Save');
			if(result.return_code==1)
			{
        toastr.success(result.message);
        // setTimeout(function() {
        //   location.reload();
        // }, 2000);
			}
			else if(result.return_code==2)
			{

        $('.module_data').html(result.html);
        $(".tpi-add-attr").toggleClass("tpi-add-attr-b");
			}
			else if(result.return_code==3)
			{

        toastr.error(result.message);
			}
		},error: function (error) {
      console.log(error.responseText);
      toastr.error(error.responseText);
    //alert('error; ' + eval(error.responseText));
  }
	});
}
function savedoAddProductCombination(form)
{

	event.preventDefault();
  generate_auto_seo_tags();
	$("#err_message").html('');

  var form_id = $(form).attr('id');
  var formData = new FormData(document.getElementById(form_id));
  $('button[name="save"]').prepend('<i class="fa fa-spinner fa-spin"></i>  ');
  $('button[name="save"]').attr('disabled', true);
	$.ajax({
		type: "POST",
		//url:$('.siteUrl').html()+'products/loadMoreProduct',
		url:$(form).attr('action'),
		dataType : "json",
		data : formData,
    cache:false,
    contentType: false,
    processData: false,
		success : function(result){
			//$('#profile_setting').html(result);
      //console.log(result);
      $('button[name="save"]').attr('disabled', false);
      $('button[name="save"]').html('Save');

			if(result.return_code==1)
			{
        toastr.success(result.message);
        // setTimeout(function() {
        //   location.reload();
        // }, 2000);
			}
			else if(result.return_code==2)
			{
        $(".apc-conp").html( result.html );
        $(".apc-conp").toggleClass("apc-conp-b");

        //$(".tpi-add-attr").toggleClass("tpi-add-attr-b");
			}
			else if(result.return_code==3)
			{

        toastr.error(result.message);
			}
		},error: function (error) {
      console.log(error);

    alert('error; ' + eval(error));
  }
	});
}
</script>
<script type="text/javascript">
$(function () {
var table = $('#moduledatatable').DataTable({
 aLengthMenu: [
  [25, 50, 100, 200, -1],
  [25, 50, 100, 200, "All"]
],
iDisplayLength: 100
});




});
</script>
<script type="text/javascript">
function validateRecordsExport() // done
{


      $('#ptype_search_form').attr('action', '<? echo MAINSITE_Admin.$user_access->class_name."/export"; ?>');
  		$('#ptype_search_form').attr('target', '_blank');
  		$('#ptype_search_form').submit();

}
function check_uncheck_All_records() // done
{
    var mainCheckBoxObj = document.getElementById("main_check");
    var checkBoxObj = document.getElementsByName("sel_recds[]");

    for (var i = 0; i < checkBoxObj.length; i++) {
        if (mainCheckBoxObj.checked)
            checkBoxObj[i].checked = true;
        else
            checkBoxObj[i].checked = false;
    }
}
function validateRecordsActivate() // done
{
    if (validateCheckedRecordsArray()) {
        //alert("Please select any record to activate.");
        toastrDefaultErrorFunc("Please select any record to activate.");
        document.getElementById("sel_recds1").focus();
        return false;
    } else {
        document.ptype_list_form.task.value = 'active';
        document.ptype_list_form.submit();
    }
}
function validateCheckedRecordsArray() // done
{
    var checkBoxObj = document.getElementsByName("sel_recds[]");
    var count = true;

    for (var i = 0; i < checkBoxObj.length; i++) {
        if (checkBoxObj[i].checked) {
            count = false;
            break;
        }
    }

    return count;
}
function validateRecordsBlock() // done
{
    if (validateCheckedRecordsArray()) {
        //alert("Please select any record to block.");
        toastrDefaultErrorFunc("Please select any record to block.");
        document.getElementById("sel_recds1").focus();
        return false;
    } else {
        document.ptype_list_form.task.value = 'block';
        document.ptype_list_form.submit();
    }
}
function validateRecordsDelete() // done
{
  if (validateCheckedRecordsArray()) {
      alert("Please select any record to delete.");
      toastrDefaultErrorFunc("Please select any record to block.");
      document.getElementById("sel_recds1").focus();
      return false;
  } else {
      document.ptype_list_form.task.value = 'delete';
      document.ptype_list_form.submit();
  }
}
</script>
<script type="text/javascript">
function getState(country_id , id=0)
{
$('#loader1').show();
$("#state_id").html( '' );
if(country_id > 0)
{

  $.ajax({
    url: "<?=MAINSITE_Admin.'Ajax/getState'?>",
    type: 'post',
    dataType: "json",
    data: {	'country_id' : country_id , 'state_id' : id , "<?=$csrf['name']?>":"<?=$csrf['hash']?>" },
    success: function( response ) {
      $("#state_id").html( response.state_html );
    },
    error: function (request, error) {
      toastrDefaultErrorFunc("Unknown Error. Please Try Again");
      $("#quick_view_model").html( 'Unknown Error. Please Try Again' );
    }
  });
}

}



$(document).on("change", ".upload__inputfile", function () {
    var imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
    var imgArray = [];
    var maxLength = parseInt($(this).attr('data-max_length'));

    imgWrap.empty(); // Clear previous previews

    var files = this.files;
    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function (f, index) {
        if (!f.type.match('image.*')) {
            return;
        }

        if (imgArray.length >= maxLength) {
            return false;
        } else {
            imgArray.push(f);

            var reader = new FileReader();

            reader.onload = function (e) {
                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                imgWrap.append(html);
            }
            reader.readAsDataURL(f);
        }
    });
});

$('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    var imgArray = $(this).closest('.upload__box').find('.upload__inputfile')[0].files;

    for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
            imgArray = Array.prototype.slice.call(imgArray); // Convert FileList to array
            imgArray.splice(i, 1); // Remove the file from the array
            $(this).parent().parent().remove(); // Remove the preview
            break;
        }
    }
});

</script>
