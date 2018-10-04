<?php
require 'includes/helpers.php';
require 'includes/Form.php';

use DWA\Form;

$form = new Form($_GET);

$submitted = $form->isSubmitted();

$age = $form->get('age', null);

$body = $form->get('body', null);

$bodyUnselected = ($body == 'choose');

$spirit = $form->get('spirit', null);

$spiritResults = [];

if ($submitted) {
	if ($spirit) {
		foreach ($spirit as $spirit) {
        	$spiritResults[] = $spirit;
    	}
	}

	$errors = $form->validate(
        [
            'age' => 'required|min:1',
        ]
    );
}

function checkEntity ($age, $body, $spiritResults) {
	$result = null;
	if ($body == 'steel') {
		if (in_array('brain', $spiritResults)) {
			if (in_array('heart', $spiritResults)) {
				if (in_array('soul', $spiritResults)) {
					return 'a cyborg';
				} else {
					return 'an incredible sentient robot';
				}
			} else {
				return 'siri';
			}
		} else {
			return 'a soulless machine';
		}
	} elseif ($body == 'flesh') {
		if ($age > 120 || !(in_array('heart', $spiritResults))) {
			return 'dead';
		} else {
			if (in_array('brain', $spiritResults)) {
				if (in_array('soul', $spiritResults)) {
					return 'a normal human person';
				} else {
					return 'a pretty mean dude';
				}
			} else {
				return 'a mindless beast';
			}
		}
	} else {
		return 'mysterious';
	}
}