#!/bin/bash

ZIPNAME="unwrap-shortlinks"

echo "Removing old build folder and zip if present"
if test -d "build/$ZIPNAME"; then
	rm -rf "build/$ZIPNAME"
fi
if test -f "build/$ZIPNAME.zip"; then
	rm "build/$ZIPNAME.zip"
fi

echo "Copying files to build folder"
if [ ! -d build ]; then
	mkdir build
fi

mkdir build/$ZIPNAME
cp -p *.php *.md LICENSE "build/$ZIPNAME"

echo "Building $ZIPNAME"
cd build && zip -r "$ZIPNAME.zip" "$ZIPNAME"

