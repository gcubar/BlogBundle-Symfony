<?php

namespace Rimed\BlogBundle\Model;

interface CommentManagerInterface
{
    /**
     * Creates an empty comment instance
     *
     * @return Comment
     */
    public function create();

    /**
     * Deletes a comment
     *
     * @param CommentInterface $comment
     *
     * @return void
     */
    public function delete(CommentInterface $comment);

    /**
     * Finds one comment by the given criteria
     *
     * @param array $criteria
     *
     * @return CommentInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Finds one comment by the given criteria
     *
     * @param array $criteria
     *
     * @return CommentInterface
     */
    public function findBy(array $criteria);

    /**
     * Returns the comment's fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Save a post
     *
     * @param CommentInterface $comment
     *
     * @return void
     */
    public function save(CommentInterface $comment);

    /**
     * Update the number of comment for a comment
     *
     * @return void
     */
    public function updateCommentsCount(PostInterface $post = null);
}
