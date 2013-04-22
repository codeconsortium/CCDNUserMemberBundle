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

namespace CCDNUser\MemberBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
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
class CCDNUserMemberExtension extends Extension
{
    /**
     *
     * @access public
     * @return string
     */
    public function getAlias()
    {
        return 'ccdn_user_member';
    }

    /**
     *
     * @access public
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Class file namespaces.
        $this
            ->getEntitySection($config, $container)
            ->getGatewaySection($config, $container)
            ->getManagerSection($config, $container)
            ->getComponentSection($config, $container)
        ;

        // Configuration stuff.
        $container->setParameter('ccdn_user_member.template.engine', $config['template']['engine']);

        $this
            ->getSEOSection($config, $container)
            ->getMemberSection($config, $container)
        ;

        // Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getEntitySection(array $config, ContainerBuilder $container)
    {
        if (! array_key_exists('class', $config['entity']['user'])) {
            throw new \Exception('You must set the class of the User entity in "app/config/config.yml" or some imported configuration file.');
        }

        $container->setParameter('ccdn_user_member.entity.user.class', $config['entity']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getGatewaySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_member.gateway.user.class', $config['gateway']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getManagerSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_member.manager.user.class', $config['manager']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getComponentSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_member.component.dashboard.integrator.class', $config['component']['dashboard']['integrator']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getSEOSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_member.seo.title_length', $config['seo']['title_length']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\MemberBundle\DependencyInjection\CCDNUserMemberExtension
     */
    private function getMemberSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_member.member.list.layout_template', $config['member']['list']['layout_template']);
        $container->setParameter('ccdn_user_member.member.list.members_per_page', $config['member']['list']['members_per_page']);
        $container->setParameter('ccdn_user_member.member.list.member_since_datetime_format', $config['member']['list']['member_since_datetime_format']);
        $container->setParameter('ccdn_user_member.member.list.requires_login', $config['member']['list']['requires_login']);

        return $this;
    }
}
