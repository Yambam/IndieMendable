				<div class="container-lt float-right" style="clear: right; width: 250px; min-height: 0; margin-top: 655px;">
					<div class="container-title-lt"><?php echo gettext("YoYo Games: Search utility"); ?>
						<a class="arrow-link-lt" href="/search?yyg=yes" title="<?php echo gettext("YoYo Games: Search utility"); ?>"></a>
					</div>
					<form action="/search" method="GET">
						<input type="hidden" name="yyg" value="yes">
						<input type="submit" class="search-field-submit" value="Search YYG">
						<input type="text" class="search-field" name="q" value="">
					</form>
				</div>