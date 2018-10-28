<?php
/**
 * Created by PhpStorm.
 * User: andru
 * Date: 28-Oct-18
 * Time: 3:54
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Issue.
 * @ORM\Entity
 * @ORM\Table(name="issues")
 */
class Issue
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Node
     * @ORM\ManyToOne(targetEntity="App\Entity\Node")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     */
    private $node;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="reporter_id", referencedColumnName="id")
     */
    private $reporter;

    /**
     * @var User|null
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="assignee_id", referencedColumnName="id", nullable=true)
     */
    private $assignee;

    /**
     * Issue constructor.
     * @param Node $node
     * @param User $reporter
     */
    public function __construct(Node $node, User $reporter)
    {
        $this->node = $node;
        $this->reporter = $reporter;
        $this->assignee = null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Node
     */
    public function getNode(): Node
    {
        return $this->node;
    }

    /**
     * @param Node $node
     *
     * @return Issue
     */
    public function setNode(Node $node): Issue
    {
        $this->node = $node;

        return $this;
    }

    /**
     * @return User
     */
    public function getReporter(): User
    {
        return $this->reporter;
    }

    /**
     * @param User $reporter
     *
     * @return Issue
     */
    public function setReporter(User $reporter): Issue
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getAssignee(): ?User
    {
        return $this->assignee;
    }

    /**
     * @param User|null $assignee
     *
     * @return Issue
     */
    public function setAssignee(?User $assignee): Issue
    {
        $this->assignee = $assignee;
        return $this;
    }
}