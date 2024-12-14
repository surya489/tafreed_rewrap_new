<?php
    //Community Showcase URL Params Rule
    add_action('init', function() {

        $pagenameList = array('resources/community-showcase','examples-of-work'); // Page List

        foreach($pagenameList as $pagename){
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]&taxonomyfeaturename=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]&taxonomyfeaturename=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]&taxonomyfeaturename=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]&taxonomyfeaturename=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]taxonomyfeaturename=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]&taxonomyfeaturename=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&searchkey=$matches[9]&searchvalue=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]taxonomyfeaturename=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&searchkey=$matches[9]&searchvalue=$matches[10]&urlpage=$matches[11]&urlpagenumber=$matches[12]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(feature|challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&taxonomyfeature=$matches[5]taxonomyfeaturename=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            //Industry Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );

            //Type Filter
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );

            //Feature Filter
            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5}&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );


            //Industry&Type Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matches[5]searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]searchvalue=$matche[7]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]searchvalue=$matche[7]&urlpage=$matches[8]&urlpagenumber=$matches[9]',
                'top' );

            //Industry&Feature Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matche[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            //Type&Feature Filter
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matche[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matche[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]&searchvalue=$matches[7]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(feature|challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]&searchvalue=$matches[7]&urlpage=$matches[8]&urlpagenumber=$matches[9]',
                'top' );
        }

    });

    //Customer Success Story URL Params Rule
    add_action('init', function() {

        $pagenameList = array('home/customer-success-stories','case-studies'); // Page List

        foreach($pagenameList as $pagename){
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&searchkey=$matches[9]&searchvalue=$matches[10]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&orderby=$matches[7]&orderbyvalue=$matches[8]&searchkey=$matches[9]&searchvalue=$matches[10]&urlpage=$matches[11]&urlpagenumber=$matches[12]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]taxonomyfeaturename=$matches[4]&taxonomytype=$matches[5]&taxonomyname=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random|random)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            //Industry Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );

            //Type Filter
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );

            //Feature Filter
            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5}&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );


            //Industry&Type Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matches[5]searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]searchvalue=$matche[7]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[6]searchvalue=$matche[7]&urlpage=$matches[8]&urlpagenumber=$matches[9]',
                'top' );

            //Industry&Feature Filter
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(industry)/([^/]*)/(challenge)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyindustry=$matches[1]&taxonomyindustryname=$matches[2]&taxonomyfeature=$matches[3]&taxonomyfeaturename=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matche[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );

            //Type&Feature Filter
            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matche[5]&searchvalue=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&searchkey=$matche[5]&searchvalue=$matches[6]&urlpage=$matches[7]&urlpagenumber=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]',
                'top' );
    
            add_rewrite_rule(
                $pagename.'/(challenge)/([^/]*)/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomyfeature=$matches[1]&taxonomyfeaturename=$matches[2]&taxonomytype=$matches[3]&taxonomyname=$matches[4]&orderby=$matches[5]&orderbyvalue=$matches[6]&searchkey=$matches[7]&searchvalue=$matches[8]&urlpage=$matches[9]&urlpagenumber=$matches[10]',
                'top' );
        }

    });


    //Templates URL Params Rule
    add_action('init', function() {

        $pagenameList = array('resources/templates','templates'); // Page List

        foreach($pagenameList as $pagename){

            //Type Filter
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]',
                'top' );
            add_rewrite_rule(
                $pagename.'/(type)/([^/]*)/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&taxonomytype=$matches[1]&taxonomyname=$matches[2]&orderby=$matches[3]&orderbyvalue=$matches[4]&searchkey=$matches[5]&searchvalue=$matches[6]&urlpage=$matches[7]urlpagenumber=$matches[8]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&searchkey=$matches[1]&searchvalue=$matches[2]&urlpage=$matches[3]&urlpagenumber=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]',
                'top' );

            add_rewrite_rule(
                $pagename.'/(orderby)/(asc|desc|alphabetical|random)/(search)/([^/]*)/(page)/([0-9]+)/?$',
                'index.php?pagename='.$pagename.'&orderby=$matches[1]&orderbyvalue=$matches[2]&searchkey=$matches[3]&searchvalue=$matches[4]&urlpage=$matches[5]&urlpagenumber=$matches[6]',
                'top' );
        }
    });

    add_filter('query_vars', function( $vars ){
        $vars[] = 'taxonomytype';
        $vars[] = 'taxonomyname';
        $vars[] = 'urlpage';
        $vars[] = 'urlpagenumber';
        $vars[] = 'orderby';
        $vars[] = 'orderbyvalue';
        $vars[] = 'searchkey';
        $vars[] = 'searchvalue';
        $vars[] = 'taxonomytopic';
        $vars[] = 'taxonomytopicname';
        $vars[] = 'taxonomyindustry';
        $vars[] = 'taxonomyindustryname';
        $vars[] = 'taxonomyfeature';
        $vars[] = 'taxonomyfeaturename';
        return $vars;
    });
?>