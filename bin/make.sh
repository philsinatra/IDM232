#!/bin/bash
cd ${0%/*}

echo "Fixing week 7 'build' directory permissions:"
chmod 777 ../examples/07-data_types/app/build/
echo "Done"
echo ""

echo "Downloading hidden instructor materials:"
curl http://digm.drexel.edu/crs/IDM232/cdn/WORKSHOP.md -o ../instructor_materials/WORKSHOP.md
curl http://digm.drexel.edu/crs/IDM232/cdn/workshop-instructor_notes.md -o ../instructor_materials/workshop-instructor_notes.md
echo "**************************************************************************"
echo "The following files:"
echo "./instructor_materials/WORKSHOP.md"
echo "./instructor_materials/workshop-instructor_notes.md"
echo "are specifically ignored in the repo so students do not have early access."
echo "**************************************************************************"
echo "Done"
echo ""
