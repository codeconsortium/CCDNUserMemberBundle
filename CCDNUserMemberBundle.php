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

namespace CCDNUser\MemberBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class CCDNUserMemberBundle extends Bundle
{
				
	/**
	 *
	 * @access public
	 */
	public function boot()
	{
		$twig = $this->container->get('twig');	
		$twig->addGlobal('ccdn_user_member', array(
			'seo' => array(
				'title_length' => $this->container->getParameter('ccdn_user_member.seo.title_length'),
			),
			//'login_route' => $this->container->getParameter('ccdn_user_member.login_route'),
			//'account_route' => $this->container->getParameter('ccdn_user_member.sidebar.account_route'),
			//'profile_route' => $this->container->getParameter('ccdn_user_member.sidebar.profile_route'),
			//'login_route' => $this->container->getParameter('ccdn_user_member.sidebar.login_route'),
			//'registration_route' => $this->container->getParameter('ccdn_user_member.sidebar.registration_route'),
			//'reset_route' => $this->container->getParameter('ccdn_user_member.sidebar.reset_route'),
			'member' => array(
				'list' => array(
					'layout_template' => $this->container->getParameter('ccdn_user_member.member.list.layout_template'),
					'member_since_datetime_format' => $this->container->getParameter('ccdn_user_member.member.list.member_since_datetime_format'),
				),
			),
            'sidebar' => array(
                'links' => $this->container->getParameter('ccdn_user_member.sidebar.links'),
            ),
		));
	}
	
}
