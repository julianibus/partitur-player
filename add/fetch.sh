#!/bin/bash


cd $1
echo "Downloading...<br>"
wget -O pdf.pdf $2
echo "Converting...<br>"
pdftoppm -mono -aa no -cropbox -rx 175 -ry 175 -png $3 $4
echo "Cleaning up...<br>"


for original_name in *.png; do
    new_name=$(echo $(echo "$original_name" | cut -f1 -d"-")-$(echo "$original_name" | sed 's/.*\-//' | sed 's/^0*//'))
    mv "$original_name" "$new_name"
done

echo "Done.<br><br>br>"

echo '''
	<table cellpadding="10px">
	<tr>
		<td style="vertical-align:top;">
	<div class="pa" style="vertical-align:top;"><img style="width:80px;height:80px;" src="../favicon.ico"></div></td><td>
	<div class="pa" style=""><h2>Composition added</h2>
	<p>When finished the composition will be available at <pre>http://partitur.org/<?php echo $opus;?></pre>Now continue to the editor for syncing full score and music. It can be found at:<pre>http://partitur.org/<?php echo $opus;?>&editor=1</pre></p>
	<p style="text-align="center"><a href="http://partitur.org/add/edit.php?opus=$4">START EDITOR NOW</a></p></div>
	</td></tr></table>	
'''



