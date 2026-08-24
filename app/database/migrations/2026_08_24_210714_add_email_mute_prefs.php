<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailMutePrefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('email_mute_admin_email')->default(false);
            $table->boolean('email_mute_app_feedback_request')->default(false);
            $table->boolean('email_mute_call_activity_alert')->default(false);
            $table->boolean('email_mute_call_quality_survey')->default(false);
            $table->boolean('email_mute_contact')->default(false);
            $table->boolean('email_mute_contact_confirm')->default(false);
            $table->boolean('email_mute_support_ticket_created')->default(false);
            $table->boolean('email_mute_support_ticket_updated')->default(false);
            $table->boolean('email_mute_usage_trigger')->default(false);
            $table->boolean('email_mute_billing_agreement_cancelled')->default(false);
            $table->boolean('email_mute_billing_failed')->default(false);
            $table->boolean('email_mute_card_expiring')->default(false);
            $table->boolean('email_mute_deactivated_account')->default(false);
            $table->boolean('email_mute_did_purchased')->default(false);
            $table->boolean('email_mute_failed_upgrade')->default(false);
            $table->boolean('email_mute_free_trial_expiring')->default(false);
            $table->boolean('email_mute_inactive_user')->default(false);
            $table->boolean('email_mute_one_time_login_link')->default(false);
            $table->boolean('email_mute_password')->default(false);
            $table->boolean('email_mute_password_reset')->default(false);
            $table->boolean('email_mute_password_was_reset')->default(false);
            $table->boolean('email_mute_payment_receipt')->default(false);
            $table->boolean('email_mute_plan_upgraded')->default(false);
            $table->boolean('email_mute_quote')->default(false);
            $table->boolean('email_mute_quote_confirm')->default(false);
            $table->boolean('email_mute_reactivated_account')->default(false);
            $table->boolean('email_mute_service_plan_being_migrated')->default(false);
            $table->boolean('email_mute_two_factor_acknowledgement')->default(false);
            $table->boolean('email_mute_unknown_device_login')->default(false);
            $table->boolean('email_mute_verify_email')->default(false);
            $table->boolean('email_mute_welcome_email')->default(false);
            $table->boolean('email_mute_extension_created')->default(false);
            $table->boolean('email_mute_invited_to_workspace')->default(false);
            $table->boolean('email_mute_phone_created')->default(false);
            $table->boolean('email_mute_sip_credentials')->default(false);
            $table->boolean('email_mute_workspace_account_suspended')->default(false);
            $table->boolean('email_mute_workspace_invoices')->default(false);
            $table->boolean('email_mute_workspace_suspended_admin')->default(false);
            $table->boolean('email_mute_alert_email')->default(false);
            $table->boolean('email_mute_port_started')->default(false);
            $table->boolean('email_mute_ports_status_completed')->default(false);
            $table->boolean('email_mute_ports_status_confirmed')->default(false);
            $table->boolean('email_mute_ports_status_needs_info')->default(false);
            $table->boolean('email_mute_ports_status_received')->default(false);
            $table->boolean('email_mute_ports_status_submitted')->default(false);
            $table->boolean('email_mute_sys_update')->default(false);
            $table->boolean('email_mute_test_email')->default(false);
            $table->boolean('email_mute_bug_report')->default(false);
            $table->boolean('email_mute_debugger_error')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_mute_admin_email',
                'email_mute_app_feedback_request',
                'email_mute_call_activity_alert',
                'email_mute_call_quality_survey',
                'email_mute_contact',
                'email_mute_contact_confirm',
                'email_mute_support_ticket_created',
                'email_mute_support_ticket_updated',
                'email_mute_usage_trigger',
                'email_mute_billing_agreement_cancelled',
                'email_mute_billing_failed',
                'email_mute_card_expiring',
                'email_mute_deactivated_account',
                'email_mute_did_purchased',
                'email_mute_failed_upgrade',
                'email_mute_free_trial_expiring',
                'email_mute_inactive_user',
                'email_mute_one_time_login_link',
                'email_mute_password',
                'email_mute_password_reset',
                'email_mute_password_was_reset',
                'email_mute_payment_receipt',
                'email_mute_plan_upgraded',
                'email_mute_quote',
                'email_mute_quote_confirm',
                'email_mute_reactivated_account',
                'email_mute_service_plan_being_migrated',
                'email_mute_two_factor_acknowledgement',
                'email_mute_unknown_device_login',
                'email_mute_verify_email',
                'email_mute_welcome_email',
                'email_mute_extension_created',
                'email_mute_invited_to_workspace',
                'email_mute_phone_created',
                'email_mute_sip_credentials',
                'email_mute_workspace_account_suspended',
                'email_mute_workspace_invoices',
                'email_mute_workspace_suspended_admin',
                'email_mute_alert_email',
                'email_mute_port_started',
                'email_mute_ports_status_completed',
                'email_mute_ports_status_confirmed',
                'email_mute_ports_status_needs_info',
                'email_mute_ports_status_received',
                'email_mute_ports_status_submitted',
                'email_mute_sys_update',
                'email_mute_test_email',
                'email_mute_bug_report',
                'email_mute_debugger_error',
            ]);
        });
    }
}