@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row">
            <div class="page-header">
                <div id="contents">
                    <style type="text/css">
                        @import url('https://themes.googleusercontent.com/fonts/css?kit=soa_V42eXREs8LDkwBiWS36Y0zlZjWzuC89-Ii8qbS1bpjdwEzlXNgaHgynMCYRUOepmWPH_d25mRxwoXFchsyJvIx7i6R-8--l9gSqQgxY');

                        .lst-kix_list_4-1>li {
                            counter-increment: lst-ctn-kix_list_4-1
                        }

                        ol.lst-kix_list_3-1 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-2 {
                            list-style-type: none
                        }

                        .lst-kix_list_3-1>li {
                            counter-increment: lst-ctn-kix_list_3-1
                        }

                        ol.lst-kix_list_3-3 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-4.start {
                            counter-reset: lst-ctn-kix_list_3-4 0
                        }

                        .lst-kix_list_5-1>li {
                            counter-increment: lst-ctn-kix_list_5-1
                        }

                        ol.lst-kix_list_3-4 {
                            list-style-type: none
                        }

                        .lst-kix_list_2-1>li {
                            counter-increment: lst-ctn-kix_list_2-1
                        }

                        ol.lst-kix_list_3-0 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-1>li {
                            counter-increment: lst-ctn-kix_list_1-1
                        }

                        ol.lst-kix_list_2-6.start {
                            counter-reset: lst-ctn-kix_list_2-6 0
                        }

                        .lst-kix_list_3-0>li:before {
                            content: ""counter(lst-ctn-kix_list_3-0, decimal) ". "
                        }

                        ol.lst-kix_list_3-1.start {
                            counter-reset: lst-ctn-kix_list_3-1 0
                        }

                        .lst-kix_list_3-1>li:before {
                            content: ""counter(lst-ctn-kix_list_3-1, lower-latin) ". "
                        }

                        .lst-kix_list_3-2>li:before {
                            content: ""counter(lst-ctn-kix_list_3-2, lower-roman) ". "
                        }

                        ol.lst-kix_list_1-8.start {
                            counter-reset: lst-ctn-kix_list_1-8 0
                        }

                        .lst-kix_list_4-0>li {
                            counter-increment: lst-ctn-kix_list_4-0
                        }

                        .lst-kix_list_5-0>li {
                            counter-increment: lst-ctn-kix_list_5-0
                        }

                        ol.lst-kix_list_2-3.start {
                            counter-reset: lst-ctn-kix_list_2-3 0
                        }

                        .lst-kix_list_3-5>li:before {
                            content: ""counter(lst-ctn-kix_list_3-5, lower-roman) ". "
                        }

                        .lst-kix_list_3-4>li:before {
                            content: ""counter(lst-ctn-kix_list_3-4, lower-latin) ". "
                        }

                        ol.lst-kix_list_1-5.start {
                            counter-reset: lst-ctn-kix_list_1-5 0
                        }

                        .lst-kix_list_3-3>li:before {
                            content: ""counter(lst-ctn-kix_list_3-3, decimal) ". "
                        }

                        ol.lst-kix_list_3-5 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-6 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-7 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-8 {
                            list-style-type: none
                        }

                        .lst-kix_list_3-8>li:before {
                            content: ""counter(lst-ctn-kix_list_3-8, lower-roman) ". "
                        }

                        .lst-kix_list_2-0>li {
                            counter-increment: lst-ctn-kix_list_2-0
                        }

                        ol.lst-kix_list_5-3.start {
                            counter-reset: lst-ctn-kix_list_5-3 0
                        }

                        .lst-kix_list_2-3>li {
                            counter-increment: lst-ctn-kix_list_2-3
                        }

                        .lst-kix_list_3-6>li:before {
                            content: ""counter(lst-ctn-kix_list_3-6, decimal) ". "
                        }

                        .lst-kix_list_4-3>li {
                            counter-increment: lst-ctn-kix_list_4-3
                        }

                        .lst-kix_list_3-7>li:before {
                            content: ""counter(lst-ctn-kix_list_3-7, lower-latin) ". "
                        }

                        ol.lst-kix_list_4-5.start {
                            counter-reset: lst-ctn-kix_list_4-5 0
                        }

                        ol.lst-kix_list_5-0.start {
                            counter-reset: lst-ctn-kix_list_5-0 1
                        }

                        .lst-kix_list_1-2>li {
                            counter-increment: lst-ctn-kix_list_1-2
                        }

                        ol.lst-kix_list_3-7.start {
                            counter-reset: lst-ctn-kix_list_3-7 0
                        }

                        .lst-kix_list_5-2>li {
                            counter-increment: lst-ctn-kix_list_5-2
                        }

                        ol.lst-kix_list_4-2.start {
                            counter-reset: lst-ctn-kix_list_4-2 0
                        }

                        .lst-kix_list_3-2>li {
                            counter-increment: lst-ctn-kix_list_3-2
                        }

                        ol.lst-kix_list_2-2 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_2-3 {
                            list-style-type: none
                        }

                        .lst-kix_list_5-0>li:before {
                            content: ""counter(lst-ctn-kix_list_5-0, decimal) ". "
                        }

                        ol.lst-kix_list_2-4 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_2-5 {
                            list-style-type: none
                        }

                        .lst-kix_list_5-4>li {
                            counter-increment: lst-ctn-kix_list_5-4
                        }

                        .lst-kix_list_1-4>li {
                            counter-increment: lst-ctn-kix_list_1-4
                        }

                        .lst-kix_list_4-4>li {
                            counter-increment: lst-ctn-kix_list_4-4
                        }

                        ol.lst-kix_list_2-0 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-6.start {
                            counter-reset: lst-ctn-kix_list_1-6 0
                        }

                        ol.lst-kix_list_2-1 {
                            list-style-type: none
                        }

                        .lst-kix_list_4-8>li:before {
                            content: ""counter(lst-ctn-kix_list_4-8, lower-roman) ". "
                        }

                        .lst-kix_list_5-3>li:before {
                            content: ""counter(lst-ctn-kix_list_5-3, decimal) ". "
                        }

                        .lst-kix_list_4-7>li:before {
                            content: ""counter(lst-ctn-kix_list_4-7, lower-latin) ". "
                        }

                        .lst-kix_list_5-2>li:before {
                            content: ""counter(lst-ctn-kix_list_5-2, lower-roman) ". "
                        }

                        .lst-kix_list_5-1>li:before {
                            content: ""counter(lst-ctn-kix_list_5-1, decimal) ". "
                        }

                        .lst-kix_list_5-7>li:before {
                            content: ""counter(lst-ctn-kix_list_5-7, lower-latin) ". "
                        }

                        ol.lst-kix_list_5-6.start {
                            counter-reset: lst-ctn-kix_list_5-6 0
                        }

                        .lst-kix_list_5-6>li:before {
                            content: ""counter(lst-ctn-kix_list_5-6, decimal) ". "
                        }

                        .lst-kix_list_5-8>li:before {
                            content: ""counter(lst-ctn-kix_list_5-8, lower-roman) ". "
                        }

                        ol.lst-kix_list_4-1.start {
                            counter-reset: lst-ctn-kix_list_4-1 0
                        }

                        ol.lst-kix_list_4-8.start {
                            counter-reset: lst-ctn-kix_list_4-8 0
                        }

                        ol.lst-kix_list_3-3.start {
                            counter-reset: lst-ctn-kix_list_3-3 0
                        }

                        .lst-kix_list_5-4>li:before {
                            content: ""counter(lst-ctn-kix_list_5-4, lower-latin) ". "
                        }

                        .lst-kix_list_5-5>li:before {
                            content: ""counter(lst-ctn-kix_list_5-5, lower-roman) ". "
                        }

                        ol.lst-kix_list_2-6 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_2-7 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_2-8 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-0.start {
                            counter-reset: lst-ctn-kix_list_1-0 0
                        }

                        .lst-kix_list_3-0>li {
                            counter-increment: lst-ctn-kix_list_3-0
                        }

                        .lst-kix_list_3-3>li {
                            counter-increment: lst-ctn-kix_list_3-3
                        }

                        ol.lst-kix_list_4-0.start {
                            counter-reset: lst-ctn-kix_list_4-0 0
                        }

                        .lst-kix_list_3-6>li {
                            counter-increment: lst-ctn-kix_list_3-6
                        }

                        .lst-kix_list_2-5>li {
                            counter-increment: lst-ctn-kix_list_2-5
                        }

                        .lst-kix_list_2-8>li {
                            counter-increment: lst-ctn-kix_list_2-8
                        }

                        ol.lst-kix_list_3-2.start {
                            counter-reset: lst-ctn-kix_list_3-2 0
                        }

                        ol.lst-kix_list_5-5.start {
                            counter-reset: lst-ctn-kix_list_5-5 0
                        }

                        .lst-kix_list_2-2>li {
                            counter-increment: lst-ctn-kix_list_2-2
                        }

                        ol.lst-kix_list_2-4.start {
                            counter-reset: lst-ctn-kix_list_2-4 0
                        }

                        ol.lst-kix_list_4-7.start {
                            counter-reset: lst-ctn-kix_list_4-7 0
                        }

                        ol.lst-kix_list_1-3 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_5-0 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-4 {
                            list-style-type: none
                        }

                        .lst-kix_list_2-6>li:before {
                            content: ""counter(lst-ctn-kix_list_2-6, decimal) ". "
                        }

                        .lst-kix_list_2-7>li:before {
                            content: ""counter(lst-ctn-kix_list_2-7, lower-latin) ". "
                        }

                        .lst-kix_list_2-7>li {
                            counter-increment: lst-ctn-kix_list_2-7
                        }

                        .lst-kix_list_3-7>li {
                            counter-increment: lst-ctn-kix_list_3-7
                        }

                        ol.lst-kix_list_5-1 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-5 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_5-2 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-6 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-0 {
                            list-style-type: none
                        }

                        .lst-kix_list_2-4>li:before {
                            content: ""counter(lst-ctn-kix_list_2-4, lower-latin) ". "
                        }

                        .lst-kix_list_2-5>li:before {
                            content: ""counter(lst-ctn-kix_list_2-5, lower-roman) ". "
                        }

                        .lst-kix_list_2-8>li:before {
                            content: ""counter(lst-ctn-kix_list_2-8, lower-roman) ". "
                        }

                        ol.lst-kix_list_1-1 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-2 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_5-4.start {
                            counter-reset: lst-ctn-kix_list_5-4 0
                        }

                        ol.lst-kix_list_4-6.start {
                            counter-reset: lst-ctn-kix_list_4-6 0
                        }

                        ol.lst-kix_list_5-1.start {
                            counter-reset: lst-ctn-kix_list_5-1 0
                        }

                        ol.lst-kix_list_3-0.start {
                            counter-reset: lst-ctn-kix_list_3-0 0
                        }

                        ol.lst-kix_list_5-7 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_5-8 {
                            list-style-type: none
                        }

                        .lst-kix_list_5-7>li {
                            counter-increment: lst-ctn-kix_list_5-7
                        }

                        ol.lst-kix_list_4-3.start {
                            counter-reset: lst-ctn-kix_list_4-3 0
                        }

                        ol.lst-kix_list_5-3 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_1-7 {
                            list-style-type: none
                        }

                        .lst-kix_list_4-7>li {
                            counter-increment: lst-ctn-kix_list_4-7
                        }

                        ol.lst-kix_list_5-4 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-7>li {
                            counter-increment: lst-ctn-kix_list_1-7
                        }

                        ol.lst-kix_list_1-8 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_3-8.start {
                            counter-reset: lst-ctn-kix_list_3-8 0
                        }

                        ol.lst-kix_list_5-5 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_5-6 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_2-5.start {
                            counter-reset: lst-ctn-kix_list_2-5 0
                        }

                        .lst-kix_list_5-8>li {
                            counter-increment: lst-ctn-kix_list_5-8
                        }

                        .lst-kix_list_4-0>li:before {
                            content: ""counter(lst-ctn-kix_list_4-0, decimal) ". "
                        }

                        .lst-kix_list_2-6>li {
                            counter-increment: lst-ctn-kix_list_2-6
                        }

                        .lst-kix_list_3-8>li {
                            counter-increment: lst-ctn-kix_list_3-8
                        }

                        .lst-kix_list_4-1>li:before {
                            content: ""counter(lst-ctn-kix_list_4-1, decimal) ". "
                        }

                        .lst-kix_list_4-6>li {
                            counter-increment: lst-ctn-kix_list_4-6
                        }

                        ol.lst-kix_list_1-7.start {
                            counter-reset: lst-ctn-kix_list_1-7 0
                        }

                        .lst-kix_list_4-4>li:before {
                            content: ""counter(lst-ctn-kix_list_4-4, lower-latin) ". "
                        }

                        ol.lst-kix_list_2-2.start {
                            counter-reset: lst-ctn-kix_list_2-2 0
                        }

                        .lst-kix_list_1-5>li {
                            counter-increment: lst-ctn-kix_list_1-5
                        }

                        .lst-kix_list_4-3>li:before {
                            content: ""counter(lst-ctn-kix_list_4-3, decimal) ". "
                        }

                        .lst-kix_list_4-5>li:before {
                            content: ""counter(lst-ctn-kix_list_4-5, lower-roman) ". "
                        }

                        .lst-kix_list_4-2>li:before {
                            content: ""counter(lst-ctn-kix_list_4-2, lower-roman) ". "
                        }

                        .lst-kix_list_4-6>li:before {
                            content: ""counter(lst-ctn-kix_list_4-6, decimal) ". "
                        }

                        ol.lst-kix_list_5-7.start {
                            counter-reset: lst-ctn-kix_list_5-7 0
                        }

                        .lst-kix_list_1-8>li {
                            counter-increment: lst-ctn-kix_list_1-8
                        }

                        ol.lst-kix_list_1-4.start {
                            counter-reset: lst-ctn-kix_list_1-4 0
                        }

                        .lst-kix_list_5-5>li {
                            counter-increment: lst-ctn-kix_list_5-5
                        }

                        .lst-kix_list_3-5>li {
                            counter-increment: lst-ctn-kix_list_3-5
                        }

                        ol.lst-kix_list_1-1.start {
                            counter-reset: lst-ctn-kix_list_1-1 0
                        }

                        ol.lst-kix_list_4-0 {
                            list-style-type: none
                        }

                        .lst-kix_list_3-4>li {
                            counter-increment: lst-ctn-kix_list_3-4
                        }

                        ol.lst-kix_list_4-1 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_4-4.start {
                            counter-reset: lst-ctn-kix_list_4-4 0
                        }

                        ol.lst-kix_list_4-2 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_4-3 {
                            list-style-type: none
                        }

                        .lst-kix_list_2-4>li {
                            counter-increment: lst-ctn-kix_list_2-4
                        }

                        ol.lst-kix_list_3-6.start {
                            counter-reset: lst-ctn-kix_list_3-6 0
                        }

                        .lst-kix_list_5-3>li {
                            counter-increment: lst-ctn-kix_list_5-3
                        }

                        ol.lst-kix_list_1-3.start {
                            counter-reset: lst-ctn-kix_list_1-3 0
                        }

                        ol.lst-kix_list_2-8.start {
                            counter-reset: lst-ctn-kix_list_2-8 0
                        }

                        ol.lst-kix_list_1-2.start {
                            counter-reset: lst-ctn-kix_list_1-2 0
                        }

                        ol.lst-kix_list_4-8 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-0>li:before {
                            content: ""counter(lst-ctn-kix_list_1-0, decimal) ". "
                        }

                        ol.lst-kix_list_4-4 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_4-5 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-1>li:before {
                            content: ""counter(lst-ctn-kix_list_1-1, lower-latin) ". "
                        }

                        .lst-kix_list_1-2>li:before {
                            content: ""counter(lst-ctn-kix_list_1-2, lower-roman) ". "
                        }

                        ol.lst-kix_list_2-0.start {
                            counter-reset: lst-ctn-kix_list_2-0 0
                        }

                        ol.lst-kix_list_4-6 {
                            list-style-type: none
                        }

                        ol.lst-kix_list_4-7 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-3>li:before {
                            content: ""counter(lst-ctn-kix_list_1-3, decimal) ". "
                        }

                        .lst-kix_list_1-4>li:before {
                            content: ""counter(lst-ctn-kix_list_1-4, lower-latin) ". "
                        }

                        ol.lst-kix_list_3-5.start {
                            counter-reset: lst-ctn-kix_list_3-5 0
                        }

                        .lst-kix_list_1-0>li {
                            counter-increment: lst-ctn-kix_list_1-0
                        }

                        .lst-kix_list_4-8>li {
                            counter-increment: lst-ctn-kix_list_4-8
                        }

                        .lst-kix_list_1-6>li {
                            counter-increment: lst-ctn-kix_list_1-6
                        }

                        .lst-kix_list_1-7>li:before {
                            content: ""counter(lst-ctn-kix_list_1-7, lower-latin) ". "
                        }

                        ol.lst-kix_list_5-8.start {
                            counter-reset: lst-ctn-kix_list_5-8 0
                        }

                        ol.lst-kix_list_2-7.start {
                            counter-reset: lst-ctn-kix_list_2-7 0
                        }

                        .lst-kix_list_1-3>li {
                            counter-increment: lst-ctn-kix_list_1-3
                        }

                        .lst-kix_list_1-5>li:before {
                            content: ""counter(lst-ctn-kix_list_1-5, lower-roman) ". "
                        }

                        .lst-kix_list_1-6>li:before {
                            content: ""counter(lst-ctn-kix_list_1-6, decimal) ". "
                        }

                        .lst-kix_list_5-6>li {
                            counter-increment: lst-ctn-kix_list_5-6
                        }

                        .lst-kix_list_2-0>li:before {
                            content: ""counter(lst-ctn-kix_list_2-0, decimal) ". "
                        }

                        .lst-kix_list_2-1>li:before {
                            content: ""counter(lst-ctn-kix_list_2-1, lower-latin) ". "
                        }

                        ol.lst-kix_list_2-1.start {
                            counter-reset: lst-ctn-kix_list_2-1 0
                        }

                        .lst-kix_list_4-5>li {
                            counter-increment: lst-ctn-kix_list_4-5
                        }

                        .lst-kix_list_1-8>li:before {
                            content: ""counter(lst-ctn-kix_list_1-8, lower-roman) ". "
                        }

                        .lst-kix_list_2-2>li:before {
                            content: ""counter(lst-ctn-kix_list_2-2, lower-roman) ". "
                        }

                        .lst-kix_list_2-3>li:before {
                            content: ""counter(lst-ctn-kix_list_2-3, decimal) ". "
                        }

                        .lst-kix_list_4-2>li {
                            counter-increment: lst-ctn-kix_list_4-2
                        }

                        ol.lst-kix_list_5-2.start {
                            counter-reset: lst-ctn-kix_list_5-2 0
                        }

                        ol {
                            margin: 0;
                            padding: 0
                        }

                        table td,
                        table th {
                            padding: 0
                        }

                        .c2 {
                            border-right-style: solid;
                            padding: 0pt 5.4pt 0pt 5.4pt;
                            border-bottom-color: #000000;
                            border-top-width: 0pt;
                            border-right-width: 0pt;
                            border-left-color: #000000;
                            vertical-align: top;
                            border-right-color: #000000;
                            border-left-width: 0pt;
                            border-top-style: solid;
                            border-left-style: solid;
                            border-bottom-width: 0pt;
                            width: 496.5pt;
                            border-top-color: #000000;
                            border-bottom-style: solid
                        }

                        .c17 {
                            padding-top: 1pt;
                            border-top-width: 0.5pt;
                            border-top-color: #000000;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            border-top-style: solid;
                            widows: 2;
                            text-align: center;
                            height: 11pt
                        }

                        .c29 {
                            background-color: #ccffcc;
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Arial Narrow";
                            font-style: normal
                        }

                        .c3 {
                            margin-left: 36pt;
                            padding-top: 0pt;
                            padding-left: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c6 {
                            margin-left: 72pt;
                            padding-top: 0pt;
                            padding-left: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c23 {
                            background-color: #99ccff;
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 14pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c18 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 10.5pt;
                            font-family: "Arial Narrow";
                            font-style: normal
                        }

                        .c10 {
                            color: #4f81bd;
                            font-weight: 700;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c20 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Arial";
                            font-style: normal
                        }

                        .c13 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11.5pt;
                            font-family: "Roboto";
                            font-style: normal
                        }

                        .c0 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left;
                            height: 11pt
                        }

                        .c27 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 14pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c28 {
                            padding-top: 0pt;
                            padding-bottom: 8pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: center;
                            height: 11pt
                        }

                        .c22 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 12pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c5 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 6pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c25 {
                            padding-top: 0pt;
                            padding-bottom: 6pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left;
                            height: 11pt
                        }

                        .c1 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 10.5pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c4 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c12 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 8pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c21 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: center
                        }

                        .c7 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c15 {
                            margin-left: -5.4pt;
                            border-spacing: 0;
                            border-collapse: collapse;
                            margin-right: auto
                        }

                        .c24 {
                            background-color: #ffffff;
                            max-width: 504pt;
                            padding: 36pt 54pt 36pt 54pt
                        }

                        .c31 {
                            font-size: 14pt;
                            font-weight: 700
                        }

                        .c9 {
                            padding: 0;
                            margin: 0
                        }

                        .c16 {
                            color: inherit;
                            text-decoration: inherit
                        }

                        .c14 {
                            color: #1155cc
                        }

                        .c26 {
                            color: #039be5
                        }

                        .c8 {
                            height: 0pt
                        }

                        .c19 {
                            margin-right: 126pt
                        }

                        .c30 {
                            background-color: #ccffcc
                        }

                        .c11 {
                            height: 60pt
                        }

                        .title {
                            padding-top: 24pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 36pt;
                            padding-bottom: 6pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .subtitle {
                            padding-top: 18pt;
                            color: #666666;
                            font-size: 24pt;
                            padding-bottom: 4pt;
                            font-family: "Georgia";
                            line-height: 1.0;
                            page-break-after: avoid;
                            font-style: italic;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        li {
                            color: #000000;
                            font-size: 11pt;
                            font-family: "Calibri"
                        }

                        p {
                            margin: 0;
                            color: #000000;
                            font-size: 11pt;
                            font-family: "Calibri"
                        }

                        h1 {
                            padding-top: 24pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 24pt;
                            padding-bottom: 6pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        h2 {
                            padding-top: 18pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 18pt;
                            padding-bottom: 4pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        h3 {
                            padding-top: 10pt;
                            color: #4f81bd;
                            font-weight: 700;
                            font-size: 11pt;
                            padding-bottom: 0pt;
                            font-family: "Cambria";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        h4 {
                            padding-top: 12pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 12pt;
                            padding-bottom: 2pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        h5 {
                            padding-top: 11pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 11pt;
                            padding-bottom: 2pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        h6 {
                            padding-top: 10pt;
                            color: #000000;
                            font-weight: 700;
                            font-size: 10pt;
                            padding-bottom: 2pt;
                            font-family: "Calibri";
                            line-height: 1.0;
                            page-break-after: avoid;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }
                    </style>
                    <div>
                        <p class="c21"><span class="c31">Terms Of Service</span></p>
                        <p class="c17"><span class="c22"></span></p>
                    </div>
                    <p class="c25"><span class="c20"></span></p><a
                        id="t.0c17bc51f566b91548dff186201a3f4fa446fd4d"></a><a id="t.0"></a>
                    <table class="c15">
                        <tbody>
                            <tr class="c8">
                                <td class="c2" colspan="1" rowspan="1">
                                    <p class="c7"><span class="c4">These terms and conditions outline the rules and
                                            regulations for the use of Lineblocs's Website.</span></p>
                                    <p class="c25"><span class="c13"></span></p>
                                    <p class="c7"><span class="c4">By accessing this website we assume you accept these
                                            terms and conditions in full. Do not continue to use Lineblocs's website if
                                            you do not accept all of the terms and conditions stated on this
                                            page.</span></p>
                                    <p class="c7"><span class="c4">The following terminology applies to these Terms and
                                            Conditions, Privacy Statement and Disclaimer Notice and any or all
                                            Agreements: "Client", "You" and "Your" refers to you, the person accessing
                                            this website and accepting the Company's terms and conditions. "The
                                            Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party",
                                            "Parties", or "Us", refers to both the Client and ourselves, or either the
                                            Client or ourselves. All terms refer to the offer, acceptance and
                                            consideration of payment necessary to undertake the process of our
                                            assistance to the Client in the most appropriate manner, whether by formal
                                            meetings of a fixed duration, or any other means, for the express purpose of
                                            meeting the Client's needs in respect of provision of the Company's stated
                                            services/products, in accordance with and subject to, prevailing law of
                                            Canada. Any use of the above terminology or other words in the singular,
                                            plural, capitalisation and/or he/she or they, are taken as interchangeable
                                            and therefore as referring to same.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Cookies</span></p>
                                    <p class="c7"><span class="c4">We employ the use of cookies. By using Lineblocs's
                                            website you consent to the use of cookies in accordance with Lineblocs's
                                            privacy policy.</span></p>
                                    <p class="c7"><span class="c4">Most of the modern day interactive web sites use
                                            cookies to enable us to retrieve user details for each visit. Cookies are
                                            used in some areas of our site to enable the functionality of this area and
                                            ease of use for those people visiting. Some of our affiliate / advertising
                                            partners may also use cookies.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">License</span></p>
                                    <p class="c7"><span class="c4">Unless otherwise stated, Lineblocs and/or it's
                                            licensors own the intellectual property rights for all material on
                                            Lineblocs. All intellectual property rights are reserved. You may view
                                            and/or print pages from http://lineblocs.com for your own personal use
                                            subject to restrictions set in these terms and conditions.</span></p>
                                    <p class="c7"><span class="c4">You must not:</span></p>
                                    <ol class="c9 lst-kix_list_3-0 start" start="1">
                                        <li class="c3"><span>Republish material from http://lineblocs.com</span></li>
                                        <li class="c3"><span>Sell, rent or sub-license material from
                                                http://lineblocs.com</span></li>
                                        <li class="c3"><span>Reproduce, duplicate or copy material from
                                                http://lineblocs.com</span></li>
                                    </ol>
                                    <p class="c7"><span class="c4">Redistribute content from Lineblocs (unless content
                                            is specifically made for redistribution).</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Hyperlinking to our Content</span></p>
                                    <ol class="c9 lst-kix_list_4-0 start" start="1">
                                        <li class="c3"><span>The following organizations may link to our Web site
                                                without prior written approval:</span></li>
                                    </ol>
                                    <ol class="c9 lst-kix_list_4-1 start" start="1">
                                        <li class="c6"><span class="c4">Government agencies;</span></li>
                                        <li class="c6"><span class="c4">Search engines;</span></li>
                                        <li class="c6"><span class="c4">News organizations;</span></li>
                                        <li class="c6"><span class="c4">Online directory distributors when they list us
                                                in the directory may link to our Web site in the same manner as they
                                                hyperlink to the Web sites of other listed businesses; and</span></li>
                                        <li class="c6"><span class="c4">Systemwide Accredited Businesses except
                                                soliciting non-profit organizations, charity shopping malls, and charity
                                                fundraising groups which may not hyperlink to our Web site.</span></li>
                                    </ol>
                                    <ol class="c9 lst-kix_list_5-0 start" start="2">
                                        <li class="c3"><span>These organizations may link to our home page, to
                                                publications or to other Web site information so long as the link: (a)
                                                is not in any way misleading; (b) does not falsely imply sponsorship,
                                                endorsement or approval of the linking party and its products or
                                                services; and (c) fits within the context of the linking party's
                                                site.</span></li>
                                        <li class="c3"><span>We may consider and approve in our sole discretion other
                                                link requests from the following types of organizations:</span></li>
                                    </ol>
                                    <ol class="c9 lst-kix_list_5-1 start" start="1">
                                        <li class="c6"><span class="c4">commonly-known consumer and/or business
                                                information sources such as Chambers of Commerce, American Automobile
                                                Association, AARP and Consumers Union;</span></li>
                                        <li class="c6"><span class="c4">dot.com community sites;</span></li>
                                        <li class="c6"><span class="c4">associations or other groups representing
                                                charities, including charity giving sites,</span></li>
                                        <li class="c6"><span class="c4">online directory distributors;</span></li>
                                        <li class="c6"><span class="c4">internet portals;</span></li>
                                        <li class="c6"><span class="c4">accounting, law and consulting firms whose
                                                primary clients are businesses; and</span></li>
                                        <li class="c6"><span class="c4">educational institutions and trade
                                                associations.</span></li>
                                    </ol>
                                    <p class="c7"><span class="c4">We will approve link requests from these
                                            organizations if we determine that: (a) the link would not reflect
                                            unfavorably on us or our accredited businesses (for example, trade
                                            associations or other organizations representing inherently suspect types of
                                            business, such as work-at-home opportunities, shall not be allowed to link);
                                            (b)the organization does not have an unsatisfactory record with us; (c) the
                                            benefit to us from the visibility associated with the hyperlink outweighs
                                            the absence of Lineblocs; and (d) where the link is in the context of
                                            general resource information or is otherwise consistent with editorial
                                            content in a newsletter or similar product furthering the mission of the
                                            organization.</span></p>
                                    <p class="c7"><span class="c4">These organizations may link to our home page, to
                                            publications or to other Web site information so long as the link: (a) is
                                            not in any way misleading; (b) does not falsely imply sponsorship,
                                            endorsement or approval of the linking party and it products or services;
                                            and (c) fits within the context of the linking party's site.</span></p>
                                    <p class="c7"><span>If you are among the organizations listed in paragraph 2 above
                                            and are interested in linking to our website, you must notify us by sending
                                            an e-mail to </span><span class="c26">contact@lineblocs.com</span><span
                                            class="c4">. Please include your name, your organization name, contact
                                            information (such as a phone number and/or e-mail address) as well as the
                                            URL of your site, a list of any URLs from which you intend to link to our
                                            Web site, and a list of the URL(s) on our site to which you would like to
                                            link. Allow 2-3 weeks for a response.</span></p>
                                    <p class="c7"><span class="c4">Approved organizations may hyperlink to our Web site
                                            as follows:</span></p>
                                    <ol class="c9 lst-kix_list_1-0 start" start="1">
                                        <li class="c3"><span>By use of our corporate name; or</span></li>
                                        <li class="c3"><span>By use of the uniform resource locator (Web address) being
                                                linked to; or</span></li>
                                        <li class="c3"><span>By use of any other description of our Web site or material
                                                being linked to that makes sense within the context and format of
                                                content on the linking party's site.</span></li>
                                    </ol>
                                    <p class="c7"><span class="c4">No use of Lineblocs's logo or other artwork will be
                                            allowed for linking absent a trademark license agreement.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Iframes</span></p>
                                    <p class="c7"><span class="c4">Without prior approval and express written
                                            permission, you may not create frames around our Web pages or use other
                                            techniques that alter in any way the visual presentation or appearance of
                                            our Web site.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Reservation of Rights</span></p>
                                    <p class="c7"><span class="c4">We reserve the right at any time and in its sole
                                            discretion to request that you remove all links or any particular link to
                                            our Web site. You agree to immediately remove all links to our Web site upon
                                            such request. We also reserve the right to amend these terms and conditions
                                            and its linking policy at any time. By continuing to link to our Web site,
                                            you agree to be bound to and abide by these linking terms and
                                            conditions.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Removal of links from our website</span></p>
                                    <p class="c7"><span class="c4">If you find any link on our Web site or any linked
                                            web site objectionable for any reason, you may contact us about this. We
                                            will consider requests to remove links but will have no obligation to do so
                                            or to respond directly to you.</span></p>
                                    <p class="c7"><span class="c4">Whilst we endeavour to ensure that the information on
                                            this website is correct, we do not warrant its completeness or accuracy; nor
                                            do we commit to ensuring that the website remains available or that the
                                            material on the website is kept up to date.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Content Liability</span></p>
                                    <p class="c7"><span class="c4">We shall have no responsibility or liability for any
                                            content appearing on your Web site. You agree to indemnify and defend us
                                            against all claims arising out of or based upon your Website. No link(s) may
                                            appear on any page on your Web site or within any context containing content
                                            or materials that may be interpreted as libelous, obscene or criminal, or
                                            which infringes, otherwise violates, or advocates the infringement or other
                                            violation of, any third party rights.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Disclaimer</span></p>
                                    <p class="c7"><span class="c4">To the maximum extent permitted by applicable law, we
                                            exclude all representations, warranties and conditions relating to our
                                            website and the use of this website (including, without limitation, any
                                            warranties implied by law in respect of satisfactory quality, fitness for
                                            purpose and/or the use of reasonable care and skill). Nothing in this
                                            disclaimer will:</span></p>
                                    <ol class="c9 lst-kix_list_2-0 start" start="1">
                                        <li class="c3"><span>limit or exclude our or your liability for death or
                                                personal injury resulting from negligence;</span></li>
                                        <li class="c3"><span>limit or exclude our or your liability for fraud or
                                                fraudulent misrepresentation;</span></li>
                                        <li class="c3"><span>limit any of our or your liabilities in any way that is not
                                                permitted under applicable law; or</span></li>
                                        <li class="c3"><span>exclude any of our or your liabilities that may not be
                                                excluded under applicable law.</span></li>
                                    </ol>
                                    <p class="c7"><span class="c4">The limitations and exclusions of liability set out
                                            in this Section and elsewhere in this disclaimer: (a) are subject to the
                                            preceding paragraph; and (b) govern all liabilities arising under the
                                            disclaimer or in relation to the subject matter of this disclaimer,
                                            including liabilities arising in contract, in tort (including negligence)
                                            and for breach of statutory duty.</span></p>
                                    <p class="c7"><span class="c4">To the extent that the website and the information
                                            and services on the website are provided free of charge, we will not be
                                            liable for any loss or damage of any nature.</span></p>
                                    <p class="c0"><span class="c4"></span></p>
                                    <p class="c7"><span class="c10">Credit &amp; Contact Information</span></p>
                                    <p class="c7"><span>This Terms and conditions page was created at </span><span
                                            class="c14"><a class="c16"
                                                href="https://www.google.com/url?q=https://termsandconditionstemplate.com/&amp;sa=D&amp;ust=1574745493109000">termsandconditionstemplate.com</a></span><span>&nbsp;generator.
                                            If you have any queries regarding any of our terms, please contact us</span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="c0"><span class="c20"></span></p>
                    <div>
                        <p class="c28"><span class="c4"></span></p>
                        <p class="c0"><span class="c12"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection