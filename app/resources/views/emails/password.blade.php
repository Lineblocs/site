@extends('emails.layouts.alert_email')
@section('title') Password Reset @parent @endsection
@section('content')
<tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
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
                                            <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                <tr>
                                                    <td class="pad" style="width: 100%; padding-right: 0px; padding-left: 0px;">
                                                        <div align="center" class="alignment" style="line-height: 10px;">
                                                            <a href="{{\App\Helpers\MainHelper::createUrl()}}" target="_blank">
                                                                <img src="{{\Config::get("app.url").'/email-images/'}}logo.png" style="display: block; height: auto; border: 0; max-width: 238px; width: 100%;" width="238" />
                                                            </a>
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
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
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
                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5d77a9; color: #000; border-radius: 0; width: 680px; margin: 0 auto;"
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
                                                padding-left: 5px;
                                                padding-right: 5px;
                                                padding-top: 5px;
                                                vertical-align: top;
                                                border-top: 0px;
                                                border-right: 0px;
                                                border-bottom: 0px;
                                                border-left: 0px;
                                            "
                                            width="100%"
                                        >
                                            <table border="0" cellpadding="10" cellspacing="0" class="heading_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                <tr>
                                                    <td class="pad">
                                                        <h1
                                                            style="
                                                                margin: 0;
                                                                color: #ffffff;
                                                                direction: ltr;
                                                                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                                                                font-size: 38px;
                                                                font-weight: 700;
                                                                letter-spacing: normal;
                                                                line-height: 120%;
                                                                text-align: center;
                                                                margin-top: 0;
                                                                margin-bottom: 0;
                                                            "
                                                        >
                                                            <span class="tinyMce-placeholder">@yield('title') </span>
                                                        </h1>
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
                                                padding-top: 40px;
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
                                                                To reset your password, complete this form: <a href="{{ \App\Helpers\MainHelper::createPortalLink('#/reset?token=' . $token } }}">Click Here</a>
                                                                <br>
                                                                <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
                                                                This link will expire in {{ config('auth.reminder.expire', 60) }} minutes.
                                                                </td>
                                                                </span>
                                                            </p>
                                                            <p style="margin: 0; word-break: break-word;"></p>
                                                            <p style="margin: 0; word-break: break-word;">
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                                                                
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
                                                            <p style="margin: 0; word-break: break-word;"><span>LineBlocs</span></p>
                                                            <p style="margin: 0; word-break: break-word;"><span>xxx Massachusetts Ave. </span></p>
                                                            <p style="margin: 0; word-break: break-word;"><span>Cambridge, MA XXXX, USA </span></p>
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
