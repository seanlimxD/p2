<?php
    require'index-logic.php';
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h1> Formal Diagnosis Machine </h1>
	
    <form method='GET' action='index.php'>

	    <label for='age'>Please enter your age in years</label>
        <input type='text' name='age' value='<?= $form->get('age', '18') ?>'>

	    <br />

	    <label for='day'>What is your body made out of?</label>
	    <select name='body' id='day'>
	        <option value='choose'>Choose one...</option>
	        <option value='steel' <?php if ($body == 'steel') echo 'selected' ?>>Steel</option>
	        <option value='flesh' <?php if ($body == 'flesh') echo 'selected' ?>>Flesh</option>
	        <option value='noclue' <?php if ($body == 'noclue') echo 'selected' ?>>I don't know</option>
	    </select>

	     <!-- Trick to makes it so that if no checkboxes are selected, we still receive form data -->
	    <input type='hidden' name='submitted' value='1'>

	    <fieldset class='checkboxes'>
	        <legend>Select which of the following you possess</legend>
	        <ul class='checkboxes'>
	            <li>
	                <label><input type='checkbox'
	                              name='spirit[]'
	                              value='heart' <?php if (in_array('heart', $spiritResults)) echo 'checked' ?>> A pulse</label>
	            </li>
	            <li>
	                <label><input type='checkbox'
	                              name='spirit[]'
	                              value='soul' <?php if (in_array('soul', $spiritResults)) echo 'checked' ?>> Emotions</label>
	            </li>
	            <li>
	                <label><input type='checkbox'
	                              name='spirit[]'
	                              value='brain' <?php if (in_array('brain', $spiritResults)) echo 'checked' ?>> Complex thought</label>
	            </li>
	        </ul>
	    </fieldset>

	    <input type='submit' value='Submit' class='btn btn-primary btn-sm'>

	    <?php if ($form) : ?>
	        <?php if ($bodyUnselected): ?>
	            <div class='alert alert-warning' role='alert'>
	                Choose a body type please
	            </div>
	        <?php endif; ?>

	    	<?php if (is_null($spirit)  && ($submitted)): ?>
	        	<div class='alert alert-warning'>
	        		It would be really nice if you chose which human qualities you possessed
	        	</div>
	    	<?php endif; ?>
		<?php endif; ?>

		<?php if (isset($errors) && $errors) : ?>
		    <div class='alert alert-danger'>
		        <?php foreach ($errors as $error) : ?>
		            <?= $error ?>
	            <?php endforeach; ?>
		    </div>
		<?php endif; ?>

		<?php if (!($errors) && !($bodyUnselected) && !(is_null($spirit))) : ?>
			<p>
				You are <?= checkEntity($age, $body, $spiritResults) ?>.
			</p>
		<?php endif; ?>
	</form>
</body>
</html>