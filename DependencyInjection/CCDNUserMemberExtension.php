<?php

/*
 * This file is part of the CCDN MemberBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\MemberBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class CCDNUserMemberExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'ccdn_user_member';
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('ccdn_user_member.user.profile_route', $config['user']['profile_route']);
        $container->setParameter('ccdn_user_member.template.engine', $config['template']['engine']);
        $container->setParameter('ccdn_user_member.login_route', $config['login_route']);

        $this->getSEOSection($container, $config);
        $this->getMemberSection($container, $config);
        $this->getSidebarSection($container, $config);
    }

    /**
     *
     * @access protected
     * @param $container, $config
     */
    protected function getSEOSection($container, $config)
    {
        $container->setParameter('ccdn_user_member.seo.title_length', $config['seo']['title_length']);
    }

    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getMemberSection($container, $config)
    {
        $container->setParameter('ccdn_user_member.member.list.layout_template', $config['member']['list']['layout_template']);
        $container->setParameter('ccdn_user_member.member.list.members_per_page', $config['member']['list']['members_per_page']);
        $container->setParameter('ccdn_user_member.member.list.member_since_datetime_format', $config['member']['list']['member_since_datetime_format']);
        $container->setParameter('ccdn_user_member.member.list.requires_login', $config['member']['list']['requires_login']);

    }

    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getSidebarSection($container, $config)
    {
        $container->setParameter('ccdn_user_member.sidebar.account_route', $config['sidebar']['account_route']);
        $container->setParameter('ccdn_user_member.sidebar.profile_route', $config['sidebar']['profile_route']);
        $container->setParameter('ccdn_user_member.sidebar.registration_route', $config['sidebar']['registration_route']);
        $container->setParameter('ccdn_user_member.sidebar.login_route', $config['sidebar']['login_route']);
        $container->setParameter('ccdn_user_member.sidebar.logout_route', $config['sidebar']['logout_route']);
        $container->setParameter('ccdn_user_member.sidebar.reset_route', $config['sidebar']['reset_route']);

    }

}
