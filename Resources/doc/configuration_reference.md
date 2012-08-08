CCDNUser MemberBundle Configuration Reference.
==============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser MemberBundle    
#
ccdn_user_member:
    user:
        profile_route: ccdn_user_profile_show_by_id 
    template:
        engine: twig
    login_route: fos_user_security_login
	seo:
		title_length: 67
    member:
        list:
            layout_template: CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
            members_per_page: 50
            member_since_datetime_format: "d-m-Y - H:i"     
            requires_login: true
    sidebar:
        account_route: ccdn_user_user_account_show
        profile_route: ccdn_user_profile_show
		registration_route: fos_user_registration_register
		login_route: fos_user_security_login
		logout_route: fos_user_security_logout
		reset_route: fos_user_resetting_request

```

- [Return back to the docs index](index.md).
