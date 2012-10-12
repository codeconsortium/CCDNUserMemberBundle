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
     * @param  Int $page
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

        return $this->container->get('templating')->renderResponse('CCDNUserMemberBundle:List:list.html.' . $this->getEngine(), array(
            'user_profile_route' => $this->container->getParameter('ccdn_user_member.user.profile_route'),
            'pager_route' => 'ccdn_user_member_paginated',
            'pager' => $membersPager,
            'members' => $members,
        ));
    }

    /**
     *
     * @access public
     * @param  Int $page, Char $alpha
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

        return $this->container->get('templating')->renderResponse('CCDNUserMemberBundle:List:list.html.' . $this->getEngine(), array(
            'user_profile_route' => $this->container->getParameter('ccdn_user_member.user.profile_route'),
            'pager_route' => 'ccdn_user_member_alpha_paginated',
            'pager' => $membersPager,
            'members' => $members,
            'alpha' => $alpha,
        ));
    }

    /**
     *
     * @access protected
     * @return String
     */
    protected function getEngine()
    {
        return $this->container->getParameter('ccdn_user_member.template.engine');
    }
}
