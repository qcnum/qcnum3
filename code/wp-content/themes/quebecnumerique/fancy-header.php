<div class="abstract">
	<svg class="abstract-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMinYMin meet" viewBox="0 0 1000 300" xml:space="preserve">

		<filter id="dropshadow" height="130%">
		  <feGaussianBlur in="SourceAlpha" stdDeviation="12"/> <!-- stdDeviation is how much to blur -->
		  <feOffset dx="2" dy="2" result="offsetblur"/> <!-- how much to offset -->
		  <feMerge> 
		    <feMergeNode/> <!-- this contains the offset blurred image -->
		    <feMergeNode in="SourceGraphic"/> <!-- this contains the element that the filter is applied to -->
		  </feMerge>
		</filter>

		<?php $opacity = '1' ?>

		<g id="test" class="organisations " opacity="<?php echo $opacity ?>">
			<polygon style="filter:url(#dropshadow)" class="triangle" fill="#9B2B78" points="1091.5,203.877 584.414,-6.327 987.046,-100.097 	"/>
		</g>
		<g id="Layer_2" class="articles" opacity="<?php echo $opacity ?>">
			<polygon  style="filter:url(#dropshadow)" class="triangle" fill="#A0AD00" points="220.5,131.928 56.242,-44.939 469.592,-38.114 	"/>
		</g>
		<g id="Layer_3" class="projets" opacity="<?php echo $opacity ?>">
			<polygon style="filter:url(#dropshadow)" class="triangle" fill="#009861" points="492.5,141.324 119.07,-27.821 556.507,-30.78 	"/>
		</g>
		<g id="Layer_4" class="nouvelles" opacity="<?php echo $opacity ?>" >
			<polygon style="filter:url(#dropshadow)" class="triangle" fill="#00ACA7" points="-29.5,191.877 -22.5,-20.676 279.219,-21.995 	"/>
		</g>
		<g id="Layer_5" class="evenements" opacity="<?php echo $opacity ?>">
			<polygon  style="filter:url(#dropshadow)" class="triangle" fill="#D39B00" points="584.414,136.824 443.313,-37.993 840.746,-12.666 	"/>
		</g>
		<g id="Layer_6" class="orange" opacity="<?php echo $opacity ?>">
			<polygon style="filter:url(#dropshadow)" class="triangle" fill="#E14E24" points="796.5,145.386 751.56,-44.939 1074.693,-5.387 	"/>
		</g>


	</svg>

	<div class="shadow-svg">
		<svg class="shadow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMinYMin meet" viewBox="0 0 1000 300" xml:space="preserve">

			<?php $opacity = '0.08' ?>

			<g id="Layer_7" class="shadow" opacity="<?php echo $opacity ?>">
				<polygon points="143.39,193.797 -38.466,18.325 374.409,-50.818 	"/>
			</g>
			<g id="Layer_8" class="shadow" opacity="<?php echo $opacity ?>">
				<polygon  points="697.603,193.797 575.5,-21.995 961.206,-85.319 	"/>
			</g>
			<g id="Layer_9" class="shadow" opacity="<?php echo $opacity ?>">
				<polygon points="412.171,185.525 175.5,-37.993 541.5,-28.676 	"/>
			</g>
			<g id="Layer_10" class="shadow" opacity="<?php echo $opacity ?>">
				<polygon points="862.603,249.375 768.354,-50.818 1166.5,21.469 	"/>
			</g>

		</svg>
	</div>


</div>
