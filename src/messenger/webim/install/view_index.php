<?php
/*
 * This file is part of Web Instant Messenger project.
 *
 * Copyright (c) 2005-2008 Internet Services Ltd.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Evgeny Gryaznov - initial API and implementation
 */
?>
<html>
<head>



<link rel="stylesheet" type="text/css" media="all" href="<?php echo $webimroot ?>/styles.css" />


<link rel="shortcut icon" href="<?php echo $webimroot ?>/images/favicon.ico" type="image/x-icon"/>
<title>
	<?php echo getlocal("app.title") ?>	- <?php echo getlocal("install.title") ?>
</title>

<meta http-equiv="keywords" content="<?php echo getlocal("page.main_layout.meta_keyword") ?>">
<meta http-equiv="description" content="<?php echo getlocal("page.main_layout.meta_description") ?>">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#2971C1" vlink="#2971C1" alink="#2971C1">

<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
<td valign="top" class="text">

		<h1><?php echo getlocal("install.title") ?></h1>


	<?php echo getlocal("install.message") ?>
<br />
<br />
<?php if( isset($errors) && count($errors) > 0 ) { ?>
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
	    <td valign="top"><img src='<?php echo $webimroot ?>/images/icon_err.gif' width="40" height="40" border="0" alt="" /></td>
	    <td width="10"></td>
	    <td class="text">
		    <?php	if( isset($errors) && count($errors) > 0 ) {
		print getlocal("errors.header");
		foreach( $errors as $e ) {
			print getlocal("errors.prefix");
			print $e;
			print getlocal("errors.suffix");
		}
		print getlocal("errors.footer");
	} ?>

		</td>
		</tr>
		</table>
	<?php } ?>

<?php if( $page['done'] ) { ?>
<table cellspacing='0' cellpadding='0' border='0'><tr><td background='<?php echo $webimroot ?>/images/loginbg.gif'><table cellspacing='0' cellpadding='0' border='0'><tr><td><img src='<?php echo $webimroot ?>/images/logincrnlt.gif' width='16' height='16' border='0' alt=''></td><td></td><td><img src='<?php echo $webimroot ?>/images/logincrnrt.gif' width='16' height='16' border='0' alt=''></td></tr><tr><td></td><td align='center'><table border='0' cellspacing='0' cellpadding='0'><tr><td align="left" class="text">
<?php echo getlocal("install.done") ?>
<ul>
<?php foreach( $page['done'] as $info ) { ?>
<li><?php echo $info ?></li>
<?php } ?>
</ul>
</td></tr>
<?php if( $page['nextstep'] ) { ?>
<tr><td align="left" class="text">
<?php echo getlocal("install.next") ?>
<ul>
<li>
<?php if( $page['nextnotice'] ) { ?><?php echo $page['nextnotice'] ?><br/><br/><?php } ?>
<a href="<?php echo $page['nextstepurl'] ?>"><?php echo $page['nextstep'] ?></a>
</li>
</ul>
</td></tr>
<?php } ?>
</table></td><td></td></tr><tr><td><img src='<?php echo $webimroot ?>/images/logincrnlb.gif' width='16' height='16' border='0' alt=''></td><td></td><td><img src='<?php echo $webimroot ?>/images/logincrnrb.gif' width='16' height='16' border='0' alt=''></td></tr></table></td></tr></table>
<?php } ?>

<table width="200" cellspacing="0" cellpadding="0" border="0">
<tr>
  <td height="20"></td>
</tr>
<tr>
  <td bgcolor="#D6D6D6"><img src='<?php echo $webimroot ?>/images/free.gif' height="1" width="1" border="0" alt=""></td>
</tr>
<tr>
  <td height="7"></td>
</tr>
</table>

Web Messenger/<?php echo $page['version'] ?> &bull; <?php echo $page['localeLinks'] ?> &bull; <a href="<?php echo $webimroot ?>/epl-v10.html" target="_blank"><?php echo getlocal("install.license") ?></a>

</td>
</tr>
</table>

</body>
</html>

