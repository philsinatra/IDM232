const form = document.getElementById('myForm');
const btnSubmit = document.getElementById('btnSubmit');
let httpRequest;

const validateForm = () => {
	const inputFields = form.querySelectorAll('input[type="text"]');
	let errors = [];
	console.log(inputFields);

	for (const input of inputFields) {
		if (input.value === '') {
			errors.push(input.name);
		}
	}

	return errors;
};

const alertContents = () => {
	try {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
			if (httpRequest.status === 200) {
				// console.log(httpRequest.responseText);

				const response = JSON.parse(httpRequest.responseText);
				console.log(response);
				console.log(response.computedString);
			} else {
				console.log('There was a problem with the request.');
			}
		}
	} catch (event) {
		console.log(`Caught Exception: ${event.description}`);
	}
};

const processForm = (event) => {
	console.log('Form submitted');

	// Validate form
	const validation = validateForm();
	console.log(validation);

	if (validation.length !== 0) {
		console.log('Validation Errors');
		return false;
	}

	console.group('Event Info');
	console.log(event);
	console.log(event.target.parentNode.attributes.action);
	console.log(event.target.parentNode.attributes.action.value);
	console.groupEnd();

	const action = event.target.parentNode.attributes.action.value;
	const data = new FormData(form);
	httpRequest = new XMLHttpRequest();

	if (!httpRequest) {
		window.alert('Cannot create an XMLHTTP instance');
		return false;
	}

	httpRequest.onreadystatechange = alertContents;
	httpRequest.open('POST', action, true);
	httpRequest.send(data);

	event.preventDefault();
};

btnSubmit.addEventListener('click', processForm);