<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('page_title', trim($__env->yieldContent('title')) ?: $site_name)</title>
  @include('emails.layouts.styles')
</head>
<body class="email-bg">
  <span class="preheader">
    @if (!empty(trim($__env->yieldContent('preheader'))))
      @yield('preheader')
    @else
      {{ $site_name }} email
    @endif
  </span>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation" class="email-shell email-bg">
    <tr>
      <td class="mobile-pad" style="padding: 40px 12px 24px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation" class="email-container">
          @yield('email_body')
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
