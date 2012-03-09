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
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

		$container->setParameter('ccdn_user_member.user.profile_route', $config['user']['profile_route']);
		$container->setParameter('ccdn_user_member.template.engine', $config['template']['engine']);
		$container->setParameter('ccdn_user_member.template.theme', $config['template']['theme']);
		
		$container->setParameter('ccdn_user_member.members_per_page', $config['members_per_page']);
		
		$this->getMemberSection($container, $config);
    }
	
	
	
	/**
	 *
	 * @access private
	 * @param $container, $config
	 */
	private function getMemberSection($container, $config)
	{
		$container->setParameter('ccdn_user_member.member.layout_templates.list', $config['member']['layout_templates']['list']);
	}
	
	
}
