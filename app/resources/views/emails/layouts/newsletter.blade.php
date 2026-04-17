@extends('emails.layouts.shell')

@section('email_body')
  @include('emails.layouts.partials.header')
  @yield('pre_title')
  <tr>
    <td class="email-top-space">&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation" class="email-card">
        <tr>
          <td align="center" style="padding: 0 0 8px;">
            <img src="{{ \Config::get('app.url') . '/email-images/newletter_header.jpg' }}" alt="Newsletter" width="640" class="mobile-full" />
          </td>
        </tr>
        <tr>
          <td class="email-card-inner mobile-pad">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation" class="email-body-wrap">
              @yield('content')
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  @include('emails.layouts.partials.footer')
  <tr>
    <td class="email-bottom-space">&nbsp;</td>
  </tr>
@endsection
