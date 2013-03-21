<?php

namespace Rimed\BlogBundle\Permalink;

use Rimed\BlogBundle\Model\PostInterface;

class CategoryPermalink implements PermalinkInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(PostInterface $post)
    {
        return null == $post->getCategory()
            ? $post->getSlug()
            : sprintf('%s/%s', $post->getCategory()->getSlug(), $post->getSlug());
    }

    /**
     * @param string $permalink
     *
     * @return array
     */
    public function getParameters($permalink)
    {
        $parameters = explode('/', $permalink);

        if (count($parameters) > 2 || count($parameters) == 0) {
            throw new \InvalidArgumentException('wrong permalink format');
        }

        if (false === strpos($permalink, '/')) {
            $category = null;
            $slug = $permalink;
        } else {
            list($category, $slug) = $parameters;
        }

        return array(
            'category' => $category,
            'slug'     => $slug,
        );
    }
}
