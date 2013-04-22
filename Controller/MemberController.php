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

use CCDNUser\MemberBundle\Controller\BaseController;

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
class MemberController extends BaseController
{
    /**
     *
     * @access public
     * @param  int            $page
     * @return RenderResponse
     */
    public function showAction($page)
    {
        if ($this->container->getParameter('ccdn_user_member.member.list.requires_login') == 'true') {
            $this->isAuthorised('ROLE_USER');
        }

        $membersPager = $this->getUserManager()->getAllUsersPaginated($page);

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_member.crumbs.members'), $this->path('ccdn_user_member_index'));

        return $this->renderResponse('CCDNUserMemberBundle:List:list.html.',
            array(
                'crumbs' => $crumbs,
                'pager_route' => 'ccdn_user_member_paginated',
                'pager' => $membersPager,
                'members' => $membersPager->getCurrentPageResults(),
            )
        );
    }

    /**
     *
     * @access public
     * @param  int            $page
     * @param  char           $alpha
     * @return RenderResponse
     */
    public function showFilteredAction($page, $alpha)
    {
        if ($this->container->getParameter('ccdn_user_member.member.list.requires_login') == 'true') {
            $this->isAuthorised('ROLE_USER');
        }

        $membersPager = $this->getUserManager()->getAllFilteredAtoZUsersPaginated($page, $alpha);

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_member.crumbs.members'), $this->path('ccdn_user_member_index'));

        return $this->renderResponse('CCDNUserMemberBundle:List:list.html.',
            array(
                'crumbs' => $crumbs,
                'pager_route' => 'ccdn_user_member_alpha_paginated',
                'pager' => $membersPager,
                'members' => $membersPager->getCurrentPageResults(),
                'alpha' => $alpha,
            )
        );
    }
}
