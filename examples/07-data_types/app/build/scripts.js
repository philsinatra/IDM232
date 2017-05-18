var btn_options = document.getElementsByClassName('btn_option');

var reveal_answer = function(event) {
  event.preventDefault();
  var question = this.getAttribute('href').substr(1);
  var txt_count = this.querySelector('.q_num');
  var txt_answer = this.querySelector('.q_answer');

  txt_count.style.display = 'none';
  txt_answer.style.display = 'block';
};

for (var i = 0; i < btn_options.length; i++) {
  btn_options[i].addEventListener('click', reveal_answer, false);
}

document.addEventListener('keydown', function(event) {
  if (event.which === 39) {
    // Next screen
    if (has_next_screen)
      window.location = has_next_screen;
  } else if (event.which === 37) {
    // Previous screen
    if (has_previous_screen)
      window.location = has_previous_screen;
  }
});
