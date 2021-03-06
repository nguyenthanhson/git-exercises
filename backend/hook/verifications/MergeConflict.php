<?php
namespace GitExercises\hook\verifications;

use GitExercises\hook\AbstractVerification;
use GitExercises\hook\utils\GitUtils;

class MergeConflict extends AbstractVerification
{
    protected function doVerify()
    {
        $mergeCommit = $this->ensureCommitsCount(4)[0];
        $parents = GitUtils::getParents($mergeCommit);
        $this->ensure(count($parents) == 2, 'The last commit should be a merge commit.');
        $lines = $this->getFileContent($mergeCommit, 'file.txt');
        $this->ensure(count($lines) == 1, 'You didn\'t resolve the conflict properly (too many lines).');
        $this->ensure($lines[0] == 'Hola mundo', 'You didn\'t resolve the conflict properly (invalid content).');
    }
}
