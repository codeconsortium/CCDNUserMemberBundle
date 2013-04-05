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

use CCDNUser\MemberBundle\Manager\BaseManagerInterface;
use CCDNUser\MemberBundle\Manager\BaseManager;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class UserManager extends BaseManager implements BaseManagerInterface
{
	/**
	 *
	 * @access public
	 * @param int $page
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */	
	public function getAllUsersPaginated($page)
	{
		$qb = $this->createSelectQuery(array('u'));
		
		$qb
			->addOrderBy('u.username', 'DESC')
			->addOrderBy('u.registeredDate', 'DESC')
		;

		return $this->gateway->paginateQuery($qb, $this->getUsersPerPage(), $page);
	}
	
	/**
	 *
	 * @access public
	 * @param int $page
	 * @param char $alpha
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */	
	public function getAllFilteredAtoZUsersPaginated($page, $alpha)
	{
		$qb = $this->createSelectQuery(array('u'));
		
		$params = array(':filter' => $alpha . '%');
		
		$qb
			->where('u.username LIKE :filter')
			->setParameters($params)
			->addOrderBy('u.username', 'DESC')
			->addOrderBy('u.registeredDate', 'DESC')
		;

		return $this->gateway->paginateQuery($qb, $this->getUsersPerPage(), $page);
	}
}