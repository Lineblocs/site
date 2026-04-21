@extends('emails.layouts.header')
@section('title')
Call Quality Survey
@endsection

@section('content')
<tr>
  <td valign="top" class="mobilespacer">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td width="30" class="hide">&nbsp;</td>
          <td class="mobilespacer2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="padding: 0 10px 18px;">
                    <p style="margin:0 0 14px;color:#e14c2f;font-size:44px;line-height:52px;font-weight:700;">
                      Hi {{ !empty($recipient_name) ? $recipient_name : 'there' }},
                    </p>
                    <p style="margin:0 0 24px;color:#1c2434;font-size:44px;line-height:52px;font-weight:700;">
                      How was your call quality experience?
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 0 10px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" style="padding:8px 0;">
                          <a href="{{$survey_links[5]}}" style="display:inline-table;width:52px;height:52px;text-decoration:none;vertical-align:middle;">
                            <span style="display:table-cell;width:52px;height:52px;text-align:center;vertical-align:middle;font-size:36px;line-height:1;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif;">&#128515;</span>
                          </a>
                        </td>
                        <td align="center" style="padding:8px 0;">
                          <a href="{{$survey_links[4]}}" style="display:inline-table;width:52px;height:52px;text-decoration:none;vertical-align:middle;">
                            <span style="display:table-cell;width:52px;height:52px;text-align:center;vertical-align:middle;font-size:36px;line-height:1;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif;">&#128522;</span>
                          </a>
                        </td>
                        <td align="center" style="padding:8px 0;">
                          <a href="{{$survey_links[3]}}" style="display:inline-table;width:52px;height:52px;text-decoration:none;vertical-align:middle;">
                            <span style="display:table-cell;width:52px;height:52px;text-align:center;vertical-align:middle;font-size:36px;line-height:1;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif;">&#128528;</span>
                          </a>
                        </td>
                        <td align="center" style="padding:8px 0;">
                          <a href="{{$survey_links[2]}}" style="display:inline-table;width:52px;height:52px;text-decoration:none;vertical-align:middle;">
                            <span style="display:table-cell;width:52px;height:52px;text-align:center;vertical-align:middle;font-size:36px;line-height:1;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif;">&#128577;</span>
                          </a>
                        </td>
                        <td align="center" style="padding:8px 0;">
                          <a href="{{$survey_links[1]}}" style="display:inline-table;width:52px;height:52px;text-decoration:none;vertical-align:middle;">
                            <span style="display:table-cell;width:52px;height:52px;text-align:center;vertical-align:middle;font-size:36px;line-height:1;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif;">&#128545;</span>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="padding-top:8px;font-size:14px;color:#253248;">Excellent</td>
                        <td align="center" style="padding-top:8px;font-size:14px;color:#253248;">Good</td>
                        <td align="center" style="padding-top:8px;font-size:14px;color:#253248;">Average</td>
                        <td align="center" style="padding-top:8px;font-size:14px;color:#253248;">Poor</td>
                        <td align="center" style="padding-top:8px;font-size:14px;color:#253248;">Very Poor</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="padding:24px 10px 0;font-size:15px;line-height:23px;color:#24324b;">
                    Your response is recorded when you click one of the options above.
                  </td>
                </tr>
                <tr>
                  <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
@endsection
