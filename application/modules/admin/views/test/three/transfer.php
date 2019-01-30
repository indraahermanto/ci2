<?php echo $form->messages(); ?>
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Buatkan program bank sederhana menggunakan Codeigniter.</h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>
					<?php echo $form->bs3_text('Source Bank Name', 'inputBankSr'); ?>
					<?php echo $form->bs3_text('Source Account Number', 'inputAccNoSr'); ?>
					<?php echo $form->bs3_text('Destination Bank Name', 'inputBankDs'); ?>
					<?php echo $form->bs3_text('Destination Account Number', 'inputAccNoDs'); ?>
					<?php echo $form->bs3_text('Description', 'inputDesc'); ?>
					<?php echo $form->bs3_text('Amount', 'inputAmount'); ?>
					<?php echo $form->bs3_submit(); ?>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
</div>