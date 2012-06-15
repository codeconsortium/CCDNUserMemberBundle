CCDNUser MemberBundle Configuration Reference.
==============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser MemberBundle    
#
ccdn_user_member:
    user:
        profile_route: cc_profile_show_by_id 
    template:
        engine: twig
    login_route: fos_user_security_login
    member:
        list:
#            layout_template: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
#            members_per_page: 50
#            member_since_datetime_format: "d-m-Y - H:i"     
            requires_login: false
    sidebar:
        account_route: cc_user_account_show
        profile_route: cc_profile_show

```

- [Return back to the docs index](index.md).
