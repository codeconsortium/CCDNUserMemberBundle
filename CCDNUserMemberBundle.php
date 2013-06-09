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
 * @category CCDNUser
 * @package  MemberBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 1.0
 * @link     https://github.com/codeconsortium/CCDNUserMemberBundle
 *
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
		
        $twig->addGlobal(
			'ccdn_user_member',
            array(
                'seo' => array(
                    'title_length' => $this->container->getParameter('ccdn_user_member.seo.title_length'),
                ),
                'member' => array(
                    'list' => array(
                        'layout_template' => $this->container->getParameter('ccdn_user_member.member.list.layout_template'),
                        'member_since_datetime_format' => $this->container->getParameter('ccdn_user_member.member.list.member_since_datetime_format'),
                    ),
                ),
            )
        ); // End Twig Globals.
    }
}
