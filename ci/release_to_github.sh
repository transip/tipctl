#!/bin/bash

set -e

readonly TAG_VERSION="$1"
readonly FILE_TO_PUSH="$2"

if [ -z "$GITHUB_TOKEN" ] ; then
  echo "we need a github token in order to proceed";
  exit 1;
fi
if [ -z "$TAG_VERSION" ] ; then
  echo "we need a version in order to proceed";
  exit 1;
fi
if [ -z "$FILE_TO_PUSH" ] ; then
  echo "we need a file to push in order to proceed";
  exit 1;
fi

description="Please set a description"

json_output=$(curl -H "Authorization: token ${GITHUB_TOKEN}" \
  -H "Content-Type: application/json" \
  -X GET "https://api.github.com/repos/transip/tipctl/releases/tags/${TAG_VERSION}")

release_id=$(echo $json_output | python -c 'import json,sys;print json.load(sys.stdin)["id"]')
name_of_asset=$(basename $FILE_TO_PUSH)

echo "Created release ${release_id}, lets upload our artifact to this release"
echo "Pushing ${name_of_asset} to release with id ${release_id}"

json_output=$(curl -H "Authorization: token ${GITHUB_TOKEN}" \
    -H "Content-Type: application/octet-stream" \
    -X POST "https://uploads.github.com/repos/transip/tipctl/releases/${release_id}/assets?name=${name_of_asset}" \
    --data-binary @$FILE_TO_PUSH)

echo $json_output
