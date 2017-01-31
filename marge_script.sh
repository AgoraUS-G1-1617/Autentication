if [ "$TRAVIS_BRANCH" != "test" ]; then 
    exit 0;
fi

export GIT_COMMITTER_EMAIL=alex_sfc4@hotmail.com
export GIT_COMMITTER_NAME=aleromrod1

git checkout master || exit
git merge "$TRAVIS_COMMIT" || exit
git push https://github.com/AgoraUS-G1-1617/Autentication.git # here need some authorization and url