@extends('layouts.main_alt')
@section('title') About :: @parent @endsection
@section('content')
<div class="section no-pad-bot pages" id="index-banner">
    <div class="container">
        <div class="row">
            <div class="page-header">
                <div id="contents">
                    <style type="text/css">
                        @import url('https://themes.googleusercontent.com/fonts/css?kit=soa_V42eXREs8LDkwBiWS36Y0zlZjWzuC89-Ii8qbS1bpjdwEzlXNgaHgynMCYRU5Y4ks7hRHI7Iqe6YzXXJxQ');

                        .lst-kix_list_1-3>li:before {
                            content: "\0025cf  "
                        }

                        .lst-kix_list_1-4>li:before {
                            content: "o  "
                        }

                        ul.lst-kix_list_1-0 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-7>li:before {
                            content: "o  "
                        }

                        .lst-kix_list_1-5>li:before {
                            content: "\0025aa  "
                        }

                        .lst-kix_list_1-6>li:before {
                            content: "\0025cf  "
                        }

                        ul.lst-kix_list_1-3 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-0>li:before {
                            content: "\0025cf  "
                        }

                        ul.lst-kix_list_1-4 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-8>li:before {
                            content: "\0025aa  "
                        }

                        ul.lst-kix_list_1-1 {
                            list-style-type: none
                        }

                        ul.lst-kix_list_1-2 {
                            list-style-type: none
                        }

                        ul.lst-kix_list_1-7 {
                            list-style-type: none
                        }

                        .lst-kix_list_1-1>li:before {
                            content: "o  "
                        }

                        .lst-kix_list_1-2>li:before {
                            content: "\0025aa  "
                        }

                        ul.lst-kix_list_1-8 {
                            list-style-type: none
                        }

                        ul.lst-kix_list_1-5 {
                            list-style-type: none
                        }

                        ul.lst-kix_list_1-6 {
                            list-style-type: none
                        }

                        ol {
                            margin: 0;
                            padding: 0
                        }

                        table td,
                        table th {
                            padding: 0
                        }

                        .c5 {
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

                        .c26 {
                            padding-top: 1pt;
                            border-top-width: 0.5pt;
                            border-top-color: #000000;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            border-top-style: solid;
                            widows: 2;
                            text-align: center
                        }

                        .c19 {
                            color: #4f81bd;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c10 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Arial";
                            font-style: normal
                        }

                        .c11 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-size: 11pt;
                            font-family: "Arial Narrow";
                            font-style: normal
                        }

                        .c17 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: center
                        }

                        .c25 {
                            padding-top: 0pt;
                            padding-bottom: 10pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c8 {
                            padding-top: 0pt;
                            padding-bottom: 6pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c0 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c14 {
                            padding-top: 0pt;
                            padding-bottom: 3pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: left
                        }

                        .c28 {
                            padding-top: 0pt;
                            padding-bottom: 8pt;
                            line-height: 1.0;
                            orphans: 2;
                            widows: 2;
                            text-align: center
                        }

                        .c22 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-family: "Arial Narrow";
                            font-style: normal
                        }

                        .c3 {
                            color: #000000;
                            font-weight: 400;
                            text-decoration: none;
                            vertical-align: baseline;
                            font-family: "Calibri";
                            font-style: normal
                        }

                        .c6 {
                            text-decoration-skip-ink: none;
                            -webkit-text-decoration-skip: none;
                            color: #0000ff;
                            text-decoration: underline
                        }

                        .c18 {
                            padding-top: 0pt;
                            padding-bottom: 0pt;
                            line-height: 1.1500000000000001;
                            text-align: left
                        }

                        .c12 {
                            margin-left: -5.4pt;
                            border-spacing: 0;
                            border-collapse: collapse;
                            margin-right: auto
                        }

                        .c30 {
                            background-color: #ffffff;
                            max-width: 504pt;
                            padding: 36pt 54pt 36pt 54pt
                        }

                        .c21 {
                            background-color: #ccecff;
                            margin-left: 36pt;
                            padding-left: 0pt
                        }

                        .c20 {
                            color: inherit;
                            text-decoration: inherit
                        }

                        .c31 {
                            padding: 0;
                            margin: 0
                        }

                        .c13 {
                            color: #4f81bd;
                            font-weight: 700
                        }

                        .c9 {
                            margin-left: 18pt;
                            text-indent: -18pt
                        }

                        .c23 {
                            font-size: 14pt;
                            font-weight: 700
                        }

                        .c7 {
                            font-size: 6pt
                        }

                        .c27 {
                            font-size: 14pt
                        }

                        .c15 {
                            font-style: italic
                        }

                        .c16 {
                            font-size: 8pt
                        }

                        .c32 {
                            font-size: 11pt
                        }

                        .c1 {
                            height: 0pt
                        }

                        .c29 {
                            font-size: 12pt
                        }

                        .c4 {
                            height: 11pt
                        }

                        .c2 {
                            font-size: 10.5pt
                        }

                        .c24 {
                            height: 60pt
                        }

                        .c33 {
                            margin-right: 126pt
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
                        <p class="c17"><span class="c23">Personal Information Protection Policy</span></p>
                        <p class="c4 c26"><span class="c3 c29"></span></p>
                    </div>
                    <p class="c4 c18"><span class="c10"></span></p><a
                        id="t.3816a939849e143cc1011ecf16621321c73ea12b"></a><a id="t.0"></a>
                    <table class="c12">
                        <tbody>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c25"><span class="c2">Lineblocs is committed to safeguarding the personal
                                            information entrusted to us by our customers. We manage your personal
                                            information in accordance with Alberta’s </span><span
                                            class="c15 c2">Personal Information Protection Act</span><span
                                            class="c3 c2">&nbsp;and other applicable laws. This policy outlines the
                                            principles and practices we follow in protecting your personal
                                            information.</span></p>
                                    <p class="c0"><span class="c3 c2">This policy applies to Lineblocs and to any person
                                            providing services on our behalf. A copy of this policy is provided to any
                                            customer on request.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">What is personal information?</span></p>
                                    <p class="c0"><span class="c3 c2">Personal information means information about an
                                            identifiable individual. This includes an individual’s name, home address
                                            and phone number, age, sex, marital or family status, an identifying number,
                                            financial information, educational history, etc.</span></p>
                                    <p class="c0 c4"><span class="c2 c22"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">What personal information do we collect?</span></p>
                                    <p class="c14"><span class="c3 c2">We collect only the personal information that we
                                            need for the purposes of providing services to our clients, including
                                            personal information needed to:</span></p>
                                    <ul class="c31 lst-kix_list_1-0 start">
                                        <li class="c0 c21"><span class="c3 c2">deliver requested products and
                                                services</span></li>
                                        <li class="c0 c21"><span class="c3 c2">provide product or service quotes</span>
                                        </li>
                                        <li class="c8 c21"><span class="c3 c2">send out association membership
                                                information</span></li>
                                    </ul>
                                    <p class="c0"><span class="c3 c2">We normally collect client personal information
                                            directly from our clients. We may collect your information from other
                                            persons with your consent or as authorized by law.</span></p>
                                    <p class="c0 c4 c33"><span class="c11"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We inform our clients, before or at the time of
                                            collecting personal information, of the purposes for which we are collecting
                                            the information. The only time we don’t provide this notification is when a
                                            client volunteers information for an obvious purpose (for example, producing
                                            a credit card to pay a fee when the information will be used only to process
                                            the payment).</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">Consent</span></p>
                                    <p class="c25"><span class="c3 c2">We ask for consent to collect, use or disclose
                                            client personal information, except in specific circumstances where
                                            collection, use or disclosure without consent is authorized or required by
                                            law. We may assume your consent in cases where you volunteer information for
                                            an obvious purpose. </span></p>
                                    <p class="c8"><span class="c3 c2">We assume your consent to continue to use and,
                                            where applicable, disclose personal information that we have already
                                            collected, for the purpose for which the information was collected.</span>
                                    </p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c8 c4"><span class="c3 c7"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We ask for your express consent for some purposes
                                            and may not be able to provide certain services if you are unwilling to
                                            provide consent to the collection, use or disclosure of certain personal
                                            information. Where express consent is needed, we will normally ask clients
                                            to provide their consent orally (by telephone), or in writing (by signing a
                                            consent form).</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">In cases that do not involve sensitive personal
                                            information, we may rely on “opt-out” consent. For example, we may disclose
                                            your contact information to other organizations that we believe may be of
                                            interest to you, unless you request that we do not disclose your
                                            information. You can do this by checking the appropriate box on our
                                            application form or by telephoning our local number/toll-free number.</span>
                                    </p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">A client may withdraw consent to the use and
                                            disclosure of personal information at any time, unless the personal
                                            information is necessary for us to fulfil our legal obligations. We will
                                            respect your decision, but we may not be able to provide you with certain
                                            products and services if we do not have the necessary personal
                                            information.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We may collect, use or disclose client personal
                                            information without consent only as authorized by law. For example, we may
                                            not request consent when the collection, use or disclosure is to determine
                                            suitability for an honour or award, or in an emergency that threatens life,
                                            health or safety.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c24">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">How do we use and disclose personal
                                            information?</span></p>
                                    <p class="c0"><span class="c3 c2">We use and disclose client personal information
                                            only for the purpose, for which the information was collected, except as
                                            authorized by law. For example, we may use client contact information to
                                            deliver services.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c2">If we wish to use or disclose your personal
                                            information for any new business purpose, we will ask for your consent. We
                                            may not seek consent if the law allows this (e.g. the law allows
                                            organizations to use personal information without consent for the purpose of
                                            collecting a debt).</span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">How do we safeguard personal information? </span>
                                    </p>
                                    <p class="c0"><span class="c3 c2">We make every reasonable effort to ensure that
                                            personal information is accurate and complete. We rely on individuals to
                                            notify us if there is a change to their personal information that may affect
                                            their relationship with our organization. If you are aware of an error in
                                            our information about you, please let us know and we will correct it on
                                            request wherever possible. In some cases we may ask for a written request
                                            for correction.</span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We protect personal information in a manner
                                            appropriate for the sensitivity of the information. We make every reasonable
                                            effort to prevent any loss, misuse, disclosure or modification of personal
                                            information, as well as any unauthorized access to personal
                                            information.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We use appropriate security measures when
                                            destroying personal information, including shredding paper records and
                                            permanently deleting electronic records.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We retain personal information only as long as is
                                            reasonable to fulfil the purposes for which the information was collected or
                                            for legal or business purposes.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">Access to records containing personal
                                            information</span></p>
                                    <p class="c0"><span class="c2">Individuals have a right to access their own personal
                                            information in a record that is in the custody or under the control of
                                            Lineblocs, subject to some exceptions. For example, organizations are
                                            required under the </span><span class="c2 c15">Personal Information
                                            Protection Act</span><span class="c3 c2">&nbsp;to refuse to provide access
                                            to information that would reveal personal information about another
                                            individual. </span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">If we refuse a request in whole or in part, we
                                            will provide the reasons for the refusal. In some cases where exceptions to
                                            access apply, we may withhold that information and provide you with the
                                            remainder of the record.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">You may make a request for access to your personal
                                            information by writing to Lineblocs. You must provide sufficient information
                                            in your request to allow us to identify the information you are
                                            seeking.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">You may also request information about our use of
                                            your personal information and any disclosure of that information to persons
                                            outside our organization. In addition, you may request a correction of an
                                            error or omission in your personal information.</span></p>
                                    <p class="c0 c4"><span class="c2 c3"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c3 c2">We will respond to your request within 45 calendar
                                            days, unless an extension is granted. We may charge a reasonable fee to
                                            provide information, but not to make a correction. We do not charge fees
                                            when the request is for personal employee information. We will advise you of
                                            any fees that may apply before beginning to process your request.</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c0"><span class="c13">Questions and complaints</span></p>
                                    <p class="c0"><span class="c3 c2">If you have a question or concern about any
                                            collection, use or disclosure of personal information by Lineblocs, or about
                                            a request for access to your own personal information, please contact Nadir
                                            Hamid, Developer..</span></p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                            <tr class="c1">
                                <td class="c5" colspan="1" rowspan="1">
                                    <p class="c8"><span class="c3 c2">If you are not satisfied with the response you
                                            receive, you should contact the Information and Privacy Commissioner of
                                            Alberta:</span></p>
                                    <p class="c0 c9"><span class="c3 c2">Office of the Information and Privacy
                                            Commissioner of Alberta</span></p>
                                    <p class="c0 c9"><span class="c3 c2">Suite 2460, 801 - 6 Avenue, SW </span></p>
                                    <p class="c0 c9"><span class="c3 c2">Calgary, Alberta &nbsp;T2P 3W2</span></p>
                                    <p class="c0 c9"><span
                                            class="c3 c2">Phone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;403-297-2728
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Toll
                                            Free:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1-888-878-4044</span>
                                    </p>
                                    <p class="c0 c9"><span
                                            class="c2">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                                            class="c6 c2"><a class="c20"
                                                href="mailto:generalinfo@oipc.ab.ca">generalinfo@oipc.ab.ca</a></span><span
                                            class="c2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Website:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span><span class="c2 c6"><a class="c20"
                                                href="https://www.google.com/url?q=http://www.oipc.ab.ca&amp;sa=D&amp;ust=1574745297306000">www.oipc.ab.ca</a></span>
                                    </p>
                                    <p class="c0 c4"><span class="c3 c2"></span></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="c0 c4"><span class="c10"></span></p>
                    <div>
                        <p class="c4 c28"><span class="c3 c32"></span></p>
                        <p class="c0 c4"><span class="c3 c16"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection