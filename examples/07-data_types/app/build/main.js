const btnOptions = document.getElementsByClassName('btn_option');

const revealAnswer = function(event) {
	event.preventDefault();
	const txtCount = this.querySelector('.q_num');
	const txtAnswer = this.querySelector('.q_answer');

	txtCount.style.display = 'none';
	txtAnswer.style.display = 'block';
};

for (const optionButton of btnOptions) {
	optionButton.addEventListener('click', revealAnswer, false);
}

document.addEventListener('keydown', function(event) {
	if (event.which === 39) {
		// Next screen
		if (hasNextScreen)
			window.location = hasNextScreen;
	} else if (event.which === 37) {
		// Previous screen
		if (hasPreviousScreen)
			window.location = hasPreviousScreen;
	}
});