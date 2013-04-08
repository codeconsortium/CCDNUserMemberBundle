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

		// Class file namespaces.
        $this->getEntitySection($container, $config);
        $this->getGatewaySection($container, $config);
        $this->getManagerSection($container, $config);
		
		// Configuration stuff.
        $container->setParameter('ccdn_user_member.template.engine', $config['template']['engine']);
        $this->getSEOSection($container, $config);
        $this->getMemberSection($container, $config);
		
		// Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getEntitySection($container, $config)
    {
		if (! array_key_exists('class', $config['entity']['user'])) {
			throw new \Exception('You must set the class of the User entity in "app/config/config.yml" or some imported configuration file.');
		}

        $container->setParameter('ccdn_user_member.entity.user.class', $config['entity']['user']['class']);				
	}
	
    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getGatewaySection($container, $config)
    {
        $container->setParameter('ccdn_user_member.gateway.user.class', $config['gateway']['user']['class']);
	}
	
    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getManagerSection($container, $config)
    {
        $container->setParameter('ccdn_user_member.manager.user.class', $config['manager']['user']['class']);		
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
}