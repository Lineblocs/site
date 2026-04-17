<tr>
  <td class="email-footer mobile-pad">
    <p>For customer service inquiries, contact {{ \App\Helpers\MainHelper::createEmail('support') }}</p>
    <p>{{ $site_name }}<br />{!! nl2br(e($customizations->contact_address)) !!}</p>
    @if (empty($hideEmailUnsubscribe))
      <p><a href="{{ \App\Helpers\MainHelper::createUrl('/email/unsubscribe') }}">Unsubscribe</a> from future email notifications</p>
    @endif
  </td>
</tr>
