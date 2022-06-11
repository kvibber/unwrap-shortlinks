#!/bin/bash
# https://developer.wordpress.org/plugins/wordpress-org/how-to-use-subversion/

VERSION=$1
ACTION=""
MESSAGE=$2

echo "Updating files in trunk."
cp -p *.php *.md release-svn/trunk



if [[ $VERSION == "trunk" ]]; then
  if [[ "x$MESSAGE" == "x"  ]]; then
    echo "Message?"
    read MESSAGE
  fi
  if [[ "x$MESSAGE" == "x"  ]]; then
    echo "Sorry, a message is required"
    exit -1
  fi

  echo "Checking in the updated trunk"
  cd release-svn/trunk
  svn ci -m "$MESSAGE"
  exit 0
fi



if [[ "x$VERSION" == "x" ]]; then
	echo "No release version specified, stopping here."
	exit 0
fi




if [ ! -f ".git/refs/tags/v$VERSION" ]; then
  echo "Error: v$VERSION not found in git tags."
  exit -1
fi

cd release-svn

if [ -d "tags/$VERSION" ]; then
  echo "Warning: Release $VERSION already exists in local svn."
  echo "(r)eplace, (u)pload as-is, or (c)ancel?"
  read ACTION
  if [[ $ACTION == "r" ]]; then 
    echo "removing old tag $VERSION"
    svn rm --force "tags/$VERSION"
  elif [[ ! $ACTION == "u" ]]; then
    echo "Cancelling"
    exit -1
  fi
fi

if [[ $ACTION == "u" ]]; then
  echo "Leaving release tag unchanged."
else
  echo "Tagging release $VERSION in svn."
  svn cp trunk "tags/$VERSION"
fi

echo "Checking in updated version $VERSION"
svn ci -m "tagging version $VERSION"


