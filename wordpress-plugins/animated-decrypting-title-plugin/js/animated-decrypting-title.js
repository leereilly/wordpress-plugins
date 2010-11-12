/**-._    _.--'"`'--._    _.--'"`'--._    _.--'"`'--._    _   leereilly.net
       '-:`.'|`|"':-.  '-:`.'|`|"':-.  '-:`.'|`|"':-.  '.` : '.   
     '.  '.  | |  | |'.  '.  | |  | |'.  '.  | |  | |'.  '.:   '.  '.
     : '.  '.| |  | |  '.  '.| |  | |  '.  '.| |  | |  '.  '.  : '.  `.
     '   '.  `.:_ | :_.' '.  `.:_ | :_.' '.  `.:_ | :_.' '.  `.'   `.
            `-..,..-'       `-..,..-'       `-..,..-'       `         `**/

var TITLE = '';
var SEQUENCE_DATA = "ACTG";
var BINARY_DATA = "10";
var CHARACTERS = SEQUENCE_DATA;
var done = 1;
var REPEATS = 5;
var DELAY = 50;

function dna_decrypt_title() {
	decrypt_title(SEQUENCE_DATA, REPEATS, DELAY);	
}

function binary_decrypt_title() {
	decrypt_title(BINARY_DATA, REPEATS, DELAY);
}

function decrypt_title(characters, repeats, delay) {
	if (document.all||document.getElementById) {
		TITLE = document.title;
		CHARACTERS = characters.toString();
		REPEATS = repeats;
		DELAY = delay;
		document.title = '';
		decrypt();
	}
}

function decrypt() {
	if (done) {
		done = 0;
		decrypt_helper(TITLE, REPEATS, 0);
	}
}

function decrypt_helper(text, runs_left, charvar) {
	if (!done ) {
		runs_left = runs_left - 1;

		var status = text.substring(0,charvar);

		for(var current_char = charvar; current_char < text.length; current_char++) {
			status += CHARACTERS.charAt(Math.round(Math.random()*CHARACTERS.length));
		}

		document.title = status;

		var rerun = "decrypt_helper('" + text + "'," + runs_left + "," + charvar + "," + REPEATS + ");"
		var new_char = charvar + 1;
		var next_char = "decrypt_helper('" + text + "'," + REPEATS + "," + new_char + "," + REPEATS + ");"

		if(runs_left > 0) {
			setTimeout(rerun, DELAY);
		}

		else {
			if (charvar < text.length){
				setTimeout(next_char, Math.round(DELAY*(charvar+3)/(charvar+1)));
			}
		
			else {
				done = 1;
			}
		}
	}
}



