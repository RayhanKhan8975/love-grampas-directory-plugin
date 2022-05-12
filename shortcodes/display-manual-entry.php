<?php
/**
 * Displays the manual entry form.
 *
 * @return manual entry form html
 */
function display_manual_entry() {
	$form = '    <div class="input-group">
    <input minlength="3" type="text" name="manual-entry" id="manual-entry" class="form-control" placeholder="Add Product Material Entry">
    <div class="input-group-append">
    <button  id="manual-entry-button" style="width:150% ;" class="btn btn-primary" type="button">
     Add
    </button>
   
</div>

</div> 
</button>
';

	return $form;
}
