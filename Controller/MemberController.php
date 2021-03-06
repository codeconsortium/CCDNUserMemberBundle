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

namespace CCDNUser\MemberBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class MemberController extends ContainerAware
{

    /**
     *
     * @access public
     * @param int $page
     * @return RenderResponse
     */
    public function showAction($page)
    {
        if ($this->container->getParameter('ccdn_user_member.member.list.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

        $membersPager = $this->container->get('ccdn_user_user.repository.user')->findAllPaginated();

        $membersPerPage = $this->container->getParameter('ccdn_user_member.member.list.members_per_page');
        $membersPager->setMaxPerPage($membersPerPage);
        $membersPager->setCurrentPage($page, false, true);

        $members = $membersPager->getCurrentPageResults();

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users");
		
        return $this->container->get('templating')->renderResponse('CCDNUserMemberBundle:List:list.html.' . $this->getEngine(), array(
			'crumbs' => $crumbs,
            'pager_route' => 'ccdn_user_member_paginated',
            'pager' => $membersPager,
            'members' => $members,
        ));
    }

    /**
     *
     * @access public
     * @param int $page, char $alpha
     * @return RenderResponse
     */
    public function showFilteredAction($page, $alpha)
    {
        if ($this->container->getParameter('ccdn_user_member.member.list.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

        $membersPager = $this->container->get('ccdn_user_user.repository.user')->findAllFilteredPaginated($alpha);

        $membersPerPage = $this->container->getParameter('ccdn_user_member.member.list.members_per_page');
        $membersPager->setMaxPerPage($membersPerPage);
        $membersPager->setCurrentPage($page, false, true);

        $members = $membersPager->getCurrentPageResults();

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users");
		
        return $this->container->get('templating')->renderResponse('CCDNUserMemberBundle:List:list.html.' . $this->getEngine(), array(
			'crumbs' => $crumbs,
            'pager_route' => 'ccdn_user_member_alpha_paginated',
            'pager' => $membersPager,
            'members' => $members,
            'alpha' => $alpha,
        ));
    }

    /**
     *
     * @access protected
     * @return string
     */
    protected function getEngine()
    {
        return $this->container->getParameter('ccdn_user_member.template.engine');
    }
}
