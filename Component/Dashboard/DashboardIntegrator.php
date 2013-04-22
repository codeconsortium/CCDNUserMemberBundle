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

namespace CCDNUser\MemberBundle\Component\Dashboard;

use CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface;

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
class DashboardIntegrator
{
    /**
     *
     * @access protected
     * @var bool $requiresLogin
     */
    protected $requiresLogin;

    /**
     *
     * @access public
     * @param bool $requiresLogin
     */
    public function __construct($requiresLogin)
    {
        $this->requiresLogin = $requiresLogin;
    }

    /**
     *
     * @access public
     * @param CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface $builder
     */
    public function build(BuilderInterface $builder)
    {
        $builder
            ->addCategory('community')
                ->setLabel('ccdn_user_member.dashboard.categories.user', array(), 'CCDNUserMemberBundle')
                ->addLinks()
                    ->addLink('members')
                        ->setAuthRole(($this->requiresLogin ? 'ROLE_USER': null))
                        ->setRoute('ccdn_user_member_index')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_users.png')
                        ->setLabel('ccdn_user_member.title.members', array(), 'CCDNUserMemberBundle')
                    ->end()
                ->end()
            ->end()
        ;
    }
}
