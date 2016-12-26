#!/bin/bash

cd $1
echo "Downloading..."
wget $2
echo "Converting..."
pdftoppm -png $2 $3

