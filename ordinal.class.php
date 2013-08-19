<?php

/* ------------------------------------------------------------------------------- */
/* Takes a number in the range 1-9999 and converts it to a human readable sentence */
/* of it's ordinal form eg. 'Three thousand five hundred sixty first'              */
/* ------------------------------------------------------------------------------- */

/* NOTES! This code is not functional. */

class Ordinal{

	protected $numWords = array( "one", "two", "three", "four", "five", "six", "seven", "eight", "nine" );
	protected $separator = ' '; // Space by default

	public function convert( $num ){
		$strReturn = '';
		$strNum = ToString( $num );
		$ordinalWords = [	"first", 	"second", 		"third", 		"fourth", 		"fifth", 		"sixth", 		"seventh", 		"eighth", 	"ninth", "tenth", "eleventh", 
								"twelfth", 	"thirteenth", 	"fourteenth", 	"fifteenth", 	"sixteenth", 	"seventeenth", 	"eighteenth", 	"nineteenth" ];

		$decOrds = [ "tenth", "twentieth", "thirtieth", "fortieth", "fiftieth", "sixtieth", "seventieth", "eightieth", "ninetieth" ];
		$decWords = [ "" , "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety" ];

		if( num > 999 ){
			strReturn .= steppedOrd( num, 1000, "thousandth", "thousand" );
		}

		if( num > 99 ){
			strReturn .= steppedOrd( num, 100, "hundredth", "hundred" );
		}

		if( Right(strNum,2) != "00" ){

			if( Right(strNum,2) % 10 == 0){
				strReturn .= decOrds[ Right(strNum,2) / 10 ];
			} else if( Right(num,2) < 20 ){
				strReturn .= ordinalWords[ Right(strNum,2) ];
			} else {
				strReturn .= decWords[ ( Right(num,2) - ( Right(num,2) % 10 ) ) / 10 ];
				strReturn .= ' ' & ordinalWords[ Right(num,1) ];
			} 
		}

		return strReturn;
	}

	/*
	This handles the part of the sentence such as "two hundred...", or "five thousandth"
	@num 			num  	The number we are converting
	@stepSize 		num 	The size of the group we are counting eg. 100 for hundreds
	@ordinalForm 	string 	The block in it's ordinal form eg. "thousandth"
	@wordForm		strign	The block in it's word form eg. "hundred"
	*/
	private function steppedOrd( $num, $stepSize, $ordinalForm, $wordForm ){
		$strNum = ToString( $num );
		$strStep = ToString( $stepSize );
		$strReturn = '';
		$lenStrStep = Len( $strStep );
		if( Left( Right( $strNum, $lenStrStep ), 1) != 0){
			if( Right( $strNum, $lenStrStep ) % $stepSize == 0 ){
				$strReturn .= VARIABLES.numWords[ Right( $strNum, $lenStrStep) / $stepSize ] & ' ' & $ordinalForm;
			} else {
				$strReturn .= VARIABLES.numWords[ ( Right( $num, $lenStrStep) - ( Right( $num, $lenStrStep) % $stepSize ) ) / $stepSize ];
				$strReturn .= ' ' & $wordForm & ' ';
			}
			return $strReturn;
		}
	}

}