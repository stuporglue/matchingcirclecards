#!/usr/bin/env php
<?php

// Crop a png to a circle
// http://www.imagemagick.org/discourse-server/viewtopic.php?f=2&t=15492&p=54769&hilit=circle+mask#p54769
// convert zelda3.jpg \( +clone -threshold -1 -negate -fill white -draw "circle 64,64 64,0" \) -alpha off -compose copy_opacity -composite zelda3_circ.gif

$cards_to_photos = json_decode('{"1":[0,1,2,3,4,5,6,49],
"2":[7,8,9,10,11,12,13,49],
"3":[49,14,15,16,17,18,19,20],
"4":[49,21,22,23,24,25,26,27],
"5":[32,33,34,49,28,29,30,31],
"6":[35,36,37,38,39,40,41,49],
"7":[42,43,44,45,46,47,48,49],
"8":[0,35,7,42,14,50,21,28],
"9":[1,36,8,43,15,50,22,29],
"10":[2,37,9,44,16,50,23,30],
"11":[3,38,10,45,17,50,24,31],
"12":[32,4,39,11,50,46,18,25],
"13":[33,5,40,12,47,50,19,26],
"14":[34,6,41,13,48,50,20,27],
"15":[0,32,48,8,16,40,51,24],
"16":[1,33,41,42,17,51,9,25],
"17":[34,35,10,43,2,18,51,26],
"18":[51,3,36,11,44,19,27,28],
"19":[4,37,12,45,51,20,21,29],
"20":[5,38,13,14,51,46,22,30],
"21":[6,39,7,15,51,23,47,31],
"22":[0,38,9,47,18,52,27,29],
"23":[1,39,10,48,19,52,21,30],
"24":[2,40,42,11,20,22,52,31],
"25":[32,3,41,43,12,14,52,23],
"26":[33,35,4,44,13,15,52,24],
"27":[34,36,5,7,45,16,52,25],
"28":[37,6,8,46,17,52,26,28],
"29":[0,33,36,10,46,20,53,23],
"30":[1,34,37,11,14,47,53,24],
"31":[2,38,12,15,48,53,25,28],
"32":[3,39,42,13,16,53,26,29],
"33":[4,7,40,43,17,53,27,30],
"34":[5,8,41,44,18,21,53,31],
"35":[32,35,6,9,45,19,53,22],
"36":[0,41,11,45,15,54,26,30],
"37":[1,35,12,46,16,54,27,31],
"38":[32,2,36,13,47,17,21,54],
"39":[33,3,37,7,48,18,22,54],
"40":[34,4,38,8,42,19,54,23],
"41":[5,39,9,43,20,54,24,28],
"42":[6,40,10,44,14,54,25,29],
"43":[0,34,39,44,12,17,22,55],
"44":[1,40,55,13,45,18,23,28],
"45":[2,7,41,46,19,55,24,29],
"46":[3,8,47,35,20,55,25,30],
"47":[4,9,14,48,55,36,26,31],
"48":[32,37,10,15,55,27,42,5],
"49":[33,43,38,6,11,16,21,55],
"50":[0,37,43,13,19,56,25,31],
"51":[32,1,38,7,44,20,56,26],
"52":[33,2,39,8,45,14,56,27],
"53":[34,3,40,9,46,15,21,56],
"54":[4,41,10,47,16,22,56,28],
"55":[35,5,11,48,17,23,56,29],
"56":[36,6,42,12,56,18,24,30],
"57":[49,50,51,52,53,54,55,56]}',true);

$sizes = array(
	'large' => '300x300',
	'medium' => '245x245',
	'small' => '150x150'
);

$padded = '1050x1000';

foreach($cards_to_photos as $one_card => $photos){

	print "Card $one_card...";

	$style = rand(0,2);
	$style = 1;

	$cmd = "convert -size 900x900 ./input/circle.png ";

	switch ($style) {

		case -1: 
			$cmd .= " \\\n \\(  ./input/${photos[0]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['small']}+395+690 \\) -composite ";
			$cmd .= " \\\n   ./output/$one_card.png";

			break;

		case 0:

			// snowman look
			$cmd .= " \\\n \\(  ./input/${photos[0]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['small']}+395+690  -rotate " . rand(0,360) . " \\) -composite "; // calculator
			$cmd .= " \\\n \\(  ./input/${photos[1]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['small']}+172+552  -rotate " . rand(0,360) . " \\) -composite "; // a accent
			$cmd .= " \\\n \\(  ./input/${photos[2]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['small']}+350+60   -rotate " . rand(0,360) . " \\) -composite "; // book w/ bookmark
			$cmd .= " \\\n \\(  ./input/${photos[3]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['small']}+725+345  -rotate " . rand(0,360) . " \\) -composite "; // notepad
			$cmd .= " \\\n \\(  ./input/${photos[4]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['medium']}+90+230  -rotate " . rand(0,360) . " \\) -composite "; // address book
			$cmd .= " \\\n \\(  ./input/${photos[5]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['medium']}+545+135 -rotate " . rand(0,360) . " \\) -composite "; // globe
			$cmd .= " \\\n \\(  ./input/${photos[6]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['large']}+285+278  -rotate " . rand(0,360) . " \\) -composite "; // gear
			$cmd .= " \\\n \\(  ./input/${photos[7]}.png -background 'rgba(0,0,0,0)' -geometry ${sizes['large']}+510+440  -rotate " . rand(0,360) . " \\) -composite "; // blank document
			$cmd .= " \\\n -background none -gravity center -extent $padded";
			$cmd .= " \\\n -stroke blue  -fill blue -gravity southeast -pointsize 50 -annotate 0 'Card $one_card, Style $style'";
			$cmd .= " \\\n   ./output/$one_card.png";

			break;

		case 1:

			// even dist look
			$cmd .= " \\\n \\(  ./input/${photos[0]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['small']}+122+170  \\) -composite "; // calculator
			$cmd .= " \\\n \\(  ./input/${photos[1]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+179+590 \\) -composite "; // a accent
			$cmd .= " \\\n \\(  ./input/${photos[2]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+310+350 \\) -composite "; // book w/ bookmark
			$cmd .= " \\\n \\(  ./input/${photos[3]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+616+380 \\) -composite "; // notepad
			$cmd .= " \\\n \\(  ./input/${photos[4]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+280+45  \\) -composite "; // address book
			$cmd .= " \\\n \\(  ./input/${photos[5]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['large']}+430+570  \\) -composite "; // globe
			$cmd .= " \\\n \\(  ./input/${photos[6]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['large']}+30+325   \\) -composite "; // gear
			$cmd .= " \\\n \\(  ./input/${photos[7]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['large']}+480+120  \\) -composite "; // blank document   
			$cmd .= " \\\n -background none -gravity center -extent $padded";
			$cmd .= " \\\n -stroke blue  -fill blue -gravity southeast -pointsize 50 -annotate 0 'Card $one_card, Style $style'";
			$cmd .= " \\\n   ./output/$one_card.png";

			break;		


		case 2:

			// random look
			$cmd .= " \\\n \\(  ./input/${photos[0]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['small']}+385+670  \\) -composite "; // calculator
			$cmd .= " \\\n \\(  ./input/${photos[1]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['small']}+50+335   \\) -composite "; // a accent
			$cmd .= " \\\n \\(  ./input/${photos[2]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['small']}+715+330  \\) -composite "; // book w/ bookmark
			$cmd .= " \\\n \\(  ./input/${photos[3]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+130+520 \\) -composite "; // notepad
			$cmd .= " \\\n \\(  ./input/${photos[4]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+305+315 \\) -composite "; // address book
			$cmd .= " \\\n \\(  ./input/${photos[5]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+215+45  \\) -composite "; // globe
			$cmd .= " \\\n \\(  ./input/${photos[6]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['medium']}+495+100 \\) -composite "; // gear
			$cmd .= " \\\n \\(  ./input/${photos[7]}.png -background 'rgba(0,0,0,0)' -rotate " . rand(0,360) . " -geometry ${sizes['large']}+515+475  \\) -composite "; // blank document   
			$cmd .= " \\\n -background none -gravity center -extent $padded";
			$cmd .= " \\\n -stroke blue  -fill blue -gravity southeast -pointsize 50 -annotate 0 'Card $one_card, Style $style'";
			$cmd .= " \\\n   ./output/$one_card.png";

			break;		
	}

	$cmd .= " # Card $one_card, Style $style";

	//print $cmd . "\n";
	`$cmd`;
	//print `imgcat ./output/$one_card.png`;
	//die();
	
	print "Done!\n";
}

print "Sheet 1...";
`montage -mode concatenate -tile 2x3 ./output/1.png ./output/2.png ./output/3.png ./output/4.png ./output/5.png ./output/6.png       ./output/sheet1.png`;
print "Done!\nSheet 2...";
`montage -mode concatenate -tile 2x3 ./output/7.png ./output/8.png ./output/9.png ./output/10.png ./output/11.png ./output/12.png    ./output/sheet2.png`;
print "Done!\nSheet 3...";
`montage -mode concatenate -tile 2x3 ./output/13.png ./output/14.png ./output/15.png ./output/16.png ./output/17.png ./output/18.png ./output/sheet3.png`;
print "Done!\nSheet 4...";
`montage -mode concatenate -tile 2x3 ./output/19.png ./output/20.png ./output/21.png ./output/22.png ./output/23.png ./output/24.png ./output/sheet4.png`;
print "Done!\nSheet 5...";
`montage -mode concatenate -tile 2x3 ./output/25.png ./output/26.png ./output/27.png ./output/28.png ./output/29.png ./output/30.png ./output/sheet5.png`;
print "Done!\nSheet 6...";
`montage -mode concatenate -tile 2x3 ./output/31.png ./output/32.png ./output/33.png ./output/34.png ./output/35.png ./output/36.png ./output/sheet6.png`;
print "Done!\nSheet 7...";
`montage -mode concatenate -tile 2x3 ./output/37.png ./output/38.png ./output/39.png ./output/40.png ./output/41.png ./output/42.png ./output/sheet7.png`;
print "Done!\nSheet 8...";
`montage -mode concatenate -tile 2x3 ./output/43.png ./output/44.png ./output/45.png ./output/46.png ./output/47.png ./output/48.png ./output/sheet8.png`;
print "Done!\nSheet 9...";
`montage -mode concatenate -tile 2x3 ./output/49.png ./output/50.png ./output/51.png ./output/52.png ./output/53.png ./output/54.png ./output/sheet9.png`;
print "Done!\nSheet 10...";
`montage -mode concatenate -tile 2x3 ./output/55.png ./output/56.png ./output/57.png                                                 ./output/sheet10.png`;
print "Done!\n";
