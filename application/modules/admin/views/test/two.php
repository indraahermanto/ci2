<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Buatlah program buble sort tanpa menggunakan temporary variable.</h3>
			</div>
			<div class="box-body">
				<form method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="input">Input</label>
						<input type="text" name="input" value="<?=$input?>" id="input" class="form-control">
					</div>
					<?php if(isset($output)) { ?>
					<div class="form-group">
						<label for="ouput">Output</label>
						<input type="text" disabled value="<?=$output?>" id="ouput" class="form-control">
					</div>
					<?php } ?>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>			
			</div>
		</div>
	</div>
</div>