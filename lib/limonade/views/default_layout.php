<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>FSL Micro Framework for PHP</title>
	<link rel="stylesheet" href="<?php echo url_for('/_lim_css/screen.css');?>" type="text/css" media="screen">
</head>
<body>
	  <center>
  <div id="header">
   <img src="<?php echo url_for('/_lim_public/img/fsl_logo.png') ?>" width=200px>
  </div>

  <div id="content">
    <?php echo error_notices_render(); ?>
    <div id="main">
      <?php echo $content;?>
      <hr class="space">
    </div>
  </div>
</center>
</body>
</html>
