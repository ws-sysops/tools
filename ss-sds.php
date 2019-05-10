<?php
/**
 * Script Name: SailFish Systems Simple Diagnostic Script
 * Script URI:  https://github.com/ws-sysops/tools/blob/master/ss-sds.php
 * Description: Simple Diagnostic Script used by SailFish Systems Tech Support
 * Author:      James Morris, CTO SailFish Systems, LLC - admin[at]sailfishsystems.com
 * Version:     1.1.0
 * Author URI:  https://sailfishsystems.com/
 *
 */
/*Optional environment parameters for custom vars*/
// Tweak performance
@ini_set( 'max_execution_time', 180 );
@ini_set( 'memory_limit', '512M' );
@ini_set( 'post_max_size', '16M' );
@ini_set( 'upload_max_filesize', '16M' ); 
// Display errors
@ini_set( 'display_errors', true );
/* End optional environment parameters for custom vars
/* Optional var definitions */
if ( !function_exists( 'shell_exec' ) ):
    $function_alert = 1;
else:
    $function_alert = 0;
    $ls = shell_exec( 'ls -alh ./' );
    $test_write = shell_exec('mkdir ../sstmp && echo "The file system is writable." > ../sstmp/sstestfile.txt');
    $lstw = shell_exec( 'ls -alh ../sstmp/' );
    $top = shell_exec("top -n 1 -b");
    /*
    $du = shell_exec('du -hs ./*');
    $dbdump = shell_exec('mysqldump -h [host] -u [user] --password=[PASS] [db] > ../sstmp/$(date +"%m_%d_%Y")-[db].sql');
    $backup = shell_exec('tar -czvf ../sstmp/$(date +"%m_%d_%Y")-[dir].tar.gz ./');
    */ 
endif;
$sstmpdir = "../sstmp";
$custom_var = 'Hello World!';
/* End Optional var definitions */
?>
<!DOCTYPE html>
<head>
<meta name="robots" content="noindex, nofollow" />
<title>SailFish Systems Simple Diagnostic Script</title>
<style type="text/css" media="screen">
      body {
      padding:100px 0px;
      margin:0px;
      text-align:left;
      font-size:16px;
      font-family:"Lucida Console", Monaco, monospace;
      }
      .content {
      padding:1em;
      }
      code {
      display: block;
      height:250px;
      max-width: 933px;
      margin: 0 auto;
      padding:0 1em;
      overflow:scroll;
      background:#efefef;
      border:1px solid silver;
      font-size: 12px;
      }
      h1,h2 {
      border-bottom: 1px dotted black;
      text-align:center;
      }
      #notice {
      padding: 1em 0;
      margin:1em auto;
      background: black;
      color: white;
      }
      .ntitle {
      padding: 1em;
      margin: 0;
      background: red;
      }
      #header, #footer{
      width:100%;
      background:#efefef;
      padding:1em;
      margin: 0px;
      text-align:center;
      }
      #header{
      position: fixed;
      top: 0;
      }
      #footer {
      position: fixed;
      bottom: 0;
      border-top:1px dotted #ccc;
      }
</style>
</head>
<body>
	<h1 id="header">SailFish Systems Simple Diagnostic Script</h1>
	<?php if ( $function_alert === 0 ): ?>
	<div class="content">
		<code>
			<pre>
				<h2>Current Process List</h2>
				<?php echo $top; ?>
			</pre>
		</code>
	</div>
	<div class="content">
		<code>
			<pre>
				<h2>Directory Listing</h2>
				<?php echo $ls; ?>
			</pre>
		</code>
	</div>
    <?php if(is_writable($sstmpdir)) : ?>
    <div class="content">
		<code>
			<pre>
				<h2>Write test</h2>
				Listing for <?php echo $sstmpdir; ?><br />
				<?php echo $lstw; ?>
			</pre>
		</code>
	</div>
	<?php else : ?>
    <div class="content">
		<code>
			<pre>
				<h2>Write test</h2>
				Parent directory is NOT writable!
			</pre>
		</code>
	</div>
    <?php endif; ?>
    <!-- Custom var output block. Must be above phpinfo() function.
	<div class="content">
		<code>
			<pre>
				<h2>Custom Var Title</h2>
				<?php echo $custom_var; ?>
			</pre>
		</code>
	</div>
	End Custom var output block -->
	<?php else: ?>
	<!-- Output notice of disabled shell_exec() function -->
	<p id="notice">
		<span class="ntitle">NOTICE:</span> The called PHP function is not enabled on this server. Custom vars must use cURL or other alternative native functions.
	</p>
	<?php endif; ?>
	<!-- Output PHP Information -->
	<?php phpinfo(); ?>
	<div id="footer"><p>Courtesy of 
		<a href="https://sailfishsystems.com/" title="SailFish Systems">SailFish Systems</a> | Copyright &copy; 
		<?php echo date('Y'); ?> | Some rights reserved</p>
	</div>
</body>
</html>
