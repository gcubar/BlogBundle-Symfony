<?php

namespace Rimed\BlogBundle\Model;

interface CategoryInterface
{
    /**
     * Get id
     *
     * @return $id
     */
    public function getId();

    /**
     * @param $name
     *
     * @return mixed
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName();

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled();

    /**
     * Set slug
     *
     * @param integer $slug
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return integer $slug
     */
    public function getSlug();

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription();

    /**
     * Add posts
     *
     * @param \Rimed\BlogBundle\Model\PostInterface $posts
     */
    public function addPosts(PostInterface $posts);

    /**
     * Get posts
     *
     * @return array $posts
     */
    public function getPosts();
}
