<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo _project_complete_name_ ?></title>
    <?
    $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
    );
    ?>
    <meta name="<?=$csrf['name'];?>" content="<?=$csrf['hash'];?>">
    <script>

    	$.ajaxSetup({
    		headers: {
    		    '<?=$csrf['name']?>': '<?=$csrf['hash']?>'
    		}
    	});
    </script>
    <?
    if(!empty($page_type))
    {
    	if($page_type=="list")
    	{
    		$this->load->view('admin/inc/files/header-list', $this->data);
    	}
    }
    else
    {
    	$this->load->view('admin/inc/files/header', $this->data);
    }
    ?>


</head>

<body>
    <section class="dashboard">
        <div class="ds-main">
