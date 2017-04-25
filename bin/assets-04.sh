#!/bin/bash
cd ${0%/*}

fn=04-building_with_PHP.zip
destroot=~/Desktop
dest="${destroot}/${fn}"

echo "Downloading assets for $fn to $dest"

curl http://digm.drexel.edu/crs/IDM232/cdn/$fn -o $dest

echo "**************************************************************************"
echo "The following files:"
echo "$fn"
echo "have been downloaded to $destroot."
echo "These are shell files for working through examples associated with lecture"
echo "04-building_with_PHP"
echo "Copy these files to your MAMP project directory to use for demo purposes."
echo "**************************************************************************"
echo "Done"
echo ""
