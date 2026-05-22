<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SendEmailTemplatePreviewsCommand extends Command
{
    protected $signature = 'emails:send-template-previews
        {email : Recipient email address}
        {--template=* : Send only selected template name(s)}
        {--dry-run : Render templates without sending}';

    protected $description = 'Send all email templates to a recipient for visual testing';

    public function handle()
    {
        $email = $this->argument('email');
        $selected = $this->option('template');
        $dryRun = (bool) $this->option('dry-run');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Please provide a valid email address.');
            return 1;
        }

        $templates = $this->templates();
        if (!empty($selected)) {
            $templates = array_values(array_intersect($templates, $selected));
        }

        if (empty($templates)) {
            $this->error('No matching email templates found.');
            return 1;
        }

        $data = $this->previewData();
        $sent = 0;

        foreach ($templates as $index => $template) {
            try {
                view('emails.' . $template, $data)->render();

                if (!$dryRun) {
                    Mail::send('emails.' . $template, $data, function ($message) use ($email, $template, $index) {
                        $message->to($email);
                        $message->subject(sprintf('[Template Preview %02d] %s', $index + 1, $template));
                    });
                    $sent++;
                }

                $this->info(($dryRun ? 'OK ' : 'SENT ') . $template);
            } catch (\Exception $e) {
                $this->error(sprintf('FAILED %s: %s', $template, $e->getMessage()));
                return 1;
            }
        }

        $this->info($dryRun ? 'Render check completed.' : sprintf('Done. Sent %d email(s) to %s.', $sent, $email));
        return 0;
    }

    private function templates()
    {
        return [
            'admin_email',
            'alert_email',
            'app_feedback_request',
            'billing_agreement_cancelled',
            'billing_failed',
            'bug_report',
            'call_activity_alert',
            'call_quality_survey',
            'card_expiring',
            'contact',
            'contact_confirm',
            'debugger_error',
            'did_purchased',
            'extension_created',
            'free_trial_expiring',
            'inactive_user',
            'invited_to_workspace',
            'newsletter1',
            'one_time_login_link',
            'password',
            'password_was_reset',
            'payment_receipt',
            'phone_created',
            'plan_upgraded',
            'ports_status_completed',
            'ports_status_confirmed',
            'ports_status_needs_info',
            'ports_status_received',
            'ports_status_submitted',
            'port_started',
            'quote',
            'quote_confirm',
            'service_plan_being_migrated',
            'sip_credentials',
            'support_ticket_created',
            'support_ticket_updated',
            'sys_update',
            'test_email',
            'two_factor_acknowledgement',
            'unknown_device_login',
            'usage_trigger',
            'verify_email',
            'welcome_email',
            'workspace_invoices',
            'auth.password',
        ];
    }

    private function previewData()
    {
        $siteName = Config::get('app.site_name') ?: 'Lineblocs';
        $customizations = new EmailTemplatePreviewObject([
            'contact_address' => "123 Preview Street\nDemo City",
            'domain' => Config::get('app.deployment_domain'),
        ]);

        $user = new EmailTemplatePreviewObject();
        $workspace = new EmailTemplatePreviewObject(['id' => 2001, 'name' => 'Preview Workspace']);
        $port = new EmailTemplatePreviewObject();

        return [
            'site_name' => $siteName,
            'site' => $siteName,
            'customizations' => $customizations,
            'user' => $user,
            'newUser' => $user,
            'creator' => $user,
            'workspace' => $workspace,
            'port' => $port,
            'number' => $port,
            'did' => $port,
            'extension' => new EmailTemplatePreviewObject(['username' => '1001', 'secret' => 'preview-secret']),
            'phoneDef' => new EmailTemplatePreviewObject(['manufacturer' => 'Yealink', 'model' => 'T46S']),
            'plan' => 'Professional Voice Plan',
            'currentPlan' => new EmailTemplatePreviewObject(['nice_name' => 'Starter Voice Plan']),
            'newPlan' => new EmailTemplatePreviewObject(['nice_name' => 'Professional Voice Plan']),
            'ticket' => new EmailTemplatePreviewObject(),
            'update' => new EmailTemplatePreviewObject(),
            'usage_trigger' => new EmailTemplatePreviewObject(['percentage' => 25]),
            'detect' => new EmailTemplatePreviewObject(),
            'body' => '<p>This is a sample admin message body.</p>',
            'feedbackLink' => 'http://127.0.0.1:8000/feedback/preview',
            'reason' => 'The payment method was declined in this preview.',
            'subscription_id' => 'sub_preview_123',
            'workspace_id' => 'ws_preview_123',
            'description' => 'This is a preview description.',
            'from' => '+15550000001',
            'to' => '+15550000002',
            'run_id' => 'run_preview_123',
            'recipient_name' => 'Preview User',
            'survey_links' => [
                1 => 'http://127.0.0.1:8000/survey/1',
                2 => 'http://127.0.0.1:8000/survey/2',
                3 => 'http://127.0.0.1:8000/survey/3',
                4 => 'http://127.0.0.1:8000/survey/4',
                5 => 'http://127.0.0.1:8000/survey/5',
            ],
            'days' => 14,
            'ending_digits' => '4242',
            'first_name' => 'Preview',
            'last_name' => 'User',
            'email' => 'preview@example.com',
            'phone' => '+15551234567',
            'comments' => 'This is sample content for previewing the email template.',
            'bug_type' => 'UI',
            'params' => ['title' => 'Preview debugger alert', 'report' => 'Sample debugger report body.'],
            'link' => 'http://127.0.0.1:8000/verify/preview',
            'domain' => 'localhost:8000',
            'expires_minutes' => 15,
            'login_link' => 'http://127.0.0.1:8000/login/preview',
            'token' => 'preview-token',
            'card_brand' => 'Visa',
            'card_last_4' => '4242',
            'payment_amount' => '$25.00',
            'timestamp' => date('Y-m-d H:i:s'),
            'host' => 'sip.preview.localhost',
            'username' => '1001',
            'password' => 'preview-password',
            'tcp_port' => 5060,
            'websocket_settings' => ['gateway' => 'wss://sip.preview.localhost:7443'],
            'period' => 'May 2026',
        ];
    }
}

class EmailTemplatePreviewObject implements \ArrayAccess
{
    private $values;

    public function __construct(array $values = [])
    {
        $this->values = array_merge([
            'id' => 1001,
            'name' => 'Preview User',
            'first_name' => 'Preview',
            'last_name' => 'User',
            'email' => 'preview@example.com',
            'number' => '+15551234567',
            'eta' => 'May 21, 2026',
            'provider' => 'Preview Provider',
            'info_needed' => 'Please provide a recent bill copy and the account PIN from your current carrier.',
            'username' => 'preview-extension',
            'secret' => 'preview-secret',
            'manufacturer' => 'Yealink',
            'model' => 'T46S',
            'nice_name' => 'Professional Voice Plan',
            'subject' => 'Preview support ticket',
            'comments' => 'This is sample content for previewing the email template.',
            'title' => 'Preview system update',
            'body' => '<p>This is a sample system update body.</p>',
            'percentage' => 25,
            'contact_address' => "123 Preview Street\nDemo City",
            'domain' => 'localhost:8000',
        ], $values);
    }

    public function __get($name)
    {
        if ($name === 'getBillingInfo') {
            return ['remainingBalance' => '$42.00'];
        }

        return array_key_exists($name, $this->values) ? $this->values[$name] : 'Preview ' . $name;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'getName') {
            return trim($this->first_name . ' ' . $this->last_name);
        }

        if ($name === 'getBillingInfo') {
            return ['remainingBalance' => '$42.00'];
        }

        if ($name === 'sipURL') {
            return 'sip.preview.localhost';
        }

        if ($name === 'getUserAgent') {
            return 'Mozilla/5.0 (Preview Device)';
        }

        return 'Preview ' . $name;
    }

    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }
}
