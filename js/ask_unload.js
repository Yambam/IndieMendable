window.onbeforeunload = function(evt) {
	var message = 'Did you remember to send your message?';
	if (typeof evt == 'undefined') {
		evt = window.event;
	}
	if (evt) {
		evt.returnValue = message;
	}

	return message;
}