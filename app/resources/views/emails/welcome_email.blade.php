@extends('emails.layouts.alert_email')
@section('title') Welcome @parent @endsection
@section('content')
<tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <table
                                align="center"
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="row-content stack"
                                role="presentation"
                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000; width: 680px; margin: 0 auto;"
                                width="680"
                            >
                                <tbody>
                                    <tr>
                                        <td
                                            class="column column-1"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="100%"
                                        >
                                            <table
                                                border="0"
                                                cellpadding="10"
                                                cellspacing="0"
                                                class="paragraph_block block-1"
                                                role="presentation"
                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                width="100%"
                                            >
                                                <tr>
                                                    <td class="pad">
                                                        <div
                                                            style="
                                                                color: #101112;
                                                                direction: ltr;
                                                                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                                                                font-size: 16px;
                                                                font-weight: 400;
                                                                letter-spacing: 0px;
                                                                line-height: 120%;
                                                                text-align: left;
                                                                mso-line-height-alt: 19.2px;
                                                            "
                                                        ></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <table
                                align="center"
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="row-content stack"
                                role="presentation"
                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000; width: 680px; margin: 0 auto;"
                                width="680"
                            >
                                <tbody>
                                    <tr>
                                        <td
                                            class="column column-1"
                                            style="
                                                mso-table-lspace: 0pt;
                                                mso-table-rspace: 0pt;
                                                font-weight: 400;
                                                text-align: left;
                                                padding-bottom: 20px;
                                                padding-top: 20px;
                                                vertical-align: top;
                                                border-top: 0px;
                                                border-right: 0px;
                                                border-bottom: 0px;
                                                border-left: 0px;
                                            "
                                            width="100%"
                                        >
                                            <table
                                                border="0"
                                                cellpadding="0"
                                                cellspacing="0"
                                                class="paragraph_block block-1"
                                                role="presentation"
                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                width="100%"
                                            >
                                                <tr>
                                                    <td class="pad" style="padding-bottom: 10px; padding-left: 30px; padding-right: 30px; padding-top: 10px;">
                                                        <div style="color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 16px; line-height: 150%; text-align: left; mso-line-height-alt: 24px;">
                                                            <p style="margin: 0; word-break: break-word;">
                                                                <span>
                                                                <h5>{{$user->getName()}}, welcome to {{ $site_name }}!</h5>
                                                                </span>
                                                            </p>
                                                            <p style="margin: 10px 0; word-break: break-word;">
                                                                We're excited to have you on board. To get started, <a href="https://lineblocs.com/" style="color: #3f51b5; text-decoration: underline;">review our site here</a> to learn more about what we offer.
                                                            </p>
                                                            <p style="margin: 10px 0; word-break: break-word;">
                                                                You can also <a href="https://lineblocs.com/resources" style="color: #3f51b5; text-decoration: underline;">view our resources</a> to discover how to use the app effectively.
                                                            </p>
                                                            <p style="margin: 0; word-break: break-word;"></p>
                                                            <p style="margin: 0; word-break: break-word;">
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <table
                                align="center"
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="row-content stack"
                                role="presentation"
                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5d77a9; color: #000; width: 680px; margin: 0 auto;"
                                width="680"
                            >
                                <tbody>
                                    <tr>
                                        <td
                                            class="column column-1"
                                            style="
                                                mso-table-lspace: 0pt;
                                                mso-table-rspace: 0pt;
                                                font-weight: 400;
                                                text-align: left;
                                                padding-bottom: 5px;
                                                padding-top: 5px;
                                                vertical-align: top;
                                                border-top: 0px;
                                                border-right: 0px;
                                                border-bottom: 0px;
                                                border-left: 0px;
                                            "
                                            width="100%"
                                        >
                                            <div class="spacer_block block-1" style="height: 20px; line-height: 20px; font-size: 1px;"></div>
                                            <table
                                                border="0"
                                                cellpadding="10"
                                                cellspacing="0"
                                                class="paragraph_block block-3"
                                                role="presentation"
                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                width="100%"
                                            >
                                                <tr>
                                                    <td class="pad">
                                                        <div
                                                            style="
                                                                color: #f9f9f9;
                                                                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                                                                font-size: 12px;
                                                                font-weight: 400;
                                                                line-height: 150%;
                                                                text-align: center;
                                                                mso-line-height-alt: 18px;
                                                            "
                                                        >
                                                            <p style="margin: 0; word-break: break-word;"><span>{{$site_name}}</span></p>
                                                            <p style="margin: 0; word-break: break-word;"><span>{!! nl2br($customizations->contact_address) !!}</span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <table
                                align="center"
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="row-content stack"
                                role="presentation"
                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5d77a9; color: #000; width: 680px; margin: 0 auto;"
                                width="680"
                            >
                                <tbody>
                                    <tr>
                                        <td
                                            class="column column-1"
                                            style="
                                                mso-table-lspace: 0pt;
                                                mso-table-rspace: 0pt;
                                                font-weight: 400;
                                                text-align: left;
                                                padding-bottom: 20px;
                                                vertical-align: top;
                                                border-top: 0px;
                                                border-right: 0px;
                                                border-bottom: 0px;
                                                border-left: 0px;
                                            "
                                            width="100%"
                                        >
                                            <table
                                                border="0"
                                                cellpadding="10"
                                                cellspacing="0"
                                                class="paragraph_block block-1"
                                                role="presentation"
                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                width="100%"
                                            >
                                                <tr>
                                                    <td class="pad">
                                                        <div
                                                            style="
                                                                color: #cfceca;
                                                                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                                                                font-size: 12px;
                                                                line-height: 120%;
                                                                text-align: center;
                                                                mso-line-height-alt: 14.399999999999999px;
                                                            "
                                                        >
                                                            <p style="margin: 0; word-break: break-word;"><span>2023 Linblocks © All Rights Reserved</span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
@endsection
