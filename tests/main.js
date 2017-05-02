function getURLParameter(name) {
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.href);
  if (results === null)
    return '';
  else
    return results[1];
}

(function() {
  var task_number = getURLParameter('q');
  var task_section = document.getElementById('q' + task_number);
  task_section.hidden = false;
})();
