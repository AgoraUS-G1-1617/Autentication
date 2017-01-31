if [ "$TRAVIS_BRANCH" != "test" ]; then 
    exit 0;
fi

export GIT_AUTHOR_NAME="corxonero"
export GIT_AUTHOR_EMAIL=corxonero@gmail.com
export GIT_COMMITTER_NAME="$GIT_AUTHOR_NAME"
export GIT_COMMITTER_EMAIL="$GIT_AUTHOR_EMAIL"

git checkout master || exit
git merge "$TRAVIS_COMMIT" || exit
git push https://github.com/AgoraUS-G1-1617/Autentication.git # here need some authorization and url