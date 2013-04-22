<?php

/*
 * This file is part of the CCDNUser MemberBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\MemberBundle\Manager;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\SecurityContext;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\QueryBuilder;

use CCDNUser\MemberBundle\Manager\BaseManagerInterface;
use CCDNUser\MemberBundle\Gateway\BaseGatewayInterface;

/**
 *
 * @category CCDNUser
 * @package  MemberBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserMemberBundle
 *
 */
interface BaseManagerInterface
{
    /**
     *
     * @access public
     * @param \Doctrine\Bundle\DoctrineBundle\Registry            $doctrine
     * @param \Symfony\Component\Security\Core\SecurityContext    $securityContext
     * @param \CCDNUser\MemberBundle\Gateway\BaseGatewayInterface $gateway
     * @param int                                                 $usersPerPage
     */
    public function __construct(Registry $doctrine, SecurityContext $securityContext, BaseGatewayInterface $gateway, $usersPerPage);

    /**
     *
     * @access public
     * @param  string $role
     * @return bool
     */
    public function isGranted($role);

    /**
     *
     * @access public
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser();

    /**
     *
     * @access public
     * @return \CCDNUser\MemberBundle\Gateway\BaseGatewayInterface
     */
    public function getGateway();

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder();

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null);

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function all(QueryBuilder $qb);

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\MemberBundle\Manager\BaseManagerInterface
     */
    public function persist($entity);

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\MemberBundle\Manager\BaseManagerInterface
     */
    public function remove($entity);

    /**
     *
     * @access public
     * @return \CCDNUser\MemberBundle\Manager\BaseManagerInterface
     */
    public function flush();

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\MemberBundle\Manager\BaseManagerInterface
     */
    public function refresh($entity);

    /**
     *
     * @access public
     * @return int
     */
    public function getUsersPerPage();
}
