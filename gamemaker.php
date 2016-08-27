<?php
	include('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ClonkleClinches</title>
		<link rel="stylesheet" href="/css/default.css" />
	</head>
	<body ontouchstart="" lang="<?php echo $language_abbr; ?>">
		<input type="file" id="fileinput" multiple="" />
		<script type="text/javascript">
		  function readMultipleFiles(evt) {
			//Retrieve all the files from the FileList object
			var files = evt.target.files; 
					
			if (files) {
				for (var i=0, f; f=files[i]; i++) {
					  var r = new FileReader();
					r.onload = (function(f) {
						return function(e) {
							var contents = e.target.result;
							alert( "Got the file.\n" 
								  +"name: " + f.name + "\n"
								  +"type: " + f.type + "\n"
								  +"size: " + f.size + " bytes\n"
								  + "starts with: " + contents.substr(0, contents.indexOf("\n"))
							); 
						};
					})(f);

					r.readAsText(f);
				}   
			} else {
				  alert("Failed to load files"); 
			}
		  }
		  
		  document.getElementById('fileinput').addEventListener('change', readMultipleFiles, false);
		</script>
	</body>
</html>