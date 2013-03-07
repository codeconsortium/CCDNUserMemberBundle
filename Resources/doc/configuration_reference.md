CCDNUser MemberBundle Configuration Reference.
==============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser MemberBundle    
#
ccdn_user_member:
    template:
        engine:               twig
    seo:
        title_length:         67
    member:
        list:
            layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
            members_per_page:     50
            member_since_datetime_format:  d-m-Y - H:i
            requires_login:       true

```

- [Return back to the docs index](index.md).
