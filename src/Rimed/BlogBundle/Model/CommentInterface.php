<?php

namespace Rimed\BlogBundle\Model;

interface CommentInterface
{
    const STATUS_INVALID  = 0;
    const STATUS_VALID    = 1;
    const STATUS_MODERATE = 2;
    const STATUS_GARBAGE  = 3;
    const STATUS_SPAM     = 4;

    public function getId();

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName();

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail();

    /**
     * Set url
     *
     * @param text $url
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return text $url
     */
    public function getUrl();

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message);

    /**
     * Get message
     *
     * @return text $message
     */
    public function getMessage();

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt = null);

    /**
     * Get created_at
     *
     * @return \DateTime $createdAt
     */
    public function getCreatedAt();

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt();

    public function getStatusCode();

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status);

    /**
     * Get status
     *
     * @return integer $status
     */
    public function getStatus();

    /**
     * Set post
     *
     * @param \Rimed\BlogBundle\Model\PostInterface $post
     */
    public function setPost($post);

    /**
     * Get post
     *
     * @return \Rimed\BlogBundle\Model\PostInterface $post
     */
    public function getPost();
}
