//Game object

var Game = {
	//on going count of score, INT
	score : 0,
	//round number, INT, Max = 10 (11 somethings)
	round : 1,
	//bowl_num number in round, INT, Max = 2
	bowl_num: 1,
	//if spare was bowl_numed before, BOL
	spare : false,
	//if stike was bowl_numed before, BOL
	strike : false,
	//array of every ball bowl_numed
	sequence : [],
	//object of every ball bowl_numed per round
	sequence_round : {},
	//object is ok to add to
	object_ready : true,

	
	//function for when a ball is bowl_numed, pass in the number of pins that fell (1 - 10);
	bowl : function (score) {

		//check to see if object is ready
		if (this.object_ready)
		{
			this.object_ready = false;
		}
		else
		{
			this.bowl(score);
			return false;
		}

		//check to make sure not played too many rounds
		if (this.round > 11)
		{
			var lastBowl = this.lastBowl(true);
			//allow to play on if strike bowled on last bowl
			if (this.lastBowl(true) !== 10)
			{
				alert(this.alertMessage());
			}
			else
			{
				alert(this.alertMessage());
			}
		}

		//error handling, make sure a number is passed in and is between 0 and 10
		if (!$.isNumeric(score))
		{
			return false;
		}
		else
		{

			if (score > 10 && score < 0)
			{
				return false;
			}
		}

		//add score to total score
		this.score += parseInt(score);

		//add score to array of scores
		this.sequence.push(parseInt(score));

		//add score to object by round
		//if first bowl_num, create empty array
		if (this.bowl_num === 1)
			this.sequence_round[parseInt(this.round)] = [];

		this.sequence_round[this.round].push(parseInt(score));

		//a stike was bowl_numed in previous round so add score again
		if (this.strike)
			this.score += score

		//a strike was bowled in the hand before last so add score again
		var length = this.sequence.length - 1;
		if (length > 1)
		{
			prevbowl_num = this.sequence[length-1];
			prevbowl_num2 = this.sequence[length-2];
			if (prevbowl_num === 10 && prevbowl_num2 == 10)
			{
				this.score += score;
			}

		}


		//a spare was bowl_numed in the previous round
		if (this.spare)
		{
			//only add for first bowl_num, then reset spare
			if (this.bowl_num == 1)
			{
				this.score += score;
				this.spare = false;
			}
		}

		//bowled a strike, so move to next round, reset bowl_num, and show strike was bowled
		if (score === 10)
		{
			this.round += 1;
			this.bowl_num = 1;
			this.strike = true;
		}
		//no strike
		else
		{
			//first bowl
			if (this.bowl_num === 1)
			{
				this.bowl_num = 2;
			}
			//second bowl
			else
			{
				//check to see if a spare was bowled on the 2nd bowl

				//check if previous bowl and current bowl add to 10, if so, show spare was bowled
				if (this.lastBowl(false) + score === 10)
				{
					this.spare = true;
				}

				//beck to first bowl_num of next round
				this.bowl_num = 1;
				this.round += 1;
				this.strike = false;
			}
		}

		this.object_ready = true;
	},

	//function that returns the last score bowled
	lastBowl : function(bol) {
		
		//get number of balls bowled
		length = this.sequence.length - 1;
		if (length > 0)
			return this.sequence[(bol ? length : length - 1) ];
		else
			return false;
	},


	//get current score
	getScore : function () {
		return this.score;
	},

	//get sequence of bowl_nums
	getSequence : function() {
		return this.sequence;
	},

	//get sequence of bowl_nums by round
	getSequenceRound : function() {
		return this.sequence_round;
	},

	//reset game
	resetGame : function() {
		this.score = 0;
		this.round = 1;
		this.bowl_num = 1;
		this.spare = false;
		this.strike = false;
		this.sequence = [];
		this.sequence_round = {}
	},


	//alert message when game over
	alertMessage : function() {
		return 'Game Over! Your score was ' + this.getScore() + (this.getScore() === 300 ? ' THE PERFECT GAME!' : ( this.getScore() === 0 ? ' GUTTER GAME' : '') );
	}
}