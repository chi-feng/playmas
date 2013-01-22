#!/bin/sh
echo "fetching nonessential files (not application code)"
wget http://play.measong.com/nonessential.tar.gz
tar -xzf nonessential.tar.gz
rm nonessential.tar.gz
echo "done"