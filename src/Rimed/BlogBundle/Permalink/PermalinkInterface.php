<?php

namespace Rimed\BlogBundle\Permalink;

use Rimed\BlogBundle\Model\PostInterface;

interface PermalinkInterface
{
    /**
     * @param \Rimed\BlogBundle\Model\PostInterface $post
     */
    public function generate(PostInterface $post);

    /**
     * @param string $permalink
     *
     * @return array
     */
    public function getParameters($permalink);
}
