#!/usr/bin/env bash
set -euo pipefail

if [[ -z "${DEPLOY_TOKEN:-}" ]]; then
    echo '::error::ACCESS_TOKEN is missing. A token with push access is required to publish gh-pages.'
    exit 1
fi

export GIT_TERMINAL_PROMPT=0
export GIT_CONFIG_COUNT=2
export GIT_CONFIG_KEY_0=http.https://github.com/.extraheader
GIT_CONFIG_VALUE_0="AUTHORIZATION: basic $(printf 'x-access-token:%s' "$DEPLOY_TOKEN" | base64 | tr -d '\n')"
export GIT_CONFIG_VALUE_0
export GIT_CONFIG_KEY_1=credential.helper
export GIT_CONFIG_VALUE_1=

if ! git push --dry-run --force "${GITHUB_SERVER_URL}/${GITHUB_REPOSITORY}.git" HEAD:refs/heads/gh-pages; then
    echo '::error::Cannot publish gh-pages. Check ACCESS_TOKEN validity and repository write access. No changes were pushed.'
    exit 1
fi
