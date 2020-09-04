#!/bin/bash

if [ -z "$GITHUB_CREDENTIALS" ] ; then
  echo "we need a github credentials in order to proceed";
  exit 1;
fi

# Remove the default origin/HEAD -> origin/master ref
# as github shows this as new branch
git remote set-head origin -d

git push --prune https://${GITHUB_CREDENTIALS}@github.com/transip/tipctl.git +refs/remotes/origin/*:refs/heads/* +refs/tags/*:refs/tags/*
