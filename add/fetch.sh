#!/bin/bash


cd $1
echo "Downloading..."
wget -O pdf.pdf $2
echo "Converting..."
pdftoppm -mono -aa no -cropbox -rx 175 -ry 175 -png $3 $4
echo "Cleaning up..."


for original_name in *.png; do
    new_name=$(echo $(echo "$original_name" | cut -f1 -d"-")-$(echo "$original_name" | sed 's/.*\-//' | sed 's/^0*//'))
    mv "$original_name" "$new_name"
done



