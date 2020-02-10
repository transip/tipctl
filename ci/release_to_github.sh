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

# returns the previous tag since this tag
function get_previous_tag() {
  git describe --abbrev=0 --tags $TAG_VERSION^ 2> /dev/null || echo ""
}

# generate description by the previous commits
# if changelog did not change between tags we generate something via the commits
function get_description() {
  previous_tag=$(get_previous_tag)

  # no previous tag add everything as
  if [ -z "$previous_tag"]; then
    git --no-pager log --decorate=no --format="- %s" --no-merges | sed 's/\-/\\n\-/'
    return;
  fi;

  git --no-pager log --decorate=no --format="- %s" --no-merges | sed 's/\-/\\n\-/'
}

description="Please set a description"

json_output=$(curl -H "Authorization: token ${GITHUB_TOKEN}" \
  -H "Content-Type: application/json" \
  -X POST "https://api.github.com/repos/transip/tipctl/releases" \
  -d "{\"tag_name\": \"$TAG_VERSION\", \"name\": \"$TAG_VERSION\", \"body\": \"$description\", \"draft\": true, \"prerelease\": false}")

release_id=$(echo $json_output | python -c 'import json,sys;print json.load(sys.stdin)["id"]')
name_of_asset=$(basename $FILE_TO_PUSH)

echo "Created release ${release_id}, lets upload our artifact to this release"
echo "Pushing ${name_of_asset} to release with id ${release_id}"

json_output=$(curl -H "Authorization: token ${GITHUB_TOKEN}" \
    -H "Content-Type: application/octet-stream" \
    -X POST "https://uploads.github.com/repos/transip/tipctl/releases/${release_id}/assets?name=${name_of_asset}" \
    --data-binary @$FILE_TO_PUSH)

echo $json_output
