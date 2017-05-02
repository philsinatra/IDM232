#!/bin/bash
cd ${0%/*}

fn=answer_key.zip
destroot=../tests
dest="${destroot}/${fn}"
#
echo "Downloading assets for $fn to $dest"

curl http://digm.drexel.edu/crs/IDM232/cdn/$fn -o $dest
cd $destroot
unzip $fn
rm $fn
cd -

echo "**************************************************************************"
echo "The following files:"
echo "$fn"
echo "have been downloaded to $destroot"
echo "**************************************************************************"
echo "Done"
echo ""
