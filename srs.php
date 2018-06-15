<!-- Super Range Slider!
Graeme Woods
Jun 2018 -->


<style>
  /*------------- Slider Text -------------*/
  .srs-container {
    margin: 0 auto;
    width: 400px;
    text-align: center;
  }

  .srs-title {
    font-size: 18px;
  }

  .srs-savings {
    font-size: 35px;
  }

  .srs-min {
    float: left;
  }

  .srs-max {
    float: right;
  }


  .srs-house-value {
    top: -30px;
    position: relative;
  }

  /*------------- Range Slider -------------*/
  .srs-range-slider {
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 100%;
    height: 2px;
    height: <?php echo $atts['slider-height']; ?>px;
    background: <?php echo $atts['slider-color']; ?>;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    -moz-transition: .2s;
    -o-transition: .2s;
    transition: opacity .2s;
    filter: drop-shadow(0 0 1px #000);
    position: relative;
    top: -20px;
  }

  @-moz-document url-prefix() {
    .srs-range-slider {
      left: -8px;
      top: -19px;
    }
  }

  .srs-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 40px;
    height: 40px;
    border-radius: 35px;
    cursor: pointer;
    border: 7px solid <?php echo $atts['knob-border-color']; ?>;
    background: <?php echo $atts['knob-color']; ?>;
  }

  .srs-range-slider::-moz-range-thumb {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 28px;
    height: 28px;
    border-radius: 35px;
    cursor: pointer;
    border: 7px solid <?php echo $atts['knob-border-color']; ?>;
    background: <?php echo $atts['knob-color']; ?>;
  }

  .srs-range-slider::-moz-range-track {
    background: #d3d3d3
  }

  /*

  bar height = 2px
    .srs-arrow... { top: -20px } moves half as fast as ^
  */



  /*------------- Arrows -------------*/
  .srs-arrow-left {
    margin-right: 28px;
    animation: pulse-left 2s infinite ease-in-out;
    -webkit-animation: pulse-left 2s infinite ease-in-out;
    -moz-animation: pulse-left 2s infinite ease-in-out
  }

  .srs-arrow-right {
    margin-left: 34px;
    animation: pulse-right 2s infinite ease-in-out;
    -webkit-animation: pulse-right 2s infinite ease-in-out;
    -moz-animation: pulse-right 2s infinite ease-in-out;
  }

  .srs-arrow-left, .srs-arrow-right {
    border: solid <?php echo $atts['arrow-color']; ?>;
    border-width: 0 2px 2px 0;
    display: inline-block;
    height: 16px;
    width: 16px;
    filter: drop-shadow(0 0 2px #000);
    position: relative;
    top: -20px;
    top: calc(-20px - <?php echo $atts['slider-height']; ?>px/2);
  }

  .srs-arrow-container {
    position: relative;
    top: -18px;
    pointer-events: none;
    text-align: center;
  }

  @keyframes pulse-left {
    from {
        transform : scale(1);
        opacity : 1;
        transform: rotate(135deg);
    }

    50% {
        transform : scale(0.75);
        opacity : 0.25;
        transform: rotate(135deg);
    }

    to {
        transform : scale(1);
        opacity : 1;
        transform: rotate(135deg);
    }
  }

  @keyframes pulse-right {
    from {
        transform : scale(1);
        opacity : 1;
        transform: rotate(-45deg);
    }

    50% {
        transform : scale(0.75);
        opacity : 0.25;
        transform: rotate(-45deg);
    }

    to {
        transform : scale(1);
        opacity : 1;
        transform: rotate(-45deg);
    }
  }


  .hide {
    border-color: transparent !important;
  }

</style>

<div class="srs-container">
	<p class="srs-title"></p>
	<p class="srs-savings"></p>
	<span class="srs-min"></span>
	<span class="srs-max"></span>
  <input type="range" min="1" max="1000" value="500" step="1"
 				 class="srs-range-slider" oninput="update()" onfocus="hide()" >
 	<div class="srs-arrow-container">
	  <div class="srs-arrow-left"></div>
		<div class="srs-arrow-right"></div>
	</div>
	<p class="srs-house-value"></p>
</div>



<script>

  /*
   * Rounds to nearest interval
   */
	round = function(n) {
		if (n - Math.floor(n/intervals) *intervals < Math.ceil(n/intervals) *intervals - n ) {
			return Math.floor(n/intervals) *intervals
		} else {
			return Math.ceil(n/intervals) *intervals
		}
	}


	/*
	 * Calculates house price based on range slider
	 */
	calc = function(input) {
		let index = 0;
		//while input is larger than the next range value increment
		//This returns the index of the range value that is immediately less than input
		while (range[index+1] < input) {
			index++;
		}
		//immediately lower range value
		let floor = range[index];
		//immediately higher range value
		let ceil = range[index+ 1];
		//corresponding base price value
		//final price will between this value and the next price value
		let base = price[index];
		//gap between current price value (base) and next price value
		let gap = price[index+1] - price[index];
		//						|	 fraction of range gap |  *  | gap | + | base price	|
		return round( (input-floor)/(ceil-floor)  *    gap   +      base     );
		//use    ^^ round function to round to nearest 25,000
	}


  /*
   * Update house value and savings
   */
	update = function() {
		houseValueVar = calc(document.getElementsByClassName("srs-range-slider")[0].value);
    houseValue.innerHTML = "$".concat((houseValueVar).toLocaleString());
  	savings.innerHTML = "$".concat(Math.round(houseValueVar * saveDecimal).toLocaleString());
	}


  /*
   * Hide arrows on focus
   */
	hide = function() {
		let arrowLeft = document.getElementsByClassName("srs-arrow-left");
    let arrowRight = document.getElementsByClassName("srs-arrow-right");
		arrowLeft[0].className += arrowLeft[0].className ? ' hide' : 'hide';
    arrowRight[0].className += arrowRight[0].className ? ' hide' : 'hide';
	}


  /*
   * Read PHP args and set defaults
   */
  var title = '<?php echo $atts['title']; ?>'
  if (title === '') title = "You Could Save"

  try { eval("var hideArrows = <?php echo $atts['hide-arrows']; ?>") }
  catch (e) { var hideArrows = false; }

  try { eval("var minPrice = <?php echo $atts['min-price']; ?>;") }
  catch (e) { var minPrice = 200000; }

  try { eval("var midPrice = <?php echo $atts['mid-price']; ?>;") }
  catch (e) { var midPrice = 800000; }

  try { eval("var maxPrice = <?php echo $atts['max-price']; ?>;") }
  catch (e) { var maxPrice = 2000000; }

  try { eval("var intervals = <?php echo $atts['intervals']; ?>;") }
  catch (e) { var intervals = 25000; }

  try { eval("var saveDecimal = <?php echo $atts['save-decimal']; ?>;") }
  catch (e) { var saveDecimal = 0.01695; }

  var className = '<?php echo $atts['class-name']; ?>';


  /*
   * Set Labels
   */
  document.getElementsByClassName("srs-min")[0].innerHTML = "$".concat(minPrice.toLocaleString());
  document.getElementsByClassName("srs-max")[0].innerHTML = "$".concat(maxPrice.toLocaleString());
  document.getElementsByClassName("srs-title")[0].innerHTML = title;
  let container = document.getElementsByClassName("srs-container")[0];
  container.className += container.className ? ` ${className}` : `${className}`;

  /*
   * Arrow Hide logic and slider points
   */
  if (hideArrows) {
    hide();
    console.log("hidden");
  }
	//These are the slider values at a corresponding percentage of the range
  var price = [minPrice, midPrice, maxPrice];
	var range = [    0,      500,      1000  ];



  /*
   * Set initial house value and savings
   */
	var slider = document.getElementsByClassName("srs-range-slider")[0];
	var savings = document.getElementsByClassName("srs-savings")[0];
	var houseValue = document.getElementsByClassName("srs-house-value")[0];
	var houseValueVar = calc(slider.value);
	houseValue.innerHTML = "$".concat((houseValueVar).toLocaleString());
	savings.innerHTML = "$".concat(Math.round(houseValueVar * saveDecimal).toLocaleString());

</script>
