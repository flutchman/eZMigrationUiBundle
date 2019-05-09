#!/bin/bash

EZPLATFORM_BRANCH=`php -r 'echo json_decode(file_get_contents("./composer.json"))->extra->_ezplatform_branch_for_behat_tests;'`
EZPLATFORM_BRANCH="${EZPLATFORM_BRANCH:-master}"
PACKAGE_BUILD_DIR=$PWD
EZPLATFORM_BUILD_DIR=${HOME}/build/ezplatform

echo "> Cloning ezsystems/ezplatform:${EZPLATFORM_BRANCH}"
git clone --depth 1 --single-branch --branch "${EZPLATFORM_BRANCH}" ${EZPLATFORM_REPO} ${EZPLATFORM_BUILD_DIR}
cd ${EZPLATFORM_BUILD_DIR}
cp behat.yml.dist behat.yml
echo "> before setup"
ls -la
echo '    - vendor/flutchman/ez-migration-ui-bundle/behat_suites.yml' >> behat.yml
cat behat.yml

/bin/bash ./bin/.travis/trusty/setup_ezplatform.sh "${COMPOSE_FILE}" '' "${PACKAGE_BUILD_DIR}"
echo "> after setup"
ls -la
cat behat.yml
